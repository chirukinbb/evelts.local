@auth()
    <ul class="list-group">
        <li class="list-group-item">
            <a href="{{route('admin.dashboard')}}" class="nav-link">Dashboard</a>
        </li>
        @foreach($items as $routeName => $label)
            <li class="list-group-item">
                <a href="{{route('admin.'.$routeName.'.index')}}" class="nav-link">{{$label}}</a>
            </li>
        @endforeach
        <li class="list-group-item">
            <a href="{{route('admin.logout')}}" class="nav-link">Log out</a>
        </li>
    </ul>
@endauth
