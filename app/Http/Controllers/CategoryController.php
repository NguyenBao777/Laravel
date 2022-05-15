<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
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
        $category = Category::orderBy("category_id", "DESC")->paginate(6);
        return view('admin.category.index')->with(compact("category"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.category.create');
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
                "category-name" => "required|max:255",
                "category-keyword" => "required|max:255",
                "category-desc" => "required|max:255",
                "category-status" => "required"
            ],
            [
                "category-name.required" => "Vui lòng nhập tên cho danh mục.",
                "category-keyword.required" => "Vui lòng nhập từ khóa cho danh mục",
                "category-name.unique" => "Tên danh mục đã tồn tại.",
                "category-desc.required" => "Vui lòng nhập mô tả cho danh mục."
            ],

        );

        $category = new Category();
        $category->category_name = $data["category-name"];
        $category->category_description = $data["category-desc"];
        $category->category_status = $data["category-status"];
        $category->category_keyword = $data["category-keyword"];
        $category->save();

        return redirect()->back()->with("status", "Thêm danh mục thành công.");
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
        $category = Category::find($id);

        return view('admin.category.edit')->with(compact("category"));
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
                "category-name" => "required|max:255",
                "category-keyword" => "required|max:255",
                "category-desc" => "required|max:255",
                "category-status" => "required"
            ],
            [
                "category-name.required" => "Vui lòng nhập tên cho danh mục.",
                "category-keyword.required" => "Vui lòng nhập từ khóa cho danh mục.",
                "category-desc.required" => "Vui lòng nhập mô tả cho danh mục."
            ],

        );

        $category = Category::find($id);
        $category->category_name = $data["category-name"];
        $category->category_description = $data["category-desc"];
        $category->category_status = $data["category-status"];
        $category->category_keyword = $data["category-keyword"];
        $category->save();

        return redirect()->back()->with("status", "Cập nhật danh mục thành công.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();

        return redirect()->back()->with("status", "Xóa danh mục thành công.");
    }
}