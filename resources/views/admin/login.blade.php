@extends('admin.layout')

@section('content')
    <form action="{{route('admin.loginAction')}}" method="POST" class="col-8 pt-3">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="d-block">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <input name="email" type="email" class="form-control mb-3" placeholder="Email">
        <input type="password" name="password" class="form-control mb-3" placeholder="Password">
        <input type="hidden" name="rememberme" value="0">
        <label for="rememberme" class="form-check-label mb-3">
            <input type="checkbox" name="rememberme" class="form-check-input" id="rememberme" value="1">
            remember me
        </label>
        @csrf
        <button class="btn btn-primary w-100" type="submit">Log in</button>
    </form>
@endsection
