@include('layouts.header')

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
          
            @if (!(Request::url() === url('login')))
                @include('layouts.navbar')
                @include('layouts.sidebar')
            @endif
            
            @yield('content')
            
            @if (!(Request::url() === url('login')))
                @include('layouts.footer')
            @endif

            </div>
        </div>
    </body>
</html>
