<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="home">SE G9</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else 
                            
                            @adminRole
                            <li>
                                <a class="nav-link" href="{{ route('users.index') }}">จัดการผู้ใช้งาน</a>
                            </li>
                            @endadminRole
                           
                            
                            @userRole
                            <li>
                                <a class="nav-link" href="#">userRole</a>
                                {{-- ทำแล้วมาเพิ่มในนี้นะ --}}
                            </li>
                            @enduserRole
                            
                            
                            @parcelRole
                            <li>
                                <!-- <a class="nav-link" href="#">parcelRole</a>  -->
                                {{-- ทำแล้วมาเพิ่มในนี้นะ --}}
                                <a class="nav-link" href="{{ route('durable.index') }}">{{ __('จัดการครุภัณฑ์') }}</a>
                            </li>
                            <li>
                                {{-- <a class="nav-link" href="{{ route('stocks.index') }}">เติมสต็อก(เดี๋ยวไปปุ่มในหน้าจัดการวัสดุ)</a> --}}

                                {{-- (เดี๋ยวไปปุ่มในหน้าจัดการวัสดุ) --}}
                            </li>
                            <li>
                                <a class="nav-link" href="{{ route('material.index') }}">{{ __('จัดการวัสดุ') }}</a>
                                
                                {{-- (เดี๋ยวไปปุ่มในหน้าจัดการวัสดุ) --}}
                            </li>
                            @endparcelRole
                            
                            
                            @technicianRole
                            <li>
                                <a class="nav-link" href="#">technicianRole</a> 
                                {{-- ทำแล้วมาเพิ่มในนี้นะ --}}
                            <li class="nav-item">
                                    <a class="nav-link" href="{{ route('repair.index') }}">{{ __('รายการซ่อม') }}</a>
                            </li>
                            <li class="nav-item">
                                    <a class="nav-link" href="{{ route('repair.history') }}">{{ __('ประวัติการซ่อม') }}</a>
                            </li>
                            @endtechnicianRole    
                            
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
    </div>
</body>
</html>
