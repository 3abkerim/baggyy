import { setupTabs } from './tabManager';
import { setupPlacesAutocomplete } from '../tools/googlePlaces/cityAutocompleteSetup';
import Alpine from 'alpinejs'

window.Alpine = Alpine
Alpine.start()

document.addEventListener('DOMContentLoaded', () => {
    setupTabs();
    setupPlacesAutocomplete().catch(error =>
        console.error('Google Maps failed to load:', error)
    );});
