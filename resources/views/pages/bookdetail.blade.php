@extends('../layout')
@section('slide')
    @include('pages.navbarhome')
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{url('book-with-category/'.$book->category->category_keyword)}}">{{$book->category->category_name}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$book->book_name}}</li>
        </ol>
    </nav>
    <div class="row my-4">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-3">
                    <img class="card-img-top img-fluid like_img" src="{{asset("public/uploads/book-cover/$book->book_cover")}}">
                    
                    <div class="fb-like" data-href="http://localhost/laravel8/websach/book-detail/101-con-cho-dom" data-width="700" data-layout="standard" data-action="like" data-size="small" data-share="true">
                    </div>
                </div>
                <div class="col-md-9">
                    <ul class="book-info">
                        <li>Tác phẩm: <span class="text-primary">{{$book->book_name}}</span></li>
                        <li>Tác giả: <span class="text-primary">{{$book->book_author}}</span></li>
                        <li>Số chapter: <span class="text-primary">{{count($chapter)}} chapter</span></li>
                        <li>Lượt xem: <span class="text-primary">{{$book->book_view}} lượt</span></li>
                        <li>Ngày đăng: <span class="text-primary">{{$book->created_at->diffForHumans()}}</span></li>
                        <li>Số lượt xem: <span class="text-primary">{{$book->book_view}}</span></li>
                        <li class="mb-4">
                            @if ($chapter_last)
                            <a href="{{url('book-view-online/'.$chapter_last->chapter_keyword)}}">Xem Chapter mới nhất</a>
                            @else 
                            <span>Sách này chưa có chương mới.</span>
                            @endif
                        </li>
                        <li>
                            @if ($chapter_first)
                            <a href="{{url('book-view-online/'.$chapter_first->chapter_keyword)}}" class="btn btn-success">Đọc online</a>
                            @else
                            <span class="btn btn-dark">Sách chưa cập nhật chương</span>
                            @endif
                        </li>
                        <li class="like-btn-container">
                            {{-- <button class="btn-like btn btn-danger btn-sm my-2"><ion-icon name="heart-outline"></ion-icon> Yêu thích</button> --}}
                            <!----------------------- Lấy ra sách yêu thích ------------------------------------>
                            <input type="hidden" class="like_list_name" value="{{$book->book_name}}">
                            <input type="hidden" class="like_list_url" value="{{\URL::current()}}">
                            <input type="hidden" class="like_list_id" value="{{$book->book_id}}">
                            <!------------------------- Lấy ra sách yêu thích ------------------------------------>
                        </li>
                    </ul>
                    
                </div>
                
            </div>
            <div class="col-md-12">
                <p>{{$book->book_description}}</p>  
            </div>
            <hr>

            <div class="col-md-12">
                <h4>Mục Lục</h4>
                <ul class="book-list-chapter row">
                    @if (count($chapter) > 0)
                        @foreach ($chapter as $key => $chapter_item)
                            <li class="col-md-6">
                                <a href="{{url('book-view-online/'.$chapter_item->chapter_keyword)}}" class="text-decoration-none">
                                    {{$chapter_item->chapter_title}} 
                                    <span class="px-1">
                                        <ion-icon name="timer-outline"></ion-icon>
                                        {{date('d-m-Y', strtotime($chapter_item->created_at))}}
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    @else  
                        <li>Sách đang được cập nhật bạn hãy quay lại sau nhé.</li>
                    @endif
                </ul>
                
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h4>Sách cùng danh mục</h4>
                    <a href="{{url('book-with-category/'.$book->category->category_keyword)}}" class="btn btn-success">Xem thêm</a>
                </div>
                <div class="row">
                    @foreach ($book_with_category as $key => $book_with_category_item)   
                        <div class="col-md-4">
                                <div class="card mb-4 box-shadow item-book">
                                    <img class="card-img-top" src="{{asset("public/uploads/book-cover/$book_with_category_item->book_cover")}}">
                                    <div class="card-body">
                                        <h5 class="text-black text-truncate" title="{{$book_with_category_item->book_name}}">{{$book_with_category_item->book_name}}</h5>
                                        <p class="card-text text-muted">{{$book_with_category_item->book_description}}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                            <a href="{{url('book-detail/'.$book_with_category_item->book_keyword)}}" type="button" class="btn btn-sm btn-outline-secondary">Đọc ngay</a>
                                            <span class="text-muted px-2"><ion-icon name="eye-outline"></ion-icon> {{$book_with_category_item->book_view}}</span>
                                            </div>
                                            <small class="text-muted">{{$book_with_category_item->created_at->diffForHumans()}}</small>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-3">
            {{-- <div class="">
                <h3>Danh mục truyện</h3>

            </div> --}}
            <div id="list_book_liked">
                <h3 class="text-center">Sách đã thích</h3>
            </div>
        </div>
    </div>

    
@endsection