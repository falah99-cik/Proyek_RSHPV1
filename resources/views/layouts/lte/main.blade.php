<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.lte.head')
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

<div class="app-wrapper">

    @include('layouts.lte.navbar')

@if(Auth::check() && Auth::user()->isDokter())
    @include('layouts.lte.sidebar_dokter')

@elseif(Auth::check() && Auth::user()->isPerawat())
    @include('layouts.lte.sidebar_perawat')

@elseif(Auth::check() && Auth::user()->isResepsionis())
    @include('layouts.lte.sidebar_resepsionis')

@elseif(Auth::check() && Auth::user()->isPemilik())
    @include('layouts.lte.sidebar_pemilik')

@else
    {{-- Default sidebar untuk Administrator --}}
    @include('layouts.lte.sidebar')
@endif


    <main class="app-main">

        <div class="app-content-header px-4 mt-3">
            @yield('content-header')
        </div>

        <div class="app-content px-4">
            @yield('content')
        </div>

        @include('layouts.lte.footer')

    </main>

</div>

@include('layouts.lte.scripts')
@yield('scripts')

</body>
</html>
