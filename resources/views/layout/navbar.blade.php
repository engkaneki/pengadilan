@include('layout.head')
<header id="page-topbar">

    @include('layout.header')
</header>

<div class="hori-overlay"></div>

<div class="main-content">
    <div class="page-content">
        @yield('content')
    </div>

    @include('layout.footer')
