(function ($, tt) {

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
    })
})(jQuery, tt)
