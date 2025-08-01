<?php

namespace App\Services\V1;

use App\Models\Book;
use Error;
use Illuminate\Support\Facades\DB;

class BookService
{

    public function addBook(array $payload)
    {
        try {
            DB::beginTransaction();
            /** @var \App\Models\Book $book */
            $book = Book::create($payload['base']);
            $book->genres()->attach($payload['genres']);
            $book->load(['genres', 'author']);
            $data['book'] = $book;
            DB::commit();
            return $data;
        } catch (Error $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateBook(array $payload, $book_id)
    {
        /** @var \App\Models\Book $book */
        $book = Book::findOrFail($book_id);
        if(isset($payload['base']))
        {
            $book->update($payload['base']);
        }

        if(isset($payload['genres']))
        {
            $book->genres()->sync($payload['genres']);
        }
        $book->load('genres');
        return $book;
    }
    
    public function deleteBook($book_id)
    {
        $book = Book::findOrFail($book_id);
        $book->delete();
        return;
    }

}
