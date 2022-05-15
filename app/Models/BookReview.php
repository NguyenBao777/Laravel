<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookReview extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        "review_title", "review_image", "review_content", "review_description", "review_keyword", "review_status", "review_user", "created_at"
    ];
    protected $primaryKey = "review_id";
    protected $table = "book_review";
}