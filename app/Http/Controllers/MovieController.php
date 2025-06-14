<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;

class MovieController extends Controller
{ 
    // Menampilkan homepage dengan filter genre dan pencarian
    public function index(Request $request)
    {
        $genre = $request->query('genre');
        $search = $request->query('search');

        $query = Movie::query();

        // Jika filter genre diaktifkan
        if ($genre) {
            $category = Category::where('category_name', $genre)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Jika pencarian diaktifkan
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        // Ambil hasil movie
        $movies = $query->orderBy('created_at', 'desc')->paginate(6);

        // Append query agar tetap ada saat pagination
        $movies->appends([
            'genre' => $genre,
            'search' => $search,
        ]);

        return view('homepage', [
            'movies' => $movies,
            'category_name' => $genre,
            'search' => $search,
        ]);
    }

    public function show($id)
    {
        $movie = Movie::with('category')->findOrFail($id);
        return view('movie_detail', compact('movie'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('movie_form', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'nullable|string',
            'category_id' => 'required|string',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'actors' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('images', 'public');
        }

        Movie::create($validated);

        return redirect()->back()->with('success', 'Film berhasil ditambahkan!');
    }

    public function list()
    {
        $movies = Movie::paginate(10);
        return view('list_movie', compact('movies'));
    }

    public function edit($id)
    {
        $movies = Movie::findOrFail($id);
        return view('edit_movie', compact('movies'));
    }

    public function update(Request $request, $id)
    {
        $movies = Movie::findOrFail($id);
        $movies->update([
            'title' => $request->title,
            'synopsis' => $request->synopsis,
            'year' => $request->year,
            'category_id' => $request->category_id,
            'actors' => $request->actors,
        ]);
        return redirect('/list')->with('success', 'Berhasil mengupdate data movie');
    }

    public function destroy($id)
    {
        if (Gate::allows('delete-movie')) {
            $data = Movie::findOrFail($id);
            $data->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus');
        }
    }
}
