@include('layouts.module.header')

<!-- Navigation -->
@include('layouts.module.menu')

<!-- Masthead -->
<header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
                <form>
                    <div class="form-row">

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-link"></i></span>
                            </div>
                            @csrf
                            <input type="text" autocomplete="off" id="link" class="form-control form-control-lg" placeholder="Your link">
                            <div class="input-group-append">
                                <button onclick="GetLink();"  type="button" class="btn btn-block btn-lg btn-dark"><i class="fas fa-check"></i></button>
                            </div>
                        </div>

                        <div id="show-link" style="display: none;" class="col-md-12 mx-auto m-5 text-dark">

                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <h3>
                                            <a target="_blank" id="short-link" class="text-dark" href="/"><label id="short-link-title"></label></a>
                                            <button data-clipboard-target="#short-link" type="button" class="btn btn-dark btn-sm"><i class="far fa-copy"></i></button>
                                        </h3>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</header>



@include('layouts.module.footer')
