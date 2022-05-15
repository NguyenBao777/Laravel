<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BookReview;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $book = Book::orderBy("book_view", "DESC")->where("book_status", 1)->take(5)->get();
        $review_book = BookReview::orderBy("review_id", "DESC")->where("review_status", 0)->get();

        return view('home')->with(compact("book", "review_book"));
    }
}