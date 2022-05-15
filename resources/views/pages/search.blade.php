@extends('../layout')
@section('slide')
    @include('pages.navbarhome')
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$search_keyword}}</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center">
        <h3>Kết quả tìm kiếm với từ khóa: {{$search_keyword}}</h3>
        {{-- <a href="#" class="btn btn-success">Xem thêm</a> --}}
    </div>
    @php
        $count = count($book)    
    @endphp
    @if ($count == 0)
        <div class="col-md-12">
            <p class="text-center">Không tìm thấy kết quả.</p>
        </div>
    @else
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    @foreach ($book as $key => $book_item)    
                        <div class="col-md-3">
                            <div class="card mb-4 box-shadow item-book">
                                <img class="card-img-top img-fluid" src="{{asset('public/uploads/book-cover/'.$book_item->book_cover)}}">
                                <div class="card-body">
                                    <h4>{{$book_item->book_name}}</h4>
                                    <p class="card-text">{{$book_item->book_description}}</p>
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
    <div class="d-flex justify-content-between align-items-center">
        <h3>Sách gợi ý cho Thớt</h3>
        <a href="#" class="btn btn-success">Xem thêm</a>
    </div>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top img-fluid" src="{{asset("public/images/momo-sakura-4.jpg")}}">
                        <div class="card-body">
                            <h4>1001 đêm</h4>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                <a href="#" type="button" class="btn btn-sm btn-outline-secondary">Đọc ngay</a>
                                <span class="text-muted px-2"><ion-icon name="eye-outline"></ion-icon> 50000</span>
                                </div>
                                <small class="text-muted">9 mins ago</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--------------------------- Blogs && Review sách --------------------------->
    <div class="d-flex justify-content-between align-items-center">
        <h3>Blogs & Review sách</h3>
        <a href="#" class="btn btn-success">Xem thêm</a>
    </div>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top img-fluid" src="{{asset("public/images/momo-sakura-4.jpg")}}">
                        <div class="card-body">
                            <h4>1001 đêm</h4>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                <a href="#" type="button" class="btn btn-sm btn-outline-secondary">Đọc ngay</a>
                                <span class="text-muted px-2"><ion-icon name="eye-outline"></ion-icon> 50000</span>
                                </div>
                                <small class="text-muted">9 mins ago</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection