<?php

namespace App\Youtube;

use DateInterval;
use DateTime;
use Illuminate\Support\Facades\Http;

class YoutubeServices {
    private $key;

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function handleYoutubeVideoDuration(string $video_url): int
    {
        // Extract the video ID from the URL
        if (preg_match('/embed\/(.+)/', $video_url, $matches)) {
            $id = $matches[1];
        } else {
            // Handle the case where the video ID is not found
            return 0;
        }

        // Set the path to your cacert.pem file
        $caCertPath = storage_path('app/cacert.pem'); // Adjust the path as needed

        // Verify if the cacert.pem file exists
        if (!file_exists($caCertPath)) {
            // Handle the case where the cacert.pem file is missing
            return 0;
        }

        // Call the YouTube API to get the video details
        $response = Http::withOptions([
            'verify' => $caCertPath,
        ])->get("https://www.googleapis.com/youtube/v3/videos?key={$this->key}&id={$id}&part=contentDetails");

        // Handle the case where the API call fails
        if ($response->failed() || !isset(json_decode($response)->items[0])) {
            return 0;
        }

        $duration = json_decode($response)->items[0]->contentDetails->duration;

        // Convert the ISO 8601 duration to seconds
        try {
            $interval = new DateInterval($duration);
            $datetime = new DateTime();
            $datetime->setTime(0, 0, 0);
            $datetime->add($interval);
            return ($datetime->getTimestamp() - (new DateTime('00:00:00'))->getTimestamp());
        } catch (\Exception $e) {
            // Handle the case where the duration format is invalid
            return 0;
        }
    }
}
