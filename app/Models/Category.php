<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";

    protected $guarded = []; // All fields are mass assignable except 'id, title'

    // protected $fillable = [
    //     'title',   // Added 'title' here
    //     'content', // Keep any other fields you need for mass assignment
    // ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product', 'cat_id', 'pro_id');
    }
}

?>