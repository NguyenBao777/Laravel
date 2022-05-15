@extends('layouts.app')

@section('content')
@include('layouts.navbar')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">Liệt kê chapter.</div>

                @if (session('status'))
                    <div class="container mt-3">
                        <div class="alert alert-success">
                            {{ session("status") }}
                        </div>
                    </div>
                @endif
                <div class="card-body">

                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên chapter</th>
                                <th scope="col">Mô tả chapter</th>
                                <th scope="col">Thuộc truyện</th>
                                <th scope="col">Từ khóa chapter</th>
                                <th scope="col">Ẩn hoặc Hiện chapter</th>
                                <th class="text-center" scope="col">Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($chapter as $key => $chapter_item) 
                                <tr>
                                    <th scope="row">{{ $key }}</th>
                                    <td>{{ $chapter_item->chapter_title }}</td>
                                    <td>{{ $chapter_item->chapter_description }}</td>
                                    <td>{{ $chapter_item->book->book_name }}</td>
                                    <td>{{ $chapter_item->chapter_keyword }}</td>
                                    <td>
                                        @if($chapter_item->chapter_status == 1)
                                            <span class="text text-success">Đã hiện chapter</span>
                                        @else
                                            <span class="text text-danger">Đã ẩn chapter</span>
                                        @endif
                                    </td>
                                    <td class="text-center ">
                                        <a href="{{route('chapter.edit', [$chapter_item->chapter_id])}}" class="btn btn-success mb-2">
                                            <ion-icon name="create-outline"></ion-icon>
                                        </a>

                                        <form action="{{route('chapter.destroy', [$chapter_item->chapter_id])}}" method="POST">
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
                    <div class="d-flex justify-content-center align-items-center">
                        {{$chapter->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
