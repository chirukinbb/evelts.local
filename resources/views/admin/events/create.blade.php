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
    <form action="{{route('admin.events.store')}}" method="post" class="pt-3"  enctype="multipart/form-data">
        @csrf
        <x-form-message :errors="$errors"/>
        <div class="thumbnail"></div>
        <label for="thumbnail" class="form-label d-block">
            Upload thumbnail
            <input type="file" class="form-control mb-3 validation" name="thumbnail" accept="image/jpeg, image/png">
        </label>
        <input type="text" class="form-control mb-3 validation" name="title" placeholder="Title">
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
        <div class="row mb-3">
            <div class="col-4">
                <input type="number" class="form-control integer validation" placeholder="Event slots" name="slots">
            </div>
            <div class="col-4">
                <input type="text" class="form-control validation" id="datepicker" placeholder="Date & time of event">
                <input type="hidden" name="planing_time">
            </div>
            <div class="col-4">
                <select id="timepicker" class="form-control">
                    @for($i = 0;$i < 24;$i ++)
                        <option value="{{$i}}">{{$i > 9 ? $i : '0'.$i}}:00</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="submit">
            <button type="submit" class="btn btn-primary w-100 disabled" disabled>Save</button>
        </div>
    </form>
@endsection

@section('inline-script')
    <script>
        (function ($) {
            $('input[type=file]').on('change', function (event) {
                if (event.target.files.length > 0) {
                    const src = URL.createObjectURL(event.target.files[0]),
                        image = new Image();

                    $(image).addClass('img-fluid')
                    $(image).addClass('w-100')
                    $(image).attr('src', src)

                    $('.thumbnail').html(image.outerHTML)

                    $('form')[0].dispatchEvent(new Event('check-form'))
                }
            })

            $('form').on('check-form focusout', function () {
                if (validated() === 0)
                    $(this).find('button[type=submit]').removeClass('disabled').attr('disabled', false)
                else
                    $(this).find('button[type=submit]').addClass('disabled').attr('disabled', true)
            })

            $('#datepicker').datepicker({dateFormat: 'yy-mm-dd'})

            $('#datepicker,#timepicker').on('change',function () {
                let date = $('#datepicker').datepicker('getDate'),
                    time = $('#timepicker').val(),
                    timestamp = date.setHours(time)

                $('input[name=planing_time]').val(timestamp)

                $('form')[0].dispatchEvent(new Event('check-form'))
            })

            $('.integer').on('keyup',function () {
                $(this).val(parseInt($(this).val()))
            })

            function validated() {
                let input = 0

                $('.validation').each(function (i, el) {
                    if ($(el).attr('data-error') === '1' || ($(el).hasClass('form-control') && $(el).val().length === 0))
                        input++
                })

                return input
            }
        })(jQuery)
    </script>
@endsection
