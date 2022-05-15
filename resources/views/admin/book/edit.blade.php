@extends('layouts.app')

@section('content')
@include('layouts.navbar')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">Cập nhật sách.</div>
                
                @if ($errors->any())
                <div class="container mt-3">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                @if(session("status"))
                    <div class="container mt-3">
                        <div class="alert alert-success">
                            {{ session("status") }}
                        </div>
                    </div>
                @endif

                <div class="card-body">
                    <form method="POST" action="{{route('book.update', [$book->book_id])}}" enctype="multipart/form-data">
                        @method("PUT")
                        @csrf
                        <div class="mb-3">
                            <label for="book-name" class="form-label">Tên sách</label>
                            <input type="text" onkeyup="ChangeToKeyword()" class="form-control" id="input-name" value="{{$book->book_name}}" name="book-name">
                        </div>
                        <div class="mb-3">
                            <label for="book-desc" class="form-label">Tóm tắt sách</label>
                            <textarea rows="5" style="resize:none;" class="form-control" id="book-desc" name="book-desc">{{$book->book_description}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="book-cover" class="form-label">Bìa sách</label>
                            <input type="file" class="form-control-file" id="book-cover" name="book_cover">
                            <img src="{{asset('public/uploads/book-cover/'.$book->book_cover)}}" alt="{{ $book->book_name }}" class="book-cover-img">
                        </div>
                        <div class="mb-3">
                            <label for="book-author" class="form-label">Tác giả</label>
                            <input class="form-control" id="book-author" name="book_author" value="{{$book->book_author}}" placeholder="Nhập têm tác giả.">
                        </div>
                        <div class="mb-3">
                            <label for="input-keyword" class="form-label">Từ khóa sách</label>
                            <input type="text" class="form-control" id="input-keyword" value="{{$book->book_keyword}}" name="book_keyword">
                        </div>
                        <label for="category-id" class="form-label">Danh mục sách</label>
                        <select class="form-select mb-3" id="category-id" name="category-id">
                            @foreach ($category as $key => $category_item)
                            <option {{$category_item->category_id == $book->category_id ? 'selected' : ''}} value="{{$category_item->category_id}}">{{$category_item->category_name}}</option>
                            @endforeach
                           
                        </select>
                        <label for="book-status" class="form-label">Ẩn hoặc Hiện sách</label>
                        <select class="form-select mb-3" id="book-status" name="book-status">
                            @if ($book->book_status == 1)
                            <option value="1" selected>Hiện sách</option>
                            <option value="0">Ẩn sách</option>
                            @else
                            <option value="1">Hiện sách</option>
                            <option value="0" selected>Ẩn sách</option>
                            @endif
                        </select>
                        <label for="book-status" class="form-label">Sách Hot</label>
                        <select class="form-select mb-3" id="book-hot" name="book_hot">
                            @if ($book->book_hot != 1 || $book->hot_id != 0)
                                <option value="2">--- Chọn ---</option>
                                <option value="1">Hiện đang Hot</option>
                                <option value="0">Đã hết Hot</option>
                            @elseif($book->book_hot == 1)
                            <option value="1" selected>Hiện đang Hot</option>
                            <option value="0">Đã hết Hot</option>
                            @else
                            <option value="1">Hiện đang Hot</option>
                            <option value="0" selected>Đã hết Hot</option>
                            @endif
                        </select>
                        <button type="submit" name="add-book" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
