<?php
/**
 * @var \App\Models\User $user
 */
?>
@extends('admin.layout')

@section('head')
    <style>
        .avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-size: cover;
            background-position: center;
            background-image: url("{{asset($user->data->avatar_url)}}");
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
            integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
@endsection

@section('content')
    <form action="{{route('admin.users.update',['user'=>$user->id])}}" method="post" class="pt-3"
          enctype="multipart/form-data">
        <x-form-message :errors="$errors"/>
        @csrf
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
    </form>
@endsection

@section('inline-script')
    <script>
        (function ($) {
            $('input[type=file]').on('change', function (event) {
                if (event.target.files.length > 0) {
                    const src = URL.createObjectURL(event.target.files[0])

                    $('.avatar').css('background-image', 'url(' + src + ')')

                    $('form')[0].dispatchEvent(new Event('check-form'))
                }
            })
        })(jQuery)
    </script>
@endsection
