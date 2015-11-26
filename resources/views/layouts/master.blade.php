<html ng-app="koperasiku">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | Koperasi</title>
    <link rel="stylesheet" href="/semantic/semantic.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="/dist/koperasi.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="/dist/css/@yield('dist').css" media="screen" title="no title" charset="utf-8">
  </head>
  <body ng-controller="@yield('dist')">
    @yield('koperasi')
  </body>
  <script src="/jquery/jquery-2.1.4.js" charset="utf-8"></script>
  <script src="/semantic/semantic.js" charset="utf-8"></script>
  <script src="/angular/angular.js" charset="utf-8"></script>
  <script src="/angular/angular-route.js" charset="utf-8"></script>
  <script src="/dist/koperasi.js" charset="utf-8"></script>
  <script src="/dist/js/@yield('dist').js" charset="utf-8"></script>
</html>
