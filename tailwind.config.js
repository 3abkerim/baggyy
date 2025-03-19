module.exports = {
    content: ['./assets/**/*.{js,jsx}', './templates/**/*.html.twig', './src/**/*.php'],
    darkMode: 'media', // Enable dark mode via class (optional)
    theme: {
        extend: {
            fontFamily: {
                myfont: ["'Papyrus'", 'sans-serif'], // Ensure correct font declaration
            },
            colors: {
                primary: '#1E40AF',
            },
        },
    },
    plugins: [],
};
