<?php
/**
 * @var \App\Models\User $user
 * @var \App\Models\Category $category
 */
?>
@extends('admin.layout')

@section('head')
    <link rel='stylesheet' type='text/css'
          href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.21.3/maps/maps.css'/>
    <script src='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.21.3/maps/maps-web.min.js'></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
            integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
@endsection

@section('content')
    <form action="{{route('admin.events.store')}}" method="post" class="pt-3">
        @csrf
        <div class="thumbnail"></div>
        <label for="thumbnail" class="form-label d-block">
            Upload thumbnail
            <input type="file" class="form-control mb-3 validation" name="thumbnail" accept="image/jpeg, image/png">
        </label>
        <input type="email" class="form-control mb-3" name="title" placeholder="Title">
        <textarea rows="5" class="form-control mb-3 validation" name="description"
                  placeholder="Event legend"></textarea>
        <div class="row mb-3">
            <div class="col-6">
                <select name="user_id" class="col-6 form-control validation">
                    <option disabled>-- Choose author --</option>
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <select name="category_id" class="col-6 form-control validation">
                    <option disabled>-- Choose category --</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <x-form.address-input/>
        <button class="btn btn-primary w-100 disabled" disabled>Save</button>
    </form>
@endsection

@section('inline-script')
    <script>
        (function ($) {
            $('input[type=file]').on('change', function (event) {
                if (event.target.files.length > 0) {
                    var src = URL.createObjectURL(event.target.files[0]),
                        image = new Image()

                    if ($('.thumbnail').length) {
                        $(image).addClass('img-fluid')
                        $(image).addClass('w-100')
                        $(image).attr('src', src)

                        $('.thumbnail').html(image.outerHTML)
                    }

                    if ($('.avatar').length) {
                        $('.avatar').css('background-image', 'url(' + src + ')')
                    }
                }

                $('form').dispatchEvent(new Event('check-form'))
            })

            $('form').on('check-form focusout', function () {
                $(this).find('.validation').each(function (i, el) {
                    if ($(el).data('error') === '1' || $(el).val().length === 0)
                        $(el).addClass('border-danger')
                })
            })
        })(jQuery)
    </script>
@endsection
