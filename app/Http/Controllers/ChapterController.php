<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Book;
use Carbon\Carbon;

class ChapterController extends Controller
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
        $chapter = Chapter::with("book")->orderBy("book_id", "DESC")->paginate(5);

        return view("admin.chapter.index")->with(compact("chapter"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $book = Book::orderBy("book_id", "DESC")->get();

        return view("admin.chapter.create")->with(compact("book"));
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
                "chapter-title" => "required|max:255",
                "chapter-keyword" => "required|max:255",
                "chapter-desc" => "required|max:255",
                "chapter-status" => "required",
                "chapter-content" => "required",
                "book-id" => "required",
                // "chapter_cover" => "required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000"
            ],
            [
                "chapter-title.required" => "Vui lòng nhập tên cho chapter.",
                "chapter-keyword.required" => "Vui lòng nhập từ khóa cho chapter",
                "chapter-name.unique" => "Tên sách đã tồn tại.",
                "chapter-desc.required" => "Vui lòng nhập mô tả cho chapter.",
                "chapter-content.required" => "Vui lòng thêm nội dung chapter.",
                "book-id.required" => "Vui lòng nhập trường này."
            ],

        );

        $chapter = new Chapter();
        $chapter->chapter_title = $data["chapter-title"];
        $chapter->book_id = $data["book-id"];
        $chapter->chapter_description = $data["chapter-desc"];
        $chapter->chapter_content = $data["chapter-content"];
        $chapter->chapter_status = $data["chapter-status"];
        $chapter->chapter_keyword = $data["chapter-keyword"];
        $chapter->created_at = Carbon::now("Asia/Ho_Chi_Minh");
        // $get_image = $request->chapter_cover;
        // $path = "public/uploads/chapter-cover/";
        // $get_name_image = $get_image->getClientOriginalName();
        // $name_image = current(explode(".", $get_name_image));
        // $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        // $get_image->move($path, $new_image);
        // $chapter->chapter_cover = $new_image;
        $chapter->save();

        return redirect()->back()->with("status", "Thêm chapter thành công.");
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
        $chapter = Chapter::find($id);
        $book = Book::orderBy("book_id", "DESC")->get();

        return view("admin.chapter.edit")->with(compact("book", "chapter"));
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
                "chapter-title" => "required|max:255",
                "chapter-keyword" => "required|max:255",
                "chapter-desc" => "required|max:255",
                "chapter-status" => "required",
                "chapter-content" => "required",
                "book-id" => "required",
                // "chapter_cover" => "required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000"
            ],
            [
                "chapter-title.required" => "Vui lòng nhập tên cho chapter.",
                "chapter-keyword.required" => "Vui lòng nhập từ khóa cho chapter",
                "chapter-name.unique" => "Tên sách đã tồn tại.",
                "chapter-desc.required" => "Vui lòng nhập mô tả cho chapter.",
                "chapter-content.required" => "Vui lòng thêm nội dung chapter.",
                "book-id.required" => "Vui lòng nhập trường này."
            ],

        );

        $chapter = Chapter::find($id);
        $chapter->chapter_title = $data["chapter-title"];
        $chapter->book_id = $data["book-id"];
        $chapter->chapter_description = $data["chapter-desc"];
        $chapter->chapter_content = $data["chapter-content"];
        $chapter->chapter_status = $data["chapter-status"];
        $chapter->chapter_keyword = $data["chapter-keyword"];

        // $get_image = $request->chapter_cover;
        // $path = "public/uploads/chapter-cover/";
        // $get_name_image = $get_image->getClientOriginalName();
        // $name_image = current(explode(".", $get_name_image));
        // $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        // $get_image->move($path, $new_image);
        // $chapter->chapter_cover = $new_image;
        $chapter->save();

        return redirect()->back()->with("status", "Cập nhật chapter thành công.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Chapter::find($id)->delete();

        return redirect()->back()->with("status", "Xóa chapter thành công.");
    }
}