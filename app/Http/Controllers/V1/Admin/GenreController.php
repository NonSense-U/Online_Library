<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Traits\V1\ApiResponse;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $genres = Genre::all();
        return ApiResponse::success('ok', ['genres' => $genres], 200);
    }

    public function getGenre($genre_id)
    {
        $genre = Genre::findOrFail($genre_id);
        return ApiResponse::success('ok', ['genre' => $genre], 200);
    }

    public function addGenre(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string']
        ]);
        $genre = Genre::create($validated);
        return ApiResponse::success('genre added successfully', ['genre' => $genre], 201);
    }

    public function updateGenre(Request $request, $genre_id)
    {
        $genre = Genre::findOrFail($genre_id);
        $validated = $request->validate([
            'name' => ['sometimes','string']
        ]);
        $genre->update($validated);
        return ApiResponse::success('genre updated successfully.', ['updated_genre' => $genre]);
    }

    public function deleteGenre($genre_id)
    {
        $genre = Genre::findOrFail($genre_id);
        $genre->delete();
        return ApiResponse::success('genre deleted successfully.');
    }
}