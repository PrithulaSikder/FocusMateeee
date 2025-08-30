<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MotivationalVideoController extends Controller
{
    public function index()
    {
        // Preloaded video URLs (YouTube or Vimeo etc.)
        $videos = [
            "https://www.youtube.com/embed/ZXsQAXx_ao0", // Example video
            "https://www.youtube.com/embed/wnHW6o8WMas",
            "https://www.youtube.com/embed/2vj37yeQQHg",
            "https://www.youtube.com/embed/d6wRkzCW5qI",
            "https://www.youtube.com/embed/hbkZrOU1Zag"
        ];

        // Pick one random video
        $video = $videos[array_rand($videos)];

        return view('motivational_videos.index', compact('video'));
    }
}
