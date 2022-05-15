@extends('layouts.app')

@section('content')
@include('layouts.navbar')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">Liệt kê danh mục sách.</div>

                @if(session("status"))
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
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Từ khóa danh mục</th>
                                <th scope="col">Mô tả danh mục</th>
                                <th scope="col">Ẩn hoặc Hiện danh mục</th>
                                <th class="text-center" scope="col">Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category as $key => $category_item) 
                                <tr>
                                    <th scope="row">{{ $key }}</th>
                                    <td>{{ $category_item->category_name }}</td>
                                    <td>{{ $category_item->category_keyword }}</td>
                                    <td>{{ $category_item->category_description }}</td>
                                    <td>
                                        @if($category_item->category_status == 1)
                                            <span class="text text-success">Đã hiện danh mục</span>
                                        @else
                                        <span class="text text-danger">Đã ẩn danh mục</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('category.edit', [$category_item->category_id])}}" class="btn btn-success mb-2">
                                            <ion-icon name="create-outline"></ion-icon>
                                        </a>

                                        <form action="{{route('category.destroy', [$category_item->category_id])}}" method="POST">
                                        @method("DELETE")
                                        @csrf
                                        <button onclick="return confirm('Bạn chắc chắn muốn xóa mục này?')" class="btn btn-danger"><ion-icon name="trash-outline"></ion-icon></button>
                                        </form>
                                    </td>
                                    
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    
                    <div class="d-flex justify-content-center align-items-center">
                        {{$category->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
