import { setupTabs } from './tabManager';
import { initializeGooglePlacesAutocomplete } from '../tools/googlePlacesCityAutocomplete';

document.addEventListener('DOMContentLoaded', () => {
    setupTabs();

    initializeGooglePlacesAutocomplete({
        selector: '.city-autocomplete',
        country: null,
        onPlaceSelected: ({ name, lat, lng, input }) => {
            console.log(`Selected city: ${name}`);
            console.log(`Latitude: ${lat}, Longitude: ${lng}`);

            const prefix = input.classList.contains('departure') ? 'departure' : 'destination';
            const latInput = document.getElementById(`${prefix}-lat`);
            const lngInput = document.getElementById(`${prefix}-lng`);
            if (latInput && lngInput) {
                latInput.value = lat;
                lngInput.value = lng;
            }
        },
    });
});
