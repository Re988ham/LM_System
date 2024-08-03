@extends('dashboard.layouts.app')

@section('guest')
    @if(\Request::is('login/forgot-password'))
        @include('dashboard.layouts.navbars.guest.nav')
        @yield('content')
    @else
        <div class="container position-sticky z-index-sticky top-0">
            <div class="row">
                <div class="col-12">
                    @include('dashboard.layouts.navbars.guest.nav')
                </div>
            </div>
        </div>
        @yield('content')
        @include('dashboard.layouts.footers.guest.footer')
    @endif
@endsection
