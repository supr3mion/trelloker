/** @type {import('tailwindcss').Config} */

const colors = require('tailwindcss/colors')

module.exports = {
  darkMode: 'class',
  content: ['./page/*.{html,js,php}','./php/classes/*.{html,js,php}' , './node_modules/tw-elements/dist/js/**/*.js'],
  theme: {
    colors: {
      'onyx': '#404040',
      'white': '#FFFFFF',
      'blue_jeans': '#3BA4FF',
      'gainsboro': '#E0E0E0',
      'black': '#000000',
      'neutral': colors.neutral,
      'blue': colors.blue,
      'SS': '#7BC86C',
      'S': '#5AAC44',
      'SM': '#FAD29C',
      'M': '#FFAF3F',
      'ML': '#E79217',
      'L': '#EF7564',
      'XL': '#CF513D',
    },
    extend: {},
  },
  plugins: [
      require('tw-elements/dist/plugin'),
  ],
}
