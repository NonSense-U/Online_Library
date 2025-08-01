<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Services\V1\BookService;
use App\Traits\V1\ApiResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    use ApiResponse;

    private $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }


    public function index(Request $request)
    {
        $books = Book::all();
        return ApiResponse::success('ok', ['books' => $books],200);
    }

    public function getBook($book_id)
    {
        $book = Book::findOrFail($book_id);
        return ApiResponse::success('book retrieved successfully', ['book' => $book], 200);
    }

    public function addBook(StoreBookRequest $request)
    {
        $data = $this->bookService->addBook($request->validated());
        return ApiResponse::success('Book added successfully!', $data, 201);
    }

    public function updateBook(UpdateBookRequest $request, $book_id)
    {
        $book = $this->bookService->updateBook($request->validated(), $book_id);
        return ApiResponse::success('book updated successfully!', ['updated_book' => $book], 200);
    }

    public function deleteBook($book_id)
    {
        $this->bookService->deleteBook($book_id);
        return ApiResponse::success('Book has been deleted successfully', [], 200);
    }
}
