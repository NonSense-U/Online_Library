<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Traits\V1\ApiResponse;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $authors = Author::all();
        return ApiResponse::success('ok', ['authors' => $authors], '200');
    }

    public function getAuthor($author_id)
    {
        $author = Author::findOrFail($author_id);
        return ApiResponse::success('ok', ['author' => $author], 200);
    }

    public function addAuthor(Request $request)
    {
        $validated = $request->validate([
            'fullname' => ['required', 'string'],
            'origin_country' => ['required', 'string']
        ]);

        $author = Author::create($validated);
        return ApiResponse::success('Author added successfully.', ['author' => $author], 201);
    }

    public function updateAuthor(Request $request, $author_id)
    {
        $validated = $request->validate([
            'fullname' => ['sometimes', 'string'],
            'origin_country' => ['sometimes', 'string']
        ]);

        $author = Author::findOrFail($author_id);
        $author->update($validated);
        
        return ApiResponse::success('Author updated successfully.', ['updated_author' => $author], 200);
    }

    public function deleteAuthor($author_id)
    {
        $author = Author::findOrFail($author_id);
        $author->delete();
        return ApiResponse::success('author removed successfully.', [], 200);
    }
}
