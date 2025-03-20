export const initTripReturnDateToggle = () => {
    const returnTripCheckbox = document.getElementById('checkbox-return-trip');
    const returnDateContainer = document.querySelector('.js-return-date-div');
    const returnDateField = document.querySelector('.js-return-date-input');

    if (!returnTripCheckbox || !returnDateContainer || !returnDateField) return;

    updateReturnDateVisibility({
        checkbox: returnTripCheckbox,
        container: returnDateContainer,
        inputField: returnDateField,
    });

    returnTripCheckbox.addEventListener('change', () => {
        updateReturnDateVisibility({
            checkbox: returnTripCheckbox,
            container: returnDateContainer,
            inputField: returnDateField,
        });
    });
};

const updateReturnDateVisibility = ({ checkbox, container, inputField }) => {
    const isChecked = checkbox.checked;
    container.classList.toggle('invisible', !isChecked);
    container.classList.toggle('h-0', !isChecked);
    inputField.toggleAttribute('required', isChecked);
};
