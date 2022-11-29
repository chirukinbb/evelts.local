<?php
/**
 * @var \Illuminate\Pagination\LengthAwarePaginator $users
 * @var \App\Models\User $user
 */
?>
@extends('admin.layout')

@section('content')
    <x-alert-message/>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col" colspan="2">
                <a href="{{route('admin.users.create')}}" class="btn btn-secondary w-100">Add New</a>
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr class="{{$user->email_verified_at ? 'text-success' : 'text-danger'}}">
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    <a href="{{route('admin.users.edit',['user'=>$user->id])}}"
                       class="btn btn-primary w-100">Edit</a>
                </td>
                <td>
                    <form action="{{route('admin.users.destroy',['user'=>$user->id])}}" method="post">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger w-100" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>{{$users->links()}}</tfoot>
    </table>
@endsection
