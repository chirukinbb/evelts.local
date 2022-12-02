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
                    <option disabled>-- Choose author --</option>
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <select name="category_id" class="col-6 form-control">
                    <option disabled>-- Choose category --</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <input type="text" class="form-control mb-3" name="address" placeholder="Enter address">
        <div class="d-none multitudes  mb-3">
            <select name="coordinates" class="col-6 form-control">
                <option disabled>-- Choose address --</option>
            </select>
        </div>
        <button class="btn btn-primary w-100 createEvent">Save</button>
    </form>
@endsection
