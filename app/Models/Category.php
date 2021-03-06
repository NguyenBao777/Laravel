<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        "category_name", "category_description", "category_status", "category_keyword"
    ];
    protected $primaryKey = "category_id";
    protected $table = "category";

    public function book()
    {
        return $this->hasMany("App\Models\Book");
    }
}