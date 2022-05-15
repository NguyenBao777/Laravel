@extends('../layout')
@section('slide')
    @include('pages.navbarhome')
@endsection
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="{{url('book-review-home')}}">Blog & Review sách</a></li>
        <li class="breadcrumb-item active" aria-current="page">Review sách hay: {{$review_book->review_title}}</li>
    </ol>
</nav>
<div class="row my-4 justify-content-center">
    <div class="col-md-12">
        <div class="row p-2">
            <div class="col-md-3">
                <img class="card-img-top" src="{{asset("public/uploads/review-image/$review_book->review_image")}}">
            </div>
            <div class="col-md-9">
                <h4 class= "">{{$review_book->review_title}}</h4>

                <p class="">{{$review_book->review_content}}</p>
                
                <h6 class="text-end font-italic">{{$review_book->review_user}}</h6>
            </div>
    </div>  
    <a href="{{url('book-review-home')}}" class="btn btn-danger btn-sm"><ion-icon name="arrow-undo-outline"></ion-icon><span class="px-2">Xem bài viết khác</span></a>
</div>
@endsection