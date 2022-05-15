<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        "chapter_title", "chapter_description", "chapter_status", "chapter_content", "book_id", "chapter_keyword", "created_at"
    ];
    protected $primaryKey = "chapter_id";
    protected $table = "chapter";

    public function book()
    {
        return $this->belongsTo("App\Models\Book", "book_id", "book_id");
    }
}