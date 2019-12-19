@include('layouts.module.header')

<!-- Navigation -->
@include('layouts.module.menu')

<!-- Masthead -->
<header class="masthead">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-10 col-xl-9 mx-auto">

                <div class="card">
                    @yield('card-header')
                    <div class="card-body">
                        <h5 class="card-title">@yield('title')</h5>
                        @yield('content')
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>



@include('layouts.module.footer')
