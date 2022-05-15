@extends('../layout')
@section('slide')
    @include('pages.navbarhome')
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$category_id->category_name}}</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center">
        <h3>{{$category_id->category_name}}</h3>
        {{-- <a href="#" class="btn btn-success">Xem thêm</a> --}}
    </div>
    @php
        $count = count($book)    
    @endphp
    @if ($count == 0)
        <div class="col-md-12">
            <p class="text-center">Danh mục sách này hiện đang cập nhật bạn quay lại sau nhé.</p>
        </div>
    @else
        <div class="album py-5">
            <div class="container">
                <div class="row">
                    @foreach ($book as $key => $book_item)    
                        <div class="col-md-3">
                            <div class="card mb-4 box-shadow item-book">
                                <img class="card-img-top img-fluid" src="{{asset('public/uploads/book-cover/'.$book_item->book_cover)}}">
                                <div class="card-body">
                                    <h5 class="text-black text-truncate" title="{{$book_item->book_name}}">{{$book_item->book_name}}</h5>
                                    <p class="card-text text-muted">{{$book_item->book_description}}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                        <a href="{{url('book-detail/'.$book_item->book_keyword)}}" type="button" class="btn btn-sm btn-outline-secondary">Đọc ngay</a>
                                        <span class="text-muted px-2"><ion-icon name="eye-outline"></ion-icon> 50000</span>
                                        </div>
                                        <small class="text-muted">9 mins ago</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!--------------------------- Sách gợi ý --------------------------->

    <!--------------------------- Blogs && Review sách --------------------------->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Blogs & Review sách</h3>
        <a href="{{url('book-review-home')}}" class="btn btn-success">Xem thêm</a>
    </div>
    <div class="row mb-4">
        @foreach ($review_book as $key => $review_item) 
            <div class="col-md-6 d-flex bg-light">
                <div class="col-md-3 p-1">
                    <img src="{{asset('public/uploads/review-image/'.$review_item->review_image)}}" alt="{{$review_item->review_title}}" class="img-fluid">
                </div>
                <div class="col-md-9 p-1 d-flex flex-column justify-content-around align-items-end ">
                    <div class=" ">
                    <h4 class="text-black">{{$review_item->review_title}}</h4>
                    <p class="text-muted">{{$review_item->review_description}}</p>
                </div>
                <a href="{{route('book-review.show', [$review_item->review_id])}}" class="">Xem thêm <ion-icon name="arrow-forward-outline"></ion-icon></a>
                </div>
                
            </div>
        @endforeach
    </div>
@endsection