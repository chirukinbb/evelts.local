<?php
/**
 * @var \App\Models\Category $category
 */
?>
@extends('admin.layout')

@section('content')
    <form action="{{route('admin.categories.update',['category'=>$category->id])}}" method="post" class="pt-3">
        @csrf
        @method('put')
        <input type="text" class="form-control mb-3" name="title" placeholder="Title" value="{{$category->title}}">
        <button class="btn btn-primary w-100">Update</button>
    </form>
@endsection
