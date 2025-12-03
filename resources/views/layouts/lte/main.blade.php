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
        @yield('content')
    </main>

</div>

@include('layouts.lte.scripts')
@yield('scripts')

</body>
</html>
