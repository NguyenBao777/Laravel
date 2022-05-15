@extends('layouts.app')

@section('content')
@include('layouts.navbar')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">Cập nhật chapter.</div>
                
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
                    <form method="POST" action="{{route('chapter.update', [$chapter->chapter_id])}}" enctype="multipart/form-data">
                        @method("PUT")
                        @csrf
                        <div class="mb-3">
                            <label for="chapter-title" class="form-label">Tiêu đề</label>
                            <input type="text" onkeyup="ChangeToKeyword()" class="form-control" id="input-name" value="{{$chapter->chapter_title}}" name="chapter-title" placeholder="Nhập tiêu đề chapter.">
                        </div>
                        <div class="mb-3">
                            <label for="chapter-desc" class="form-label">Tóm tắt chapter</label>
                            <input type="text" class="form-control" value="{{$chapter->chapter_description}}" id="chapter-desc" name="chapter-desc">
                        </div>
                        <div class="mb-3">
                            <label for="chapter-content" class="form-label">Nội dung chapter</label>
                            <textarea rows="5" style="resize:none;" class="form-control" id="chapter-content" value="{{old('chapter-content')}}" name="chapter-content">{{$chapter->chapter_content}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="chapter-keyword" class="form-label">Từ khóa sách</label>
                            <input type="text" class="form-control" id="input-keyword" value="{{$chapter->chapter_keyword}}" name="chapter-keyword" placeholder="Từ khóa chapter.">
                        </div>
                        <label for="book-id" class="form-label">Thuộc sách</label>
                        <select class="form-select mb-3" id="book-id" name="book-id">
                            @foreach ($book as $key => $book_item)
                            <option {{$book_item->book_id == $chapter->book_id ? 'selected' : ''}} value="{{$book_item->book_id}}">{{$book_item->book_name}}</option>
                            @endforeach
                        </select>
                        <label for="chapter-status" class="form-label">Ẩn hoặc Hiện chapter</label>
                        <select class="form-select mb-3" id="chapter-status" name="chapter-status">
                            @if ($chapter->chapter_status == 1)
                            <option value="1" selected>Hiện chapter</option>
                            <option value="0">Ẩn chapter</option>
                            @else
                            <option value="1">Hiện chapter</option>
                            <option value="0" selected>Ẩn chapter</option>    
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
