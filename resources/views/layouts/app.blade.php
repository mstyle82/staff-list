<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('storage/rogo1.png') }}" alt="ロゴ" height="28" class="d-inline-block align-top">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>
                    <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto justify-content-left">
                                <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ url('/')}}">マイページ</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="{{ url('/dashboard')}}">ダッシュボード</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="{{ url('/conf-group')}}">各種設定</a>
                                </li>
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <div class="d-flex mx-3">

                                <img src="{{ asset('storage/' .Auth::user()->profile_image) }}" alt="プロフィール画像" class="rounded-circle mt-1" style="width: 35px;height: 35px;">
                                <!--<img src="storage/{{ Auth::user()->profile_image }}" alt="プロフィール画像" class="mt-1"  style="border-radius:50%"  height="32">-->
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                        </form>
                                    <a class="dropdown-item" href="{{ url('/edit-myprof') }}">
                                        プロフィール編集
                                    </a>
                                </div>
                                </div>
                            </li>
                        </ul>
                        @endguest
                </div>
            </div>
        </nav>
         <!--左カラム-->
                @if($toastr = session('flash_message'))
                <div class="toast" id="myToast">
                    <div class="alert alert-success text-center mb-0" role="alert">
                        {{ session('flash_message') }}
                    </div>
                </div>
                @elseif($toastr = session('flash_message1'))
                <div class="toast" id="myToast">
                    <div class="alert alert-danger text-center mb-0" role="alert">
                        {{ session('flash_message1') }}
                    </div>
                </div>
                @endif

                <script>
                    window.addEventListener('DOMContentLoaded', function(){
                    $("#myToast").toast({ delay: 3000 }).toast('show');
                    });
                </script>
        <div class="row mt-3">
        <div class="col-md-1"></div>
            <div class="col-xs-2 mx-3">
            <div class="card" style="width: 260px;">
                <div class="card-header" style="height: 50px;">
                <div class="row justify-content-between">
                <p class="mx-3 mt-1">社員一覧</p>
                <a class="mx-3 mt-1" href="https://mikami.naviiiva.work/staff-list/public/list-card"> <i class="far fa-solid fa-address-card"></i></a>
                </div>
                </div>
                <div class="card-body">
                     @foreach($groups as $group)
                             <h6 class="mt-3" offset-md-1><i class="far fa-solid fa-building">{{ $group->name }}</i></h6>
                         @foreach($grouplists as $grouplist)
                         @if($group->id == $grouplist->group_id)
                             <a href="{{ url('list/'.$grouplist->id) }}" class="card-text d-block elipsis offset-md-1">{{ $grouplist->name }}</a>
                         @endif
                         @endforeach
                     @endforeach
                     @foreach($grouplists as $grouplist)
                         @if(empty($grouplist->group_id))
                             <h6 class="mt-3">未所属</h6>
                             @if(empty($grouplist->group_id))
                                 <a href="{{ url('list/'.$grouplist->id) }}" class="card-text d-block elipsis offset-md-1">{{ $grouplist->name }}</a>
                             @endif
                         @endif
                     @endforeach
                </div>
            </div>
            </div>
            <div class="col-md-8">
                @yield('content')
            </div>
            <div class="col-md-1"></div>
        </div>
        <main class="py-4">
        </main>

</body>
</html>

