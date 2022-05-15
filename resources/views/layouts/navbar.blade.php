<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('home')}}">Admin</a>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Quản lý danh mục
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('category.create')}}">Thêm danh mục</a>
                        <a class="dropdown-item" href="{{route('category.index')}}">Liệt kê danh mục</a>
                    </div>
                </li>
    
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sách - Truyện
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('book.create')}}">Thêm sách - truyện</a>
                        <a class="dropdown-item" href="{{route('book.index')}}">Liệt kê sách - truyện</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Chapter sách - truyện
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('chapter.create')}}">Thêm chapter sách - truyện</a>
                        <a class="dropdown-item" href="{{route('chapter.index')}}">Liệt kê chapter sách - truyện</a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('book-review.index')}}">Liệt kê Blogs & Review</a>
                </li>
            </ul>
 
        </div>
    </nav>  
</div>
