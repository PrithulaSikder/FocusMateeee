<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class InspirationalImageController extends Controller
{
    public function index()
    {
        // Preloaded image URLs
        $images = [
            asset('images/inspire1.jpg'),
            asset('images/inspire2.jpg'),
            asset('images/inspire3.jpg'),
            asset('images/inspire4.jpg'),
            asset('images/inspire5.jpg')
        ];

        // Pick a “daily” image based on day of year to show a new one each day
        $dayOfYear = Carbon::now()->dayOfYear;
        $imageOfTheDay = $images[$dayOfYear % count($images)];

        return view('inspirational-image.index', compact('imageOfTheDay'));
    }
}

