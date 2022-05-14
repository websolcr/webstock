export default (app) => {
  const Pusher = require('pusher-js')
  app.config.globalProperties.$pusher = new Pusher(process.env.VUE_APP_PUSHER_APP_KEY, {
    cluster: process.env.VUE_APP_PUSHER_APP_CLUSTER,
    channelAuthorization: {
      endpoint: "api/broadcasting/auth",
    },
  })
}
