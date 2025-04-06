let flatpickrInstance;

export function initFlatpickr(mode = 'single') {
    const element = document.querySelector('.js-flatpickr-date');
    if (!element) return;

    if (flatpickrInstance) {
        flatpickrInstance.destroy();
    }

    flatpickrInstance = flatpickr(element, {
        mode,
        minDate: 'today',
        dateFormat: 'd-m-Y',
    });
}
