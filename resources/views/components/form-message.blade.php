@if ($errors->any())
    <div class="alert alert-danger m-0 p-0">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="d-block">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
