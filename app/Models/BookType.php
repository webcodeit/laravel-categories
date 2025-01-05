<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookType extends Model
{
    use HasFactory;

    protected $table = "book_types";

    protected $guarded = [];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
