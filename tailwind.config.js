/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  darkMode: 'class', // enable dark mode via class
  theme: {
    extend: {
      colors: {
        primary: {
          DEFAULT: '#FD0103',
        },
      },
    },
  },
  plugins: [],
}

