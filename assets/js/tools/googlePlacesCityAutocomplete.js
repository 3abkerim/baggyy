export function initializeGooglePlacesAutocomplete({
    selector = '.city-autocomplete',
    country = null,
    types = ['(cities'],
    onPlaceSelected = null,
}) {
    const inputs = document.querySelectorAll(selector);

    inputs.forEach(input => {
        const options = {
            types: ['(cities)'],
        };

        if (country) {
            options.componentRestrictions = { country };
        }

        const autocomplete = new google.maps.places.Autocomplete(input, options);

        if (typeof onPlaceSelected === 'function') {
            autocomplete.addListener('place_changed', () => {
                const place = autocomplete.getPlace();
                const lat = place.geometry?.location?.lat();
                const lng = place.geometry?.location?.lng();
                const name = place.name;

                onPlaceSelected({
                    name,
                    lat,
                    lng,
                    place,
                    input,
                });
            });
        }
    });
}
