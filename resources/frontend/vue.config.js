const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
  lintOnSave: false,
  devServer: {
    host: 'app.' + process.env.APP_URL
  }
})
