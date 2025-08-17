<?php

// app/Http/Controllers/MotivationQuoteController.php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class MotivationQuoteController extends Controller
{
    public function index()
    {
        $quotes = [
            "Believe in yourself!",
            "You are capable of amazing things.",
            "Every day is a fresh start.",
            "Don't give up. Great things take time.",
            "Push yourself, because no one else will."
        ];

        $randomQuote = $quotes[array_rand($quotes)];

        return view('motivation.index', compact('randomQuote'));
    }
}

