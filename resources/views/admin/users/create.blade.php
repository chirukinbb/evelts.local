<?php
/**
 * @var \App\Models\User $user
 */
?>
@extends('admin.layout')

@section('content')
    <form action="{{route('admin.users.store')}}" method="post" class="pt-3">
        <x-form-message :errors="$errors"/>
        @csrf
        <input type="email" class="form-control mb-3" name="email" placeholder="Email">
        <button class="btn btn-primary w-100">Save</button>
    </form>
@endsection
