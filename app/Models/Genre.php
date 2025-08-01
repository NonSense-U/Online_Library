<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    
    public function genre_books()
    {
        return $this->belongsToMany(Book::class,'books_genres');
    }
}
