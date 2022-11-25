@auth()
    <ul class="list-group">
        @foreach($items as $routeName => $label)
            <li class="list-group-item">
                <a href="{{route('admin.'.$routeName.'.index')}}" class="nav-link">{{$label}}</a>
            </li>
        @endforeach
    </ul>
@endauth
