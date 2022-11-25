<?php
/**
 * @var \App\Models\User $user
 */
?>
@extends('admin.layout')

@section('content')
    <form action="{{route('admin.users.update',['user'=>$user->id])}}" method="post" class="pt-3">
        @csrf
        <div class="avatar-container d-flex justify-content-center">
            <div class="avatar"
                 @if($user->data->avatar_url) style="background-image: url("{{asset('avatars/'.$user->data->avatar_url)}}
            ")" @endif >
        </div>
        </div>
        <h3>{{$user->name}}</h3>
        <b class="mb-3">{{$user->email}}</b>
        @method('put')
        <label for="avatar" class="form-label d-block">
            Upload avatar
            <input type="file" class="form-control mb-3" name="avatar">
        </label>
        <textarea rows="5" class="form-control mb-3" name="description"
                  placeholder="User story">{{$user->data->description}}</textarea>
        <button class="btn btn-primary w-100">Save</button>
    </form>
@endsection
