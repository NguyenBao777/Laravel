<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookReview;
use App\Models\Book;
use App\Models\Category;
use Carbon\Carbon;

class BookReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $review_book = BookReview::orderBy("review_id", "DESC")->paginate(5);

        return view('admin.review-book.index')->with(compact("review_book"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::orderBy("category_id", "DESC")->get();
        $slide_book_hot = Book::orderBy("book_id", "DESC")->where("book_status", 1)->where("book_hot", 1)->take(8)->get();

        return view("pages.reviewbookcreate")->with(compact("slide_book_hot", "category"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                "review_title" => "required|max:255",
                "review_desc" => "required|max:255",
                "review_content" => "required",
                "review_image" => "required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1500,max-height=1500",
                "review_keyword" => "required",
                "review_status" => "required",
                "review_user" => "required",
            ],
            [
                "review_title.required" => "Vui lòng nhập tiêu đề bài viết.",
                "review_desc.require" => "Vui lòng nhập tóm tắt cho bài viết.",
                "review_content.required" => "Vui lòng nhập nội dung cho bài viết.",
                "review_image.required" => "Vui lòng thêm hình ảnh cho bài viết.",
                "review_keyword.required" => "Vui lòng nhập từ khóa.",
                "review_status.required" => "Vui lòng thêm trạng thái.",
                "review_status.required" => "Vui lòng thêm tên của bạn.",
            ],

        );

        $review_book = new BookReview();
        $review_book->review_title = $data["review_title"];
        $review_book->review_description = $data["review_desc"];
        $review_book->review_content = $data["review_content"];
        $review_book->review_keyword = $data["review_keyword"];
        $review_book->review_status = $data["review_status"];
        $review_book->review_user = $data["review_user"];
        $review_book->created_at = Carbon::now("Asia/Ho_Chi_Minh");

        $get_image = $request->review_image;
        $path = "public/uploads/review-image/";
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode(".", $get_name_image));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $review_book->review_image = $new_image;
        $review_book->save();

        return redirect()->back()->with("status", "Gửi bài viết thành công.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $review_book = BookReview::find($id);
        $category = Category::orderBy("category_id", "DESC")->get();
        $slide_book_hot = Book::orderBy("book_id", "DESC")->where("book_status", 1)->where("book_hot", 1)->take(8)->get();

        return view("pages.bookreviewdetail")->with(compact("review_book", "category", "slide_book_hot"));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $review_book = BookReview::find($id);

        return view('admin.review-book.edit')->with(compact("review_book"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
                "review_title" => "required|max:255",
                "review_desc" => "required|max:255",
                "review_content" => "required",
                "review_keyword" => "required",
                "review_status" => "required",
                "review_user" => "required",
                // "review_image" => "required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1500,max-height=1500",
            ],
            [
                "review_title.required" => "Vui lòng nhập tiêu đề bài viết.",
                "review_desc.require" => "Vui lòng nhập tóm tắt cho bài viết.",
                "review_content.required" => "Vui lòng nhập nội dung cho bài viết.",
                // "review_image.required" => "Vui lòng thêm hình ảnh cho bài viết.",
                "review_keyword.required" => "Vui lòng nhập từ khóa.",
                "review_status.required" => "Vui lòng thêm trạng thái.",
                "review_status.required" => "Vui lòng thêm tên của bạn.",
            ],

        );

        $review_book = BookReview::find($id);
        $review_book->review_title = $data["review_title"];
        $review_book->review_description = $data["review_desc"];
        $review_book->review_content = $data["review_content"];
        $review_book->review_keyword = $data["review_keyword"];
        $review_book->review_status = $data["review_status"];
        $review_book->review_user = $data["review_user"];
        $review_book->created_at = Carbon::now("Asia/Ho_Chi_Minh");

        $get_image = $request->review_image;
        if ($get_image) {
            $path = "public/uploads/review-image/" . $review_book->review_image;
            if (file_exists($path)) {
                unlink($path);
            }
            $path = "public/uploads/review-image/";
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode(".", $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $review_book->review_image = $new_image;
        }
        $review_book->save();

        return redirect()->back()->with("status", "Cập nhật thành công.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $review_book = BookReview::find($id);
        $path = "public/uploads/review-image/" . $review_book->review_image;
        if (file_exists($path)) {
            unlink($path);
        }
        BookReview::find($id)->delete();

        return redirect()->back()->with("status", "Xóa bài viết thành công.");
    }
}