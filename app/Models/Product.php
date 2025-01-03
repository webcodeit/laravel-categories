<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $guarded = []; // All fields are mass assignable except 'id, title'

    // protected $fillable = [
    //     'title',   // Added 'title' here
    //     'content', // Keep any other fields you need for mass assignment
    // ];categories

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'pro_id', 'cat_id');
    }
}

?>