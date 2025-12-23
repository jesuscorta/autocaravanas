/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "./**/*.php",
    "./assets/src/js/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        pepito: "red", // color para los títulos
        resaltar: "#FDB900" // CTA y resaltados
      },
    },
  },
  plugins: [],
};
