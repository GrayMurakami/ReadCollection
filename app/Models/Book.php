<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'author', 'publication_date', 'genre', 'description', 'cover_image', 'book_manager_id'
    ];

    protected $table = 'books';
    protected $primaryKey = 'book_id';
    protected $dates = ['deleted_at'];
}
