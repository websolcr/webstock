<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="icon" href="/favicon.ico">
    <title>webstock</title>
  <script defer src="/js/chunk-vendors.js"></script><script defer src="/js/app.js"></script></head>
  <body>
    <noscript>
      <strong>We're sorry but webstock doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
    </noscript>
    <div id="app"></div>
    <!-- built files will be auto injected -->
    <form id="logout-form" action="/logout" method="POST" class="hidden">
        @csrf
    </form>
    <form id="load-home-form" action="/home" method="GET" class="hidden">
    </form>
  </body>
</html>
