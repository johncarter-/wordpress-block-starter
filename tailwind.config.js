const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  important: true,
  content: [
    ".functions.php",
    "./templates/**/*.{php,html,js}",
    "./blocks/**/*.{php,html,js}"
  ],
  theme: {
    extend: {
      colors: {},
      maxWidth: {
        ...defaultTheme.spacing,
      },
    },
    screens: {
      'xxs': '375px',
      'xs': '480px',
      'sm': '640px',
      'md': '768px',
      'lg': '1024px',
      'xl': '1280px',
      '2xl': '1536px',
    },
  },
  corePlugins: {
    aspectRatio: false,
    container: false,
  },
  plugins: [
    require('@tailwindcss/aspect-ratio'),
    require('@tailwindcss/forms'),
  ],
}
