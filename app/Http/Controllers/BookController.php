<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book = Book::with("category")->orderBy("book_id", "DESC")->paginate(5);

        return view('admin.book.index')->with(compact("book"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::orderBy('category_id', 'DESC')->get();


        return view('admin.book.create')->with(compact('category'));
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
                "book-name" => "required|max:255",
                "book_author" => "required|max:255",
                "book_keyword" => "required|max:255",
                "book_hot" => "required",
                "book-desc" => "required",
                "book-status" => "required",
                "category-id" => "required",
                "book_cover" => "required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1500,max-height=1500"
            ],
            [
                "book-name.required" => "Vui lòng nhập tên cho sách.",
                "book_author.require" => "Vui lòng nhập tên tác giả.",
                "book_keyword.required" => "Vui lòng nhập từ khóa cho sách",
                "book-name.unique" => "Tên sách đã tồn tại.",
                "book-desc.required" => "Vui lòng nhập mô tả cho sách.",
                "book_cover.required" => "Vui lòng thêm bìa sách.",
                "category-id.required" => "Vui lòng nhập trường này."
            ],

        );

        $book = new Book();
        $book->book_name = $data["book-name"];
        $book->category_id = $data["category-id"];
        $book->book_description = $data["book-desc"];
        $book->book_status = $data["book-status"];
        $book->book_keyword = $data["book_keyword"];
        $book->book_author = $data["book_author"];
        $book->book_hot = $data["book_hot"];
        $book->created_at = Carbon::now("Asia/Ho_Chi_Minh");
        $book->updated_at = Carbon::now("Asia/Ho_Chi_Minh");

        $get_image = $request->book_cover;
        $path = "public/uploads/book-cover/";
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode(".", $get_name_image));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $book->book_cover = $new_image;
        $book->save();

        return redirect()->back()->with("status", "Thêm sách thành công.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        $category = Category::orderBy('category_id', 'DESC')->get();

        return view('admin.book.edit')->with(compact("book", "category"));
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
                "book-name" => "required|max:255",
                "book_keyword" => "required|max:255",
                "book-desc" => "required",
                "book_hot" => "required",
                "book-status" => "required",
                "category-id" => "required",
                "book_author" => "required|max:255",
                // "book_cover" => "required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000"
            ],
            [
                "book-name.required" => "Vui lòng nhập tên cho sách.",
                "book_author.require" => "Vui lòng nhập tên tác giả.",
                "book_keyword.required" => "Vui lòng nhập từ khóa cho sách",
                "book-name.unique" => "Tên sách đã tồn tại.",
                "book-desc.required" => "Vui lòng nhập mô tả cho sách.",
                "category-id.required" => "Vui lòng nhập trường này."
                // "book_cover.required" => "Vui lòng thêm bìa sách.",
            ],

        );

        $book = Book::find($id);
        $book->book_name = $data["book-name"];
        $book->category_id = $data["category-id"];
        $book->book_description = $data["book-desc"];
        $book->book_status = $data["book-status"];
        $book->book_keyword = $data["book_keyword"];
        $book->book_author = $data["book_author"];
        $book->book_hot = $data["book_hot"];
        $book->updated_at = Carbon::now("Asia/Ho_Chi_Minh");

        $get_image = $request->book_cover;
        if ($get_image) {
            $path = "public/uploads/book-cover/" . $book->book_cover;
            if (file_exists($path)) {
                unlink($path);
            }
            $path = "public/uploads/book-cover/";
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode(".", $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $book->book_cover = $new_image;
        }
        $book->save();

        return redirect()->back()->with("status", "Cập nhật sách thành công.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $path = "public/uploads/book-cover/" . $book->book_cover;
        if (file_exists($path)) {
            unlink($path);
        }
        Book::find($id)->delete();

        return redirect()->back()->with("status", "Xóa sách thành công.");
    }
}