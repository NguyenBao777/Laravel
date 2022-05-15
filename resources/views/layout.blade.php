<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Website đọc sách online.</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">   
    </head>
    <body class="">
        <div class="bg-dark menu-container">
            <div class="container">
                {{-- Menu --}}
                <nav class="navbar navbar-expand-lg navbar-dark  mb-4 menu-nav">
                    <a class="navbar-brand" href="{{url('/')}}">TuSachOnline.com</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                
                    <div class="collapse navbar-collapse d-md-flex justify-content-around" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{url('/')}}">Trang chủ</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Danh mục truyện
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach ($category as $key => $category_item)  
                                    <a class="dropdown-item" href="{{url('book-with-category/'.$category_item->category_keyword)}}">{{$category_item->category_name}}</a>
                                @endforeach
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Blogs & Review sách
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{url('book-review-home')}}">Xem bài viết</a>

                                <a class="dropdown-item" href="{{route('book-review.create')}}">Tạo bài viết của bạn</a>
                            </div>
                        </li>

                        <li class="nav-item">
                            <span class="nav-link text-muted font-weight-bold">Chuyển nền tối</span>
                        </li>
                        <li class="nav-item ">
                            <div class="select-theme position-relative">
                                <span class="select-btn"></span>
                            </div>
                        </li>
                    </ul>
                    <form autocomplete="off" class="form-inline d-flex my-2 my-lg-0" action="{{url('search')}}" method="POST">
                        @csrf <!---->
                        <input class="form-control mr-sm-2 mx-2 " type="search" id="search-keyword" name="search_keyword" placeholder="Tìm kiếm tác phẩm, tác giả" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><ion-icon name="search-outline"></ion-icon></button>
                        <div id="search-ajax"></div>
                    </form>
                    </div>
                </nav>
            </div>
        </div>
        <div class="container">
            <!--------------------------- Sách hot trong tuần --------------------------->
            @yield('slide')
            <!--------------------------- Sách mới cập nhật --------------------------->
            @yield('content')
        </div>
        <footer class="text-muted bg-black">
            <div class="container pb-4  ">
              <p class="float-right">
                <a href="#">Lên đầu trang</a>
              </p>
              <p>Sản phẩm này thuộc bản quền của NQBB.</p>
              
            </div>
        </footer>
    </body>
    {{-- Ionic Icon --}}
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    {{-- Bootstrap JS --}}
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/homemain.js') }}"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:false,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
        })
    </script>
    {{-- FB comment --}}
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0&appId=556967515325140&autoLogAppEvents=1" nonce="UfsEmG0r"></script>
</html>
