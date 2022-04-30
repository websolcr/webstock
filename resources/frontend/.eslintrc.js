module.exports = {
  root: true,

  extends: [
    "plugin:vue/vue3-recommended",
    "prettier",
  ],

  plugins: ["prettier"],

  rules: {
    "no-console": process.env.NODE_ENV === "production" ? "error" : "off",
    "no-debugger": process.env.NODE_ENV === "production" ? "error" : "off",
    "prettier/prettier": ["error"],
    "vue/require-default-prop": 0,
    "vue/html-indent": ["error", 2],
    "vue/singleline-html-element-content-newline": 0,
    "vue/component-name-in-template-casing": ["error", "PascalCase"],
  },
};
