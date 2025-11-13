
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield("title")</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <link rel="stylesheet" href='{{ asset('home/css/sb-admin-2.min.css') }}' />
   @livewireStyles()
</head>
<body>
    {{ $slot ?? '' }}
    <script src='{{ asset('home/js/jquery.min.js') }}'></script>
    <script src='{{ asset('home/js/sweetalert.js') }}'></script>
    <script src='{{ asset('home/js/bootstrap.bundle.js') }}'></script>
    @livewireScripts()
    @stack('scripts')
</body>

</html>