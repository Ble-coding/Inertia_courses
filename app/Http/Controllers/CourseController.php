<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Course;
use App\Models\Episode;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCourseAndEpisodeRequest;
use App\Http\Requests\UpdateCourseAndEpisodeRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Youtube\YoutubeServices;

class CourseController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('user')
        ->select('courses.*', DB::raw(
            '(SELECT COUNT(DISTINCT(user_id))
            FROM completions
            INNER JOIN episodes ON completions.episode_id = episodes.id
            WHERE episodes.course_id = courses.id
            ) AS participants'
        ))->addSelect(DB::raw(
            '(SELECT SUM(duration)
            FROM episodes
            WHERE episodes.course_id = courses.id
            ) AS total_duration'
        ))
        ->withCount('episodes')
        ->latest()
        ->paginate(5);
    
        return Inertia::render('Courses/Index', [
            'courses' => $courses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Courses/Create');
        // , [
        //     'course' => $course
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StoreCourseRequest $request, YoutubeServices $ytb)
    // {
    //     $course = Course::create($request->all());

    //     foreach($request->input('episodes') as $episode)
    //     {
    //         $episode['course_id'] = $course->id;
    //         $episode['duration'] = $ytb->handleYoutubeVideoDuration($episode['video_url']);
    //         Episode::create($episode);
    //     }

    //     return Redirect::route('courses.index')->with('success', 'Félicitations, votre formation a bien été postée.');
    // }

    public function store(StoreCourseAndEpisodeRequest $request, YoutubeServices $ytb)
    {
        DB::transaction(function() use ($request, $ytb) {
            // Créer le cours
            $course = Course::create($request->validated());
    
            // Créer les épisodes
            foreach ($request->input('episodes') as $episode) {
                $episode['course_id'] = $course->id;
                $episode['duration'] = $ytb->handleYoutubeVideoDuration($episode['video_url']);
                Episode::create($episode);
            }
        });
    
        // Flash message et redirection
        $request->session()->flash('success', 'Félicitations, votre formation a bien été postée.');
        return Redirect::route('courses.index');
    }
    
    public function show(Course $course)
    {
        $course->load('episodes'); 
        $watched = auth()->user()->episodes; 
    
        return Inertia::render('Courses/Show', [
            'course' => $course,
            'watched' => $watched
        ]);
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $course->load('episodes'); 
        $this->authorize('update', $course);
    
        return Inertia::render('Courses/Edit', [
            'course' => $course
        ]);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseAndEpisodeRequest $request, Course $course, YoutubeServices $ytb)
    {
        DB::transaction(function() use ($request, $course, $ytb) {
            // Mettre à jour le cours
            $course->update($request->validated());
    
            // Supprimer les anciens épisodes
            $course->episodes()->delete();
    
            // Créer les nouveaux épisodes
            foreach ($request->input('episodes') as $episode) {
                $episode['course_id'] = $course->id;
                $episode['duration'] = $ytb->handleYoutubeVideoDuration($episode['video_url']);
                Episode::create($episode);
            }
        });
    
        // Flash message et redirection
        $request->session()->flash('success', 'Félicitations, votre formation a bien été modifiée.');
        return Redirect::route('courses.index');
    }
    
    public function toggleProgress(Request $request)
    {
        $id = $request->input('episodeId');
        $user = auth()->user();
    
        $user->episodes()->toggle($id);
    
        return $user->episodes;
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $this->authorize('delete', $course);
        $course->delete();
    
        session()->flash('success', 'La formation a été supprimée avec succès.');
    
        return Redirect::route('courses.index');
    }
    
}
