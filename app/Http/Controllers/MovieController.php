<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index() {
        $movies = Movie::latest()->paginate(6);
        return view('homepage', compact('movies'));
    }
}
