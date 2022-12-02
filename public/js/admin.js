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
    })

    $('.createEvent').on('click', function (e) {
        const search = $(this).val(),
            addresses = []

        e.preventDefault()
        $(this).addClass('disable').attr('disable', true)

        $.get('https://api.tomtom.com/search/2/geocode/' + search + '.json?key=7NebNXQwwqgaSGZJGt0uhUnIBwrneGu8').then(r => {
            console.log(r)
            $(r.results).each((i, result) => {
                const {country, municipalitySubdivision, streetName, streetNumber} = result.address,
                    fullAddressParts = [country, municipalitySubdivision, streetName, streetNumber],
                    filteredAddressPart = []

                fullAddressParts.map(el => {
                    if (el !== undefined)
                        filteredAddressPart.push(el)
                })

                addresses.push(filteredAddressPart.join(' '))
            })

            switch (addresses.length) {
                case 0:
                    alert('Write another address of this place!')
                    $(this).removeClass('disable').attr('disable', false)
                    break
                case 1:
                    if (window.confirm('Do you mean this address?\n ' + addresses)) {
                        $('form').submit()
                    }
                    break
                default:
            }


        })
    })
})(jQuery)
