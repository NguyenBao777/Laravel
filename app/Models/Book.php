<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $dates = [
        "created_at", "updated_at",
    ];

    public $timestamps = false;
    protected $fillable = [
        "book_name", "created_at", "updated_at", "book_description", "book_status", "book_keyword", "book_cover", "category_id", "book_hot", "book_view"
    ];
    protected $primaryKey = "book_id";
    protected $table = "book";

    public function category()
    {
        return $this->belongsTo("App\Models\Category", "category_id", "category_id");
    }

    public function chapter()
    {
        return $this->hasMany("App\Models\Chapter");
    }
}