@extends('layouts.app')

@section('logo')
<img src="{{ asset('img/logo.png') }}" width="100%" alt="">
@endsection

@section('content')
<div class="login-logo">
    <a href="{{ asset('assets') }}/index2.html"><b>Login</a>
</div>

<form action="{{ asset('assets') }}/index3.html" method="post">
    <div class="input-group mb-3">
        <input type="email" class="form-control" placeholder="Email">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
    </div>
    <div class="input-group mb-3">
        <input type="password" class="form-control" placeholder="Password">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
        </div>
        <!-- /.col -->
    </div>
</form>

@endsection

@push('script')

@endpush
