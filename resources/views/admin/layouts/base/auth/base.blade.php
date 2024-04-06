@extends('admin.layouts.app')

@section('auth')
    <div class="min-height-300 bg-primary position-absolute w-100"></div>

    @include('admin.layouts.sidebar.auth.sidebar')

    <main class="main-content position-relative border-radius-lg ">

        <!-- Navbar -->
        @include('admin.layouts.navbar.auth.navbar')
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            @yield('content')

            <!-- Footer -->
            @include('admin.layouts.footer.auth.footer')
            <!-- End Footer -->
        </div>
    </main>
    @include('components.fixed-plugin')
@endsection








           