<?php
/**
 * @var \Illuminate\Pagination\LengthAwarePaginator $categories
 * @var \App\Models\Category $category
 */
?>
@extends('admin.layout')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col" colspan="2">
                <a href="{{route('admin.categories.create')}}" class="btn btn-secondary w-100">Add New</a>
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <th scope="row">{{$category->id}}</th>
                <td>{{$category->title}}</td>
                <td>
                    <a href="{{route('admin.categories.edit',['category'=>$category->id])}}"
                       class="btn btn-primary w-100">Edit</a>
                </td>
                <td>
                    <form action="{{route('admin.categories.destroy',['category'=>$category->id])}}" method="post">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger w-100" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>{{$categories->links()}}</tfoot>
    </table>
@endsection
