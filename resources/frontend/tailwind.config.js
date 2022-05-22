module.exports = {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    colors: {
      white: '#ffffff',
      gray: {
        '100' : '#f3f4f6',
        '400' : '#a1a1aa',
        '500' : '#71717a',
        '600' : '#52525b',
        '900' : '#18181b',
      },
      blue: {
        50:'#f0f9ff',
        100:'#e0f2fe',
        200:'#bae6fd',
        300:'#7dd3fc',
        400:'#38bdf8',
        500:'#0ea5e9',
        600:'#0284c7',
        700:'#0369a1',
        800:'#075985',
        900:'#0c4a6e',
      },
      indigo: {
        '500': '#6366f1',
      },
      red: {
        '300' : '#de2e2e',
      }
    },
    extend: {},
  }
}
