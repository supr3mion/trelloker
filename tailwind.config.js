/** @type {import('tailwindcss').Config} */

const colors = require('tailwindcss/colors')

module.exports = {
  content: ['./page/*.{html,js,php}','./php/classes/*.{html,js,php}' , './node_modules/tw-elements/dist/js/**/*.js'],
  theme: {
    colors: {
      'onyx': '#404040',
      'white': '#FFFFFF',
      'blue_jeans': '#3BA4FF',
      'gainsboro': '#E0E0E0',
      'black': '#000000',
      'neutral': colors.neutral,
    },
    extend: {},
  },
  plugins: [
      require('tw-elements/dist/plugin'),vb gvgv
  ],
}
