<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.lte.head')
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

<div class="app-wrapper">

    @include('layouts.lte.navbar')

    @include('layouts.lte.sidebar')

    <main class="app-main">

        <div class="app-content-header px-4 mt-3">
            @yield('content-header')
        </div>

        <div class="app-content px-4">
            @yield('content')
        </div>

    </main>

</div>

@include('layouts.lte.scripts')
@yield('scripts')

</body>
</html>
