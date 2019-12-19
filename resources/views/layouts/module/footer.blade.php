<!-- Footer -->
<footer class="footer bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
                <ul class="list-inline mb-2">
                    <li class="list-inline-item">
                        <a href="/page/terms-of-use">Terms of Use</a>
                    </li>
                    <li class="list-inline-item">&sdot;</li>
                    <li class="list-inline-item">
                        <a href="/page/privacy-policy">Privacy Policy</a>
                    </li>
                    <li class="list-inline-item">&sdot;</li>
                    <li class="list-inline-item">
                        <a href="/page/contact">Contact</a>
                    </li>
                </ul>
                <p class="text-muted small mb-4 mb-lg-0">&copy; {{ config('app.name', 'Laravel') }} 2019. All Rights Reserved.</p>
            </div>
            <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item mr-3">
                        <a href="{{ config('social.facebook', '#') }}">
                            <i class="fab fa-facebook fa-2x fa-fw"></i>
                        </a>
                    </li>
                    <li class="list-inline-item mr-3">
                        <a href="{{ config('social.twitter', '#') }}">
                            <i class="fab fa-twitter-square fa-2x fa-fw"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{ config('social.instagram', '#') }}">
                            <i class="fab fa-instagram fa-2x fa-fw"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="/themes/default/vendor/jquery/jquery.min.js"></script>
<script src="/themes/default/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/themes/default/js/app.js"></script>
@yield('js')
</body>

</html>
