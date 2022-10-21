<?php
/**
 * @var \App\Models\User $user
 */
?>
<table>
    <tr>
        <th>Dear {{$user->name}},</th>
    </tr>
    <tr>
        <td>
            you have been registered on the site <a href="{{route('home')}}">{{env('APP_NAME')}}</a>.
            To confirm yor email <a href="{{route('confirm',compact('slug'))}}">click here</a>
        </td>
    </tr>
    <tr>
        <td>Password: <b>{{$password}}</b></td>
    </tr>
</table>
