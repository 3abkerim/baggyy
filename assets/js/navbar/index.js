document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.querySelector('[data-collapse-toggle]');
    const targetMenu = document.getElementById('navbar-sticky');

    toggleButton.addEventListener('click', function () {
        targetMenu.classList.toggle('hidden');
    });
});
