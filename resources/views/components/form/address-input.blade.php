<div class="address-section validation" data-error="1">
    <div class="row">
        <div class="col-auto flex-grow-1">
            <input type="text" class="form-control mb-3" name="address"
                   placeholder="Enter address">
        </div>
        <div class="col-auto">
            <button class="btn btn-secondary check disabled" disabled>Check address</button>
        </div>
    </div>
    <p class="error text-danger"></p>
    <div class="d-none multitudes  mb-3">
        <select name="coordinates" class="mb-3 form-control">
            <option disabled>-- Choose address --</option>
        </select>
        <button class="btn btn-light another">No one!</button>
    </div>
    <div id="map-container"></div>
</div>
<script>
    (function ($, tt) {
        $('.address-section').on('click keyup change', function (event) {
            event.preventDefault()

            const address = $(this).find('input[name=address]').val()

            if (event.target.matches('input[name=address]')) {
                if (address.length) {
                    $(this).find('button.check').removeClass('disabled')
                        .attr('disabled', false)
                } else {
                    $(this).find('button.check').addClass('disabled')
                        .attr('disabled', true)

                    $('.address-section').attr('data-error', 1)
                }

                $(this).find('button.check').addClass('btn-secondary')
                    .removeClass('btn-success')
                    .text('Check address')

                $(this).find('p').text('')

                if (event.type === 'click') {
                    $('.address-section').attr('data-error', 1)
                    $('form')[0].dispatchEvent(new Event('check-form'))
                }
            }

            if (event.target.matches('button.check')) {
                $.get('https://api.tomtom.com/search/2/geocode/' + address + '.json?key={{env('TOM_TOM_GEOCODING_API_KEY')}}').then(r => {
                    switch (r.results.length) {
                        case 0:
                            $(this).find('p').text('Error! Try to type another address of this place')
                            break
                        case 1:
                            $(this).find('button.check').addClass('btn-success')
                                .removeClass('btn-secondary')
                                .attr('disabled', true)
                                .text('Checked!')

                            renderMap([r.results[0].position.lon, r.results[0].position.lat])
                            break
                        default:
                            $(r.results).each((i, result) => {
                                const {country, municipalitySubdivision, streetName, streetNumber} = result.address,
                                    fullAddressParts = [country, municipalitySubdivision, streetName, streetNumber],
                                    filteredAddressPart = [],
                                    option = document.createElement('option')

                                fullAddressParts.map(el => {
                                    if (el !== undefined)
                                        filteredAddressPart.push(el)
                                })

                                $(option).val(r.results[i].position.lon + ',' + r.results[i].position.lat)
                                $(option).text(filteredAddressPart.join(' '))

                                $('.multitudes select').append(option)
                            })

                            $(this).find('.row').addClass('d-none')
                            $(this).find('.multitudes').removeClass('d-none')
                    }
                })

            }

            if (event.target.matches('button.another')) {
                $(this).find('button.check').addClass('btn-secondary')
                    .removeClass('btn-success')
                    .text('Check address')

                $(this).find('input[name=address]').val()
                $(this).find('.multitudes select').html('')
                $(this).find('.row').removeClass('d-none')
                $(this).find('.multitudes').addClass('d-none')
            }

            if (event.target.matches('select[name=coordinates]')) {
                const coordinates = $(this).find('select[name=coordinates]').val()

                renderMap(coordinates.split(','))
            }

            function renderMap(coordinates) {
                const map = tt.map({
                    container: 'map-container',
                    key: '{{env('TOM_TOM_GEOCODING_API_KEY')}}',
                    center: coordinates,
                    zoom: 15
                })

                new tt.Marker().setLngLat(coordinates).addTo(map);

                $('#map-container').css('height', 400)
                $('#map-container').addClass('mb-3')
                $('.address-section').attr('data-error', 0)

                $('form')[0].dispatchEvent(new Event('check-form'))
            }
        })
    })(jQuery, tt)
</script>
