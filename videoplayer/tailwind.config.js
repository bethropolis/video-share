/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class', 
  content: [
    "./index.html",
    "./src/**.{svelte,js}",
    "./src/**/*.{svelte,js}",
  ],
  theme: {
    extend: {},
  },
  plugins: [],

}

//