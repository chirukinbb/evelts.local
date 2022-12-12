<?php
/**
 * @var \Illuminate\Pagination\LengthAwarePaginator $events
 * @var \App\Models\Event $event
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
            <th scope="col">Author</th>
            <th scope="col">Location</th>
            <th scope="col" colspan="2">
                <a href="{{route('admin.events.create')}}" class="btn btn-secondary w-100">Add New</a>
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($events as $event)
            <tr>
                <th scope="row">{{$event->id}}</th>
                <td>{{$event->title}}</td>
                <td>{{$event->author->name}}</td>
                <td>{{$event->country->name}}, {{$event->point->name}}</td>
                <td>
                    <a href="{{route('admin.events.edit',['event'=>$event->id])}}"
                       class="btn btn-primary w-100">Edit</a>
                </td>
                <td>
                    <form action="{{route('admin.events.destroy',['event'=>$event->id])}}" method="post">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger w-100" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>{{$events->links()}}</tfoot>
    </table>
@endsection
