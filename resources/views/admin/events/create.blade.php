<?php
/**
 * @var \App\Models\User $user
 * @var \App\Models\Category $category
 */
?>
@extends('admin.layout')

@section('content')
    <form action="{{route('admin.events.store')}}" method="post" class="pt-3">
        @csrf
        <div class="thumbnail"></div>
        <label for="thumbnail" class="form-label d-block">
            Upload thumbnail
            <input type="file" class="form-control mb-3" name="thumbnail" accept="image/jpeg, image/png">
        </label>
        <input type="email" class="form-control mb-3" name="title" placeholder="Title">
        <textarea rows="5" class="form-control mb-3" name="description"
                  placeholder="Event legend"></textarea>
        <div class="row mb-3">
            <div class="col-6">
                <select name="user_id" class="col-6 form-control">
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <select name="category_id" class="col-6 form-control">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button class="btn btn-primary w-100">Save</button>
        <script>
            document.querySelector('input[type=file]').onchange = function (event) {
                if (event.target.files.length > 0) {
                    var src = URL.createObjectURL(event.target.files[0]),
                        image = new Image()

                    image.classList.add('img-fluid')
                    image.classList.add('w-100')
                    image.src = src

                    document.querySelector('.thumbnail').innerHTML = image.outerHTML
                }
            }
        </script>
    </form>
@endsection
