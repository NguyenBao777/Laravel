
<h3>Sách Hot trong tuần</h3>
    
<div class="owl-carousel owl-theme my-4">
    @foreach ($slide_book_hot as $key => $slide_book) 
        <div class="item">
            <img src="{{asset("public/uploads/book-cover/$slide_book->book_cover")}}" alt="">
            <h4 class="text-center my-2">
                {{$slide_book->book_name}}
            </h4>
            <div class="d-flex justify-content-between align-items-center px-2">
                <span><ion-icon name="eye-outline"></ion-icon> {{$slide_book->book_view}}</span>
                <a href="{{url('book-detail/'.$slide_book->book_keyword)}}" class="btn btn-danger btn-sm">Đọc ngay</a>
            </div>
        </div>
    @endforeach
</div>