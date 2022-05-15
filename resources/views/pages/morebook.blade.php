@extends('../layout')
@section('slide')
    @include('pages.navbarhome')
@endsection
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h3>Sách mới cập nhật</h3>
    </div>
    <div class="album py-5">
        <div class="container">

            <div class="row">
                @foreach ($book as $key => $book_item)    
                    <div class="col-md-3">
                        <div class="card mb-4 box-shadow item-book">
                            <img class="card-img-top" src="{{asset('public/uploads/book-cover/'.$book_item->book_cover)}}">
                            <div class="card-body">
                                <h5 class="text-black text-truncate" title="{{$book_item->book_name}}">{{$book_item->book_name}}</h5>
                                <p class="card-text text-muted">{{$book_item->book_description}}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{url('book-detail/'.$book_item->book_keyword)}}" type="button" class="btn btn-sm btn-outline-secondary">Đọc ngay</a>
                                        <span class="text-muted px-2"><ion-icon name="eye-outline"></ion-icon> 50000</span>
                                    </div>
                                    <small class="text-muted">{{$book_item->created_at->diffForHumans()}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                
            </div>
            <div class="d-flex justify-content-center align-items-center paginate">
                {{$book->render()}}
            </div>
        </div>
    </div>
    <!--------------------------- Sách gợi ý --------------------------->

    <!--------------------------- Blogs && Review sách --------------------------->

@endsection