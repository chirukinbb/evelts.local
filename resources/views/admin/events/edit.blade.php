<?php
/**
 * @var \App\Models\User $user
 */
?>
@extends('admin.layout')

@section('content')
    <form action="{{route('admin.users.update',['user'=>$user->id])}}" method="post" class="pt-3"
          enctype="multipart/form-data">
        <x-form-message :errors="$errors"/>
        @csrf
        <style>
            .avatar-container {
                display: flex;
                justify-content: center;
            }

            .avatar {
                width: 100px;
                height: 100px;
                border-radius: 50%;
                background-size: cover;
                background-position: center;
                background-image: url("{{asset($user->data->avatar_url)}}");
            }
        </style>
        <div class="avatar-container d-flex justify-content-center">
            <div class="avatar"></div>
        </div>
        <h3 class="text-center">{{$user->name}}</h3>
        <b class="mb-3 d-block text-center">{{$user->email}}</b>
        @method('put')
        <label for="avatar" class="form-label d-block">
            Upload avatar
            <input type="file" class="form-control mb-3" name="avatar" accept="image/jpeg, image/png">
        </label>
        <textarea rows="5" class="form-control mb-3" name="description"
                  placeholder="User story">{{$user->data->description}}</textarea>
        <button class="btn btn-primary w-100">Save</button>
        <script>
            document.querySelector('input[type=file]').onchange = function (event) {
                if (event.target.files.length > 0) {
                    var src = URL.createObjectURL(event.target.files[0]);

                    document.querySelector('.avatar').style.backgroundImage = 'url(' + src + ')'
                }
            }
        </script>
    </form>
@endsection
