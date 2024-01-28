/** @type {import('tailwindcss').Config} */

module.exports = {
  content: [ "./templates/**/*.{html,twig}","./assets/**/*.{js,ts,jsx,tsx}"],
  theme: {
    extend: {},
  },
  plugins: ['./assets/vendor/daisyui/daisyui.index.js'],
};
