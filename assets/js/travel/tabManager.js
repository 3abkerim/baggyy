import { initFlatpickr } from './flatpickrManager.js';

export const setupTabs = () => {
    const tabButtons = {
        oneWay: document.getElementById('one-way'),
        roundTrip: document.getElementById('round-trip')
    };

    const classStates = {
        active: ['bg-gray-100', 'text-black'],
        inactive: ['bg-white', 'hover:bg-gray-50', 'text-gray-500']
    };

    let currentTab = null;

    const updateElementClasses = (element, addClasses, removeClasses) => {
        removeClasses.forEach(cls => element.classList.remove(cls));
        addClasses.forEach(cls => element.classList.add(cls));
    };

    const activateTab = (tabKey) => {
        const newTab = tabButtons[tabKey];
        if (!newTab || newTab === currentTab) return;

        if (currentTab) {
            updateElementClasses(currentTab, classStates.inactive, classStates.active);
        }

        updateElementClasses(newTab, classStates.active, classStates.inactive);
        currentTab = newTab;

        const flatpickrMode = tabKey === 'roundTrip' ? 'range' : 'single';
        initFlatpickr(flatpickrMode);
    };

    const initializeTabs = () => {
        Object.values(tabButtons).forEach(button => {
            if (button) {
                updateElementClasses(button, classStates.inactive, classStates.active);
            }
        });

        Object.entries(tabButtons).forEach(([tabKey, button]) => {
            if (button) {
                button.addEventListener('click', () => activateTab(tabKey));
            }
        });

        activateTab('oneWay');
    };


    initializeTabs();
};
