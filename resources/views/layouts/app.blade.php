<x-laravel-ui-adminlte::adminlte-layout>
    @php
        $media = Auth::user()->getMedia();
        $image_url = count($media) == 0 ? "/assets/img/logo-jui-ig.webp" : $media[0]->getUrl('preview');
    @endphp

    <script src="https://unpkg.com/alpinejs" defer></script>
    
    {{-- @stack('third_party_scripts') --}}

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- Main Header -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            <img src="{{$image_url}}"
                                class="user-image img-circle elevation-2" alt="User Image">
                            <span class="d-none d-md-inline">{{ ucwords(Auth::user()->full_name) }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <!-- User image -->
                            <li class="user-header bg-primary">
                                <img src="{{$image_url}}"
                                    class="img-circle elevation-2" alt="User Image">
                                <p>
                                    {{ ucwords(Auth::user()->full_name) }}
                                    <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <a href={{route('home.profil')}} class="btn btn-default btn-flat">Profil</a>
                                <a href="#" class="btn btn-default btn-flat float-right" id="logoutAkun">
                                    Log out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            {{-- @include('chat') --}}
            <!-- Left side column. contains the logo and sidebar -->
            @include('layouts.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield('content')
            </div>

            <!-- Main Footer -->
            <footer class="main-footer">
                <strong>Copyright &copy; 2023 <a href="">Jui</a>.</strong> All rights
                reserved.
            </footer>
        </div>

        <script>
            function logoutClicked(){
                event.preventDefault(); 
                console.log('sss')
                if(document.querySelector('#chat-logout')!=null) document.querySelector('#chat-logout').click();
                document.getElementById('logout-form').submit();
            }
            document.querySelector("#logoutAkun").onclick = function(){
                logoutClicked();
            }
        </script>
    </body>
</x-laravel-ui-adminlte::adminlte-layout>
