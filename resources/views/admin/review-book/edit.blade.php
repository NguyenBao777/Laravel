@extends('layouts.app')

@section('content')
@include('layouts.navbar')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center text-black">Chỉnh sửa bài viết.</div>
                
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
                    <form method="POST" action="{{route('book-review.update',[$review_book->review_id])}}" enctype="multipart/form-data">
                        @method("PUT")
                        @csrf
                        <div class="mb-3">
                            <label for="review_title" class="form-label text-black">Tiêu đề bài đánh giá</label>
                            <input type="text" onkeyup="ChangeToKeyword()" class="form-control" id="input-name" value="{{$review_book->review_title}}" name="review_title" placeholder="Nhập tiêu đề bài đánh giá.">
                        </div>

                        <div class="mb-3">
                            <label for="review_desc" class="form-label text-black">Tóm tăt ngắn cho bài viết</label>
                            <input class="form-control" id="review_desc" name="review_desc" value="{{$review_book->review_description}}" placeholder="Tóm tắt ngắn cho bài viết.">
                        </div>

                        <div class="mb-3">
                            <label for="review_content" class="form-label text-black">Nội dung bài đánh giá</label>
                            <textarea rows="5" style="resize:none;" class="form-control" id="review_content" name="review_content">{{$review_book->review_content}}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="review_image" class="form-label text-black">Hình ảnh bài viết</label>
                            <input type="file" class="form-control-file text-black" id="review_image" name="review_image">
                            <img src="{{asset('public/uploads/review-image/'.$review_book->review_image)}}" alt="{{ $review_book->review_title }}" class="book-cover-img">
                        </div>
                        <div class="mb-3">
                            <label for="review_keyword" class="form-label text-black">Từ khóa bài viết</label>
                            <input type="text" class="form-control" id="input-keyword" value="{{ $review_book->review_keyword}}" name="review_keyword"> 
                        </div>

                        <div class="mb-3">
                            <label for="review_user" class="form-label text-black">Tên người viết</label>
                            <input type="text" class="form-control" id="review_user" value="{{ $review_book->review_user}}" disabled>
                            <input type="text" class="form-control" value="{{ $review_book->review_user}}" name="review_user" hidden>  
                        </div>


                        <label for="review_status" class="form-label">Duyệt</label>
                        <select class="form-select mb-3" id="review_status" name="review_status">
                            @if ($review_book->review_status == 1)
                            <option value="1" selected>Đã duyệt bài</option>
                            <option value="0">Không duyệt bài</option>
                            @else
                            <option value="1">Đã duyệt bài</option>
                            <option value="0" selected>Không duyệt bài</option>
                            @endif
                        </select>
                        {{-- <input type="hidden" class="form-control" id="review_status" name="review_status" value="0">  --}}

                        <button type="submit"  name="review_update" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
