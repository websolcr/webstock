module.exports = {
  root: true,
  env: {
    node: true
  },
  extends: ['plugin:vue/recommended'],
  rules: {
    "no-console": process.env.NODE_ENV === "production" ? "error" : "off",
    "no-debugger": process.env.NODE_ENV === "production" ? "error" : "off",
    semi: [2, "never"],
    indent: ["error", 2]
  },
  parserOptions: {
    parser: "@babel/eslint-parser"
  },
  overrides: [
    {
      files: ["**/__tests__/*.{j,t}s?(x)"],
      env: {
        mocha: true
      }
    }
  ]
};
