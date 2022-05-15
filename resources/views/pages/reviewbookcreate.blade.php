@extends('../layout')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center text-black">Thêm bài viết.</div>
                    
                    @if ($errors->any())
                    <div class="container mt-3">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif

                    @if(session("status"))
                        <div class="container mt-3">
                            <div class="alert alert-success">
                                {{ session("status") }}
                            </div>
                        </div>
                    @endif

                    <div class="card-body">
                        <form method="POST" action="{{route('book-review.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="review_title" class="form-label text-black">Tiêu đề bài đánh giá</label>
                                <input type="text" onkeyup="ChangeToKeyword()" class="form-control" id="input-name" value="{{old('book-name')}}" name="review_title" placeholder="Nhập tiêu đề bài đánh giá.">
                            </div>

                            <div class="mb-3">
                                <label for="review_desc" class="form-label text-black">Tóm tăt ngắn cho bài viết</label>
                                <input class="form-control" id="review_desc" name="review_desc" placeholder="Tóm tắt ngắn cho bài viết.">
                            </div>

                            <div class="mb-3">
                                <label for="review_content" class="form-label text-black">Nội dung bài đánh giá</label>
                                <textarea rows="5" style="resize:none;" class="form-control" id="review_content" value="{{old('book-desc')}}" name="review_content"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="review_image" class="form-label text-black">Hình ảnh bài viết</label>
                                <input type="file" class="form-control-file text-black" id="review_image" name="review_image">
                            </div>

                            <div class="mb-3">
                                <label for="review_user" class="form-label text-black">Người viết bài</label>
                                <input class="form-control" id="review_user" name="review_user" placeholder="Hãy để lại tên của bạn.">
                            </div>

                            <input type="hidden" class="form-control" id="input-keyword" name="review_keyword"> 
                            <input type="hidden" class="form-control" id="review_status" name="review_status" value="0"> 

                            <button type="submit" onclick="return confirm('Sau khi gửi bạn sẽ không thể chỉnh sửa bài viết nữa, vẫn muốn tiếp tục?')" name="review_create" class="btn btn-primary">Gửi bài</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection