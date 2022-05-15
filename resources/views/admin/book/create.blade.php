@extends('layouts.app')

@section('content')
@include('layouts.navbar')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">Thêm sách.</div>
                
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
                    <form method="POST" action="{{route('book.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="book-name" class="form-label">Tên sách</label>
                            <input type="text" onkeyup="ChangeToKeyword()" class="form-control" id="input-name" vlaue="{{old('book-name')}}" name="book-name" placeholder="Nhập tên sách.">
                        </div>
                        <div class="mb-3">
                            <label for="book-desc" class="form-label">Tóm tắt sách</label>
                            <textarea rows="5" style="resize:none;" class="form-control" id="book-desc" vlaue="{{old('book-desc')}}" name="book-desc"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="book-cover" class="form-label">Bìa sách</label>
                            <input type="file" class="form-control-file" id="book-cover" name="book_cover">
                        </div>
                        <div class="mb-3">
                            <label for="book-author" class="form-label">Tác giả</label>
                            <input class="form-control" id="book-author" name="book_author" placeholder="Nhập têm tác giả.">
                        </div>
                        <div class="mb-3">
                            <label for="category-keyword" class="form-label">Từ khóa sách</label>
                            <input type="text" class="form-control" id="input-keyword" name="book_keyword" placeholder="Từ khóa sách"> 
                        </div>
                        <label for="category-id" class="form-label">Danh mục sách</label>
                        <select class="form-select mb-3" id="category-id" name="category-id">
                            @foreach ($category as $key => $category_item)
                            <option value="{{$category_item->category_id}}">{{$category_item->category_name}}</option>
                            @endforeach
                        </select>
                        <label for="book-status" class="form-label">Ẩn hoặc Hiện sách</label>
                        <select class="form-select mb-3" id="book-status" name="book-status">
                            <option value="1">Hiện sách</option>
                            <option value="0">Ẩn sách</option>
                        </select>
                        <input id="book-hot" name="book_hot" value="2" hidden>
                        <button type="submit" name="add-book" class="btn btn-primary">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
