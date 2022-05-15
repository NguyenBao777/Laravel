@extends('../layout')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{url('book-with-category/'.$book_breadcrumb->category->category_keyword)}}">{{$book_breadcrumb->category->category_name}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$book_breadcrumb->book_name}}</li>
        </ol>
    </nav>
    <div class="col-md-12 select-chapter-nav mb-4">
        <label for="select-chapter px-2">Chọn chương:</label>
        <a href="{{url('book-view-online/'.$prev_chapter)}}" class="btn-prev {{$chapter->chapter_id == $min_chapter_id->chapter_id ? 'hide' : ''}}" title="Prevous">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>

        <select name="select_chapter" id="select-chapter" class="form-control w-50">
            @foreach ($chapter_list as $key => $chapter_list_item)
            <option {{$chapter_list_item->chapter_keyword == $chapter->chapter_keyword ? "selected" : ""}} value="{{url('book-view-online/'.$chapter_list_item->chapter_keyword)}}">
                {{$chapter_list_item->chapter_title}}
            </option>
            @endforeach
        </select>
        
        <a href="{{url('book-view-online/'.$next_chapter)}}" class="btn-next {{$chapter->chapter_id == $max_chapter_id->chapter_id ? 'hide' : ''}}" title="Next">
            <ion-icon name="chevron-forward-outline"></ion-icon>
        </a>
    </div>
    <div class="col-md-12">
        <h3>{{$chapter->book->book_name}}</h3>
        <h5>Chương hiện tại: {{$chapter->chapter_title}}</h5>
        <p>{{$chapter->chapter_content}}</p>
    </div>
@endsection