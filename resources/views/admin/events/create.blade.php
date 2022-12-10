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
        <input type="email" class="form-control mb-3 validation" name="title" placeholder="Title">
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
        <button type="submit" class="btn btn-primary w-100 disabled" disabled>Save</button>
    </form>
@endsection

@section('inline-script')
    <script>
        (function ($) {
            $('input[type=file]').on('change', function (event) {
                if (event.target.files.length > 0) {
                    const src = URL.createObjectURL(event.target.files[0]),
                        image = new Image();

                    if ($('.thumbnail').length) {
                        $(image).addClass('img-fluid')
                        $(image).addClass('w-100')
                        $(image).attr('src', src)

                        $('.thumbnail').html(image.outerHTML)

                        $('form')[0].dispatchEvent(new Event('check-form'))
                    }

                    if ($('.avatar').length) {
                        $('.avatar').css('background-image', 'url(' + src + ')')
                    }

                    $('form')[0].dispatchEvent(new Event('check-form'))
                }
            })

            $('form').on('check-form focusout', function () {
                if (validated() === 0)
                    $(this).find('button').removeClass('disabled').attr('disabled',false)
                else
                    $(this).find('button').addClass('disabled').attr('disabled',true)
            })

            $('form').find('button[type=submit]').on('click',function (e) {
                if (validated()) {
                    e.preventDefault()

                    $('.validation').each(function (i, el) {
                        if ($(el).attr('data-error') === '1' || ($(el).hasClass('form-control') && $(el).val().length === 0))
                            $(el).addClass('border-danger')
                    })
                }
            })

            function validated() {
                let input = 0

                $('.validation').each(function (i, el) {
                    if ($(el).attr('data-error') === '1' || ($(el).hasClass('form-control') && $(el).val().length === 0))
                        input ++
                })
                console.log(input)

                return input
            }
        })(jQuery)
    </script>
@endsection
