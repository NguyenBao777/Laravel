@extends('../layout')
@section('slide')
    @include('pages.navbarhome')
@endsection
@section('content')
    <div class="row justify-content-between mb-4">
        <nav class="navbar justify-content-end">
            <form class="form-inline d-flex" action="{{url('review-search')}}" method="POST">
                @csrf
              <input class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm bài viết" aria-label="Search" name="search_keyword">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm</button>
            </form>
        </nav>
        @foreach ($review_book as $key => $review_item) 
            <div class="col-md-5 d-flex bg-light m-1">
                <div class="col-md-3 p-1">
                    <img src="{{asset('public/uploads/review-image/'.$review_item->review_image)}}" alt="{{$review_item->review_title}}" class="img-fluid">
                </div>
                <div class="col-md-9 p-1 d-flex flex-column justify-content-around align-items-end">
                    <div class=" ">
                    <h4 class="text-black">{{$review_item->review_title}}</h4>
                    <p class="text-muted">{{$review_item->review_description}}</p>
                    <h6 class="text-muted text-end">{{$review_item->review_user}}</h6>
                </div>
                <a href="{{route('book-review.show', [$review_item->review_id])}}" class="">Xem thêm <ion-icon name="arrow-forward-outline"></ion-icon></a>
                </div>
                
            </div>
        @endforeach

        <div class="d-flex justify-content-center align-items-center paginate">
            {{$review_book->render()}}
        </div>
    </div>
@endsection