export function loadGoogleMaps(apiKey) {
    return new Promise((resolve, reject) => {
        if (typeof window.google !== 'undefined') {
            resolve(window.google);
            return;
        }

        const script = document.createElement('script');
        script.src = `https://maps.googleapis.com/maps/api/js?key=${apiKey}&libraries=places`;
        script.async = true;
        script.defer = true;
        script.onload = () => resolve(window.google);
        script.onerror = reject;

        document.head.appendChild(script);
    });
}
