<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;
use App\Models\BookReview;
use App\Models\Chapter;

class IndexController extends Controller
{
    public function home()
    {
        $category = Category::orderBy("category_id", "DESC")->get();
        $book = Book::orderBy("book_id", "DESC")->where("book_status", 1)->take(8)->get();
        $slide_book_hot = Book::orderBy("book_id", "DESC")->where("book_status", 1)->where("book_hot", 1)->take(8)->get();
        $review_book = BookReview::orderBy("review_id", "DESC")->where("review_status", 1)->take(2)->get();

        return view("pages.home")->with(compact("category", "book", "slide_book_hot", "review_book"));
    }

    public function bookwithcategory($keyword)
    {
        $category = Category::orderBy("category_id", "DESC")->get();
        $category_id = Category::where("category_keyword", $keyword)->first();
        $slide_book_hot = Book::orderBy("book_id", "DESC")->where("book_status", 1)->where("book_hot", 1)->take(8)->get();
        $book = Book::orderBy("book_id", "DESC")->where("book_status", 1)->where("category_id", $category_id->category_id)->get();
        $review_book = BookReview::orderBy("review_id", "DESC")->where("review_status", 1)->take(6)->get();

        return view("pages.bookwithcategory")->with(compact("category", "book", "category_id", "slide_book_hot", "review_book"));
    }

    public function bookdetail($keyword)
    {
        $category = Category::orderBy("category_id", "DESC")->get();
        $book = Book::orderBy("book_id", "DESC")->where("book_status", 1)->where("book_keyword", $keyword)->first();
        $chapter = Chapter::with("book")->where("book_id", $book->book_id)->orderBy("chapter_id", "ASC")->get();
        $book_with_category = Book::with("category")->where("category_id", $book->category->category_id)->where("book_status", 1)->whereNotIn("book_id", [$book->book_id])->take(3)->get();
        $chapter_first = Chapter::with("book")->orderBy("chapter_id", "ASC")->where("book_id", $book->book_id)->first();
        $chapter_last = Chapter::with("book")->orderBy("chapter_id", "DESC")->where("book_id", $book->book_id)->first();
        $slide_book_hot = Book::orderBy("book_id", "DESC")->where("book_status", 1)->where("book_hot", 1)->take(8)->get();
        return view("pages.bookdetail")->with(compact("category", "book", "chapter", "chapter_last", "book_with_category", "chapter_first", "slide_book_hot"));
    }

    public function bookviewonline($keyword)
    {
        $category = Category::orderBy("category_id", "DESC")->get();
        $book = Chapter::where("chapter_keyword", $keyword)->first();
        $chapter = Chapter::with("book")->where("book_id", $book->book_id)->where("chapter_keyword", $keyword)->orderBy("chapter_id", "ASC")->first();
        $chapter_list = Chapter::with("book")->orderBy("chapter_id", "ASC")->where("book_id", $book->book_id)->get();
        $max_chapter_id = Chapter::where("book_id", $book->book_id)->orderBy("chapter_id", "DESC")->first();
        $min_chapter_id = Chapter::where("book_id", $book->book_id)->orderBy("chapter_id", "ASC")->first();
        $next_chapter = Chapter::where("book_id", $book->book_id)->where("chapter_id", ">", $chapter->chapter_id)->min("chapter_keyword");
        $prev_chapter = Chapter::where("book_id", $book->book_id)->where("chapter_id", "<", $chapter->chapter_id)->max("chapter_keyword");
        $slide_book_hot = Book::orderBy("book_id", "DESC")->where("book_status", 1)->where("book_hot", 1)->take(8)->get();
        //breadcrumb
        $book_breadcrumb = Book::with("category")->where("book_id", $book->book_id)->first();
        //update view
        $view = Book::where("book_id", $book->book_id)->first();
        $view->book_view = $view->book_view + 1;
        $view->save();



        return view("pages.bookviewonline")->with(compact("category", "chapter", "chapter_list", "book_breadcrumb", "max_chapter_id", "min_chapter_id", "next_chapter", "prev_chapter", "slide_book_hot"));
    }

    public function search(Request $request)
    {
        $data = $request->all();
        $search_keyword = $data["search_keyword"];
        $category = Category::orderBy("category_id", "DESC")->get();
        $slide_book_hot = Book::orderBy("book_id", "DESC")->where("book_status", 1)->where("book_hot", 1)->take(8)->get();
        $book = Book::with("category")->where("book_name", "LIKE", "%" . $search_keyword . "%")->orWhere("book_description", "LIKE", "%" . $search_keyword . "%")->orWhere("book_author", "LIKE", "%" . $search_keyword . "%")->get();

        return view("pages.search")->with(compact("category", "book", "slide_book_hot", "search_keyword"));
    }

    public function search_ajax(Request $request)
    {
        $data = $request->all();

        if ($data['query']) {
            $book = Book::where("book_status", 1)->where("book_name", "LIKE", "%" . $data['query'] . "%")->orWhere("book_description", "LIKE", "%" . $data['query'] . "%")->orWhere("book_author", "LIKE", "%" . $data['query'] . "%")->get();

            $output = '<ul class="dropdown-menu" style="display:block;">';
            foreach ($book as $key => $book_result) {
                $output .= '<li class="li_search_ajax"><a href="#">' . $book_result->book_name . '</a></li>';
            }

            $output .= '</ul>';
            echo $output;
        }
    }

    public function review_index()
    {
        $category = Category::orderBy("category_id", "DESC")->get();
        $book = Book::orderBy("book_id", "DESC")->where("book_status", 1)->get();
        $slide_book_hot = Book::orderBy("book_id", "DESC")->where("book_status", 1)->where("book_hot", 1)->take(8)->get();
        $review_book = BookReview::orderBy("review_id", "DESC")->where("review_status", 1)->paginate(6);

        return view("pages.reviewbook")->with(compact("book", "category", "slide_book_hot", "review_book"));
    }

    public function more_book()
    {
        $category = Category::orderBy("category_id", "DESC")->get();
        $book = Book::orderBy("book_id", "DESC")->where("book_status", 1)->paginate(8);
        $slide_book_hot = Book::orderBy("book_id", "DESC")->where("book_status", 1)->where("book_hot", 1)->take(8)->get();

        return view("pages.morebook")->with(compact("book", "category", "slide_book_hot"));
    }

    public function review_search(Request $request)
    {
        $data = $request->all();
        $search_keyword = $data["search_keyword"];
        $category = Category::orderBy("category_id", "DESC")->get();
        $slide_book_hot = Book::orderBy("book_id", "DESC")->where("book_status", 1)->where("book_hot", 1)->take(8)->get();
        $review_book = BookReview::where("review_status", 1)->where("review_title", "LIKE", "%" . $search_keyword . "%")->orWhere("review_description", "LIKE", "%" . $search_keyword . "%")->orWhere("review_content", "LIKE", "%" . $search_keyword . "%")->paginate(4);

        return view("pages.reviewbooksearch")->with(compact("category", "review_book", "slide_book_hot", "search_keyword"));
    }
}