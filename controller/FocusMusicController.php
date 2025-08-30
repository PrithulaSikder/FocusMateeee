<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FocusMusicController extends Controller
{
    public function index()
    {
        // Hardcoded sounds (pointing to files in /public/audio)
        $sounds = [
            ['title' => 'Rain', 'file_path' => 'audio/rain.mp3'],
            ['title' => 'Forest', 'file_path' => 'audio/forest.mp3'],
            ['title' => 'White Noise', 'file_path' => 'audio/whitenoise.mp3'],
            ['title' => 'Ocean Waves', 'file_path' => 'audio/ocean.mp3'],
        ];

        return view('focus_music.index', compact('sounds'));
    }
}

