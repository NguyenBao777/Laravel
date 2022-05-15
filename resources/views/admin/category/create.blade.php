@extends('layouts.app')

@section('content')
@include('layouts.navbar')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">Thêm danh mục sách.</div>
                
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
                    <form method="POST" action="{{route('category.store')}}">
                        @csrf
                        <div class="mb-3">
                            <label for="category-name" class="form-label">Tên danh mục</label>
                            <input type="text" onkeyup="ChangeToKeyword()" class="form-control" id="input-name" vlaue="{{old('category-name')}}" name="category-name" placeholder="Nhập tên danh mục.">
                        </div>
                        <div class="mb-3">
                            <label for="category-desc" class="form-label">Mô tả danh mục</label>
                            <input type="text" class="form-control" id="category-desc" vlaue="{{old('category-desc')}}" name="category-desc" placeholder="Mô tả danh mục.">
                        </div>
                        <div class="mb-3">
                            <label for="category-keyword" class="form-label">Từ khóa danh mục</label>
                            <input type="text" class="form-control" id="input-keyword" vlaue="{{old('category-keyword')}}" name="category-keyword" placeholder="Từ khóa danh mục.">
                        </div>
                        <label for="category-status" class="form-label">Ẩn hoặc Hiện danh mục</label>
                        <select class="form-select mb-3" id="category-status" name="category-status">
                            <option value="1">Hiện danh mục</option>
                            <option value="0">Ẩn danh mục</option>
                        </select>
                        <button type="submit" name="add-category" class="btn btn-primary">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
