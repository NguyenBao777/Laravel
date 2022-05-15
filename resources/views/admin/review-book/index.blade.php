@extends('layouts.app')

@section('content')
@include('layouts.navbar')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">Liệt kê sách.</div>

                @if (session('status'))
                    <div class="container mt-3">
                        <div class="alert alert-success">
                            {{ session("status") }}
                        </div>
                    </div>
                @endif
                <div class="card-body">

                    <table class="table table-dark table-striped table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Tiêu đề</th>
                                <th scope="col">Tóm tắt</th>
                                <th scope="col">Nội dung</th>
                                <th scope="col">Tình trạng</th>
                                <th scope="col">Tạo lúc</th>
                                <th class="text-center" scope="col">Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($review_book as $key => $review_book_item) 
                                <tr>
                                    <th scope="row">{{ $key }}</th>
                                    <td>
                                        <img src="{{asset('public/uploads/review-image/'.$review_book_item->review_image)}}" alt="{{ $review_book_item->title }}" class="book-cover-img">
                                    </td>
                                    <td>{{ $review_book_item->review_title }}</td>
                                    <td>{{ $review_book_item->review_description }}</td>
                                    <td class="w-25">{{ $review_book_item->review_content }}</td>
                                    <td>
                                        @if($review_book_item->review_status == 1)
                                            <span class="text text-success">Đã duyệt bài</span>
                                        @else
                                        <span class="text text-danger">Chờ duyệt bài</span>
                                        @endif
                                    </td>
                                    <td>{{ $review_book_item->create_at }}</td>
                                    <td class="text-center ">
                                        <a href="{{route('book-review.edit', [$review_book_item->review_id])}}" class="btn btn-success mb-2">
                                            <ion-icon name="create-outline"></ion-icon>
                                        </a>

                                        <form action="{{route('book-review.destroy', [$review_book_item->review_id])}}" method="POST">
                                        @method("DELETE")
                                        @csrf
                                        <button onclick="return confirm('Bạn chắc chắn muốn xóa mục này?')" class="btn btn-danger">
                                            <ion-icon name="trash-outline"></ion-icon>
                                        </button>
                                        </form>
                                    </td> 
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!------------------------------- Table --------------------------------------->
                    <div class="d-flex justify-content-center align-items-center">
                        {{$review_book->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
