<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} @yield('title')</title>

    <link href="{{ asset("css/app.css") }}" rel="stylesheet">
    <link href="{{ asset("css/common.css") }}" rel="stylesheet">
    @yield('header')
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Đăng ký</a>
                    </li>
                    @endif
                    @else
                    @can('be-admin')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="{{-- {{ route('admin.index') }} --}}">Quản Trị Viên</a>
                        </li>
                        @yield('dropdown-admin')
                    @endcan
                    @can('be-teacher')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="{{-- {{ route('teacher.index') }} --}}" data-toggle="dropdown">Giáo Viên</a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('teacher.test.list') }}">Quản Lý Đề Thi</a>
                                <a class="dropdown-item" href="{{ route('teacher.question.list') }}">Quản Lý Câu Hỏi</a>
                            </div>
                        </li>
                        @yield('dropdown-teacher')
                    @endcan

                    @can('be-student')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="{{-- {{ route('student.index') }} --}}" data-toggle="dropdown">Học Sinh</a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('student.test.list') }}">Available test</a>
                                <a class="dropdown-item" href="{{ route('student.about',Auth::user()->id) }}">Hồ Sơ</a>
                            </div>
                        </li>
                        @yield('dropdown-student')
                    @endcan

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->first_name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('register') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Đăng xuất
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</body>
<script src="{{ asset('/js/app.js') }}"></script>
@yield('end')
</html>
