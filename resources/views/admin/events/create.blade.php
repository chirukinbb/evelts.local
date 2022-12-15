<?php
/**
 * @var \App\Models\User $user
 * @var \App\Models\Category $category
 * @var \App\Models\Tag $tag
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
    <style>
        .border-0:focus-visible {
            outline: none;
        }

        .border {
            border-radius: .375rem;
            padding: 0.375rem .75rem;
        }
    </style>
@endsection

@section('content')
    <form action="{{route('admin.events.store')}}" method="post" class="pt-3" enctype="multipart/form-data">
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
        <x-form.address-input address="" lat="0" lng="0"/>
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
        <div class="border mb-3" id="tagsCloud">
            <input type="text" class="border-0 tag-input">
        </div>
        <div class="submit">
            <button type="submit" class="btn btn-primary w-100 disabled" disabled>Save</button>
        </div>
    </form>
    <template id="tag">
        <div class="border d-inline-block me-2">
            <span class="name"></span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                 class="bi bi-x-circle close"
                 viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path
                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
            <input type="hidden" name="tags[]">
        </div>
    </template>
@endsection

@section('inline-script')
    <script>
        (function ($) {
            $('.tag-input').autocomplete({
                source: [
                    @foreach($tags as $tag)
                        '{{$tag->name}}',
                    @endforeach
                ]
            })

            $('.tag-input').on('keyup', function (event) {
                event.preventDefault()

                if (event.keyCode === 32) {
                    if ($(this).val().trim().length) {
                        let template = $.parseHTML($('#tag').clone().html())
                        $(template).find('span.name').text($(this).val().trim())
                        $(template).find('input').val($(this).val().trim())

                        $(this).closest('#tagsCloud').prepend(template)
                    }

                    $(this).val('')
                }
            })

            $('#tagsCloud').on('click', '.close', function () {
                $(this).closest('.border').remove()
            })

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

            $('#datepicker,#timepicker').on('change', function () {
                let date = $('#datepicker').datepicker('getDate'),
                    time = $('#timepicker').val(),
                    timestamp = date.setHours(time)

                $('input[name=planing_time]').val(timestamp)

                $('form')[0].dispatchEvent(new Event('check-form'))
            })

            $('.integer').on('keyup', function () {
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
