<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Lockscreen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- AdminLTE CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.css') }}">

    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css">

    {{-- OverlayScrollbars --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css">
</head>

<body class="lockscreen bg-body-secondary">

    <div class="lockscreen-wrapper">

        <div class="lockscreen-logo">
            <a href="{{ url('/') }}"><b>RSHP</b>UNAIR</a>
        </div>

        <div class="lockscreen-name">
            {{ Auth::user()->nama ?? 'Guest User' }}
        </div>

        <div class="lockscreen-item">

            <div class="lockscreen-image">
                <img src="{{ asset('assets/img/user1-128x128.jpg') }}" alt="User Image">
            </div>

            <form class="lockscreen-credentials" method="POST" action="{{ route('unlock') }}">
                @csrf
                <div class="input-group">
                    <input type="password" name="password" class="form-control" placeholder="password">
                    <div class="input-group-text bg-transparent px-1">
                        <button type="submit" class="btn shadow-none">
                            <i class="bi bi-box-arrow-right text-body-secondary"></i>
                        </button>
                    </div>
                </div>
            </form>

        </div>

        <div class="help-block text-center">
            Enter your password to retrieve your session
        </div>

        <div class="text-center mt-2">
            <a href="{{ route('login') }}">Or sign in as a different user</a>
        </div>

        <div class="lockscreen-footer text-center mt-3">
            Copyright © 2014–{{ date('Y') }}
            <b><a href="https://adminlte.io">AdminLTE.io</a></b>
            <br>All rights reserved
        </div>

    </div>

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js/adminlte.js') }}"></script>

</body>
</html>
