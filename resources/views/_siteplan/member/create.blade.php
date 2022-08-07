@extends('dashboard')
@section('title', 'Register Member')

@section('content')  
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">@yield('title')</h1>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('register.store') }}" id="form-register" method="POST">
        @csrf
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="name" name="name" id="name"  class="form-control form-control-sm" value="{{ old('name') }}" placeholder="Name" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" name="email" id="email"  class="form-control form-control-sm" value="{{ old('email') }}" placeholder="example@email.com">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" name="password" id="password"  class="form-control form-control-sm" value="{{ old('password') }}" placeholder="Encrypted">
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer">
        <button class="w-100 btn btn-sm btn-primary mt-3"  form="form-register" type="submit">Register</button>
    </div>
</div>
@stop