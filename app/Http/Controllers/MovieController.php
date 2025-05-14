<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MovieController extends Controller
{
    public function index() {
        $movies = Movie::latest()->paginate(6);
        return view('homepage', compact('movies'));
    }
    public function show($id)
    {
        $movie = Movie::with('category')->findOrFail($id);
        return view('movie_detail', compact('movie'));
    }
    public function create() {
        $categories = Category::all();
        return view('movie_form', compact('categories'));
    }
    
}
