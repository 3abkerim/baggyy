/** @type {import('tailwindcss').Config} */
export default {
    content: ['./templates/**/*.html.twig', './assets/**/*.js'],
    theme: {
        extend: {
            fontFamily: {
                myfont: ["'myfont'", 'sans-serif'],
            },
            colors: {
                primary: '#1E40AF',
            },
        },
    },
    plugins: [],
};
