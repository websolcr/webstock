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
        '50': '#eff6ff',
        '100': '#dbeafe',
        '200': '#bfdbfe',
        '300': '#93c5fd',
        '400': '#60a5fa',
        '500': '#3b82f6',
        '600': '#2563eb',
        '700': '#1d4ed8',
        '800': '#1e40af',
        '900': '#1e3a8a',
      },
      indigo: {
        '500': '#6366f1',
      }
    },
    extend: {},
  }
}
