@extends('layouts.app')

@section('content')
@include('layouts.navbar')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">Chào mừng bạn đến với trang quản trị.</div>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="card-body">
                    <div class="row justify-content-around m-2">
                        <div class="card bg-info col-md-5">
                            <div class="card-body">
                              <h5 class="card-title">Bạn đang có tổng cộng</h5>
                              <h6 class="card-subtitle mb-2 text-white">{{count($book)}} đầu sách</h6>
                              <p class="card-text">Đang kích hoạt.</p>
                            </div>
                        </div>

                        <div class="card bg-danger col-md-5">
                            <div class="card-body">
                              <h5 class="card-title">Bạn đang có tổng cộng</h5>
                              <h6 class="card-subtitle mb-2 text-white">{{count($review_book)}} bài viết</h6>
                              <p class="card-text">Đang chờ duyệt.</p>
                            </div>
                        </div>

                    </div>
                    <!------------------------------- Table --------------------------------------->
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Bìa sách</th>
                                <th scope="col">Tên sách</th>
                                <th scope="col">Tình trạng sách</th>
                                <th scope="col">Lượt xem</th>
                                <th scope="col">Ngày đăng</th>
                                <th class="text-center" scope="col">Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($book as $key => $book_item) 
                                <tr>
                                    <th scope="row">{{ $key }}</th>
                                    <td>
                                        <img src="{{asset('public/uploads/book-cover/'.$book_item->book_cover)}}" alt="{{ $book_item->book_name }}" class="book-cover-img">
                                    </td>
                                    <td>{{ $book_item->book_name }}</td>
                                    <td>
                                        @if ($book_item->book_hot == 2)
                                            <span class="text-success">Sách mới cập nhật</span>
                                        @elseif ($book_item->book_hot == 1)
                                            <span class="text-danger">Sách đang Hot</span>
                                        @else
                                        <span class="text-info">Sách đã hết Hot</span>
                                        @endif
                                    </td>
                                    <td>{{ $book_item->book_view }}</td>
                                    <td>{{ $book_item->created_at->diffForHumans() }}</td>
                                    <td class="text-center ">
                                        <a href="{{route('book.edit', [$book_item->book_id])}}" class="btn btn-success mb-2">
                                            <ion-icon name="create-outline"></ion-icon>
                                        </a>

                                        <form action="{{route('book.destroy', [$book_item->book_id])}}" method="POST">
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
                     {{-- <div class="d-flex justify-content-center align-items-center">
                        {{$book->render()}}
                     </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
