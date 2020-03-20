// tailwind.config.js
const { colors } = require('tailwindcss/defaultTheme')
module.exports = {
  theme: {
    extend: {
      boxShadow: {
        default: '0 0 5px 0 rgba(0, 0, 0, .08)'
      },
      colors: {
        gray: {
          ...colors.gray,
          '100': '#f5f6f9',
          '350': 'rgba(0, 0, 0, 0.4)',
        },
        blue: {
          ...colors.blue,
          '350': '#47cdff',
          '450': '#8ae2fe'
        }
      }
    },

  },
  variants: {},
  plugins: []
}