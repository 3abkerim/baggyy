import { initFlatpickr } from './flatpickrManager.js';

export function setupTabs() {
    const tabButtons = document.querySelectorAll('.tab-btn');
    const returnDateDiv = document.querySelector('.js-return-date-div');

    function activateTab(tabName) {
        if (returnDateDiv) {
            returnDateDiv.classList.toggle('invisible', tabName !== 'round-trip');
            returnDateDiv.classList.toggle('h-0', tabName !== 'round-trip');
        }

        initFlatpickr(tabName === 'round-trip' ? 'range' : 'single');

        tabButtons.forEach(btn => {
            const isActive = btn.dataset.tab === tabName;
            btn.classList.toggle('bg-gray-100', isActive);
            btn.classList.toggle('text-gray-900', isActive);
            btn.classList.toggle('bg-white', !isActive);
            btn.classList.toggle('hover:bg-gray-50', !isActive);
            btn.classList.toggle('text-gray-500', !isActive);
        });
    }

    tabButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            activateTab(btn.dataset.tab);
        });
    });

    activateTab('one-way');
}
