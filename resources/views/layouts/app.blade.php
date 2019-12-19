@include('layouts.module.header')

<!-- Navigation -->
@include('layouts.module.menu')

<!-- Masthead -->
<header class="masthead">
    <div class="overlay"></div>
    @yield('content')
</header>



@include('layouts.module.footer')
