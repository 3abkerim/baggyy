import { loadGoogleMaps } from './loadGoogleMaps';

function initializeGooglePlacesAutocomplete({
                                                selector = '.city-autocomplete',
                                                country = null,
                                                types = ['(cities)'],
                                                onPlaceSelected = null,
                                            }) {
    const inputs = document.querySelectorAll(selector);

    inputs.forEach(input => {
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
            }
        });

        const options = { types };

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

export async function setupPlacesAutocomplete() {
    const apiKey = process.env.GOOGLE_MAPS_API_KEY;
    await loadGoogleMaps(apiKey);

    initializeGooglePlacesAutocomplete({
        selector: '.city-autocomplete',
        country: null,
        onPlaceSelected: ({ name, lat, lng, input }) => {
            const prefix = input.classList.contains('departure') ? 'departure' : 'destination';
            const latInput = document.getElementById(`${prefix}-lat`);
            const lngInput = document.getElementById(`${prefix}-lng`);
            if (latInput && lngInput) {
                latInput.value = lat;
                lngInput.value = lng;
            }
        },
    });
}
