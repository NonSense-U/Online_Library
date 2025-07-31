<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    public function genres()
    {
        return $this->belongsToMany(Genre::class,'books_genres');
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
