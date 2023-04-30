<x-laravel-ui-adminlte::adminlte-layout>
    @php
        $media = Auth::user()->getMedia();
        $image_url = count($media) == 0 ? "http://bmkg.go.id/asset/img/logo/logo-bmkg.png" : $media[0]->getUrl('preview');
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
                                <a href={{route('home.profil')}} class="btn btn-default btn-flat">Profile</a>
                                <a href="#" class="btn btn-default btn-flat float-right"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Sign out
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

            <script type="text/javascript">
                var Tawk_API=Tawk_API||{}; 
                Tawk_API.visitor = {
                    name : '{!! Auth::user()->full_name !!}',
                    email : '{!! Auth::user()->email !!}',
                    phone: '{!! Auth::user()->phone !!}'
                };
                var Tawk_LoadStart=new Date();
                (function(){
                var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
                s1.async=true;
                s1.src='https://embed.tawk.to/644b873d4247f20fefee41a6/1gv3ggiuq';
                s1.charset='UTF-8';
                s1.setAttribute('crossorigin','*');
                s0.parentNode.insertBefore(s1,s0);
                })();
            </script>

            <!-- Main Footer -->
            <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                    <b>Version</b> 3.1.0
                </div>
                <strong>Copyright &copy; 2023 <a href="">Jui</a>.</strong> All rights
                reserved.
            </footer>
        </div>
    </body>
</x-laravel-ui-adminlte::adminlte-layout>
