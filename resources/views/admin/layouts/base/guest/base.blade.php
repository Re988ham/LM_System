@extends('admin.layouts.app')

@section('guest')
    @yield('content')
    @yield('css')
    @yield('js')
    @include('admin.layouts.footer.guest.footer')
@endsection
