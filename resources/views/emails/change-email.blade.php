<?php
/**
 * @var \App\Models\User $user
 */
?>
<table>
    <tr>
        <th style="text-align: left">Dear {{$user->name}},</th>
    </tr>
    <tr>
        <td>
            to complete the email change <a href="{{route('email',compact('code'))}}">click here</a>
        </td>
    </tr>
</table>
