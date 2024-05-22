<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCourseAndEpisodeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'max:255', Rule::unique('courses')->ignore($this->course->id)],
            'description' => ['required'],
            'episodes' => ['required', 'array', 'min:1', 'max:15'],
            'episodes.*.title' => ['required', 'max:255', Rule::unique('episodes', 'title')->where(function ($query) {
                return $query->where('course_id', $this->course->id);
            })->ignore($this->route('episode'))],
            'episodes.*.description' => ['required'],
            'episodes.*.video_url' => ['required']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'episodes.required' => 'La formation doit contenir au minimum 1 épisode',
            'episodes.min:15' => 'La formation doit contenir au maximum 15 épisodes',
            'episodes.*.title.required' => 'Merci d\'indiquer un titre pour cet épisode',
            'episodes.*.description.required' => 'Merci d\'indiquer une description pour cet épisode',
            'episodes.*.video_url.required' => 'Merci d\'indiquer un lien de vidéo pour cet épisode',
            'episodes.*.video_url.url' => 'Le lien de la vidéo doit être une URL valide', // Ajoutez un message personnalisé si nécessaire
        ];
    }
}