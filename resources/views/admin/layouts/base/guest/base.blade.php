@extends('admin.layouts.app')

@section('guest')
    @yield('content')
    @include('admin.layouts.footer.guest.footer')
@endsection
