/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      screens: {
        'sm' : '470px',
        'md' : '550px',
        'lg' : '800px',
      },
    },
    maxWidth: {
      'desktop' : '1100px',
      'product' : '300px',
    },
    height: {
      'product' : '94px',
    },
  },
  plugins: [],
}
