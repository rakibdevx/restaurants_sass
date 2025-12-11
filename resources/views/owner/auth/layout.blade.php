
<!doctype html>
<html lang="en" class="light-theme">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="{{asset(setting('site_favicon'))}}">

  <!-- loader-->
  <link href="{{asset('/')}}backend/assets/css/pace.min.css" rel="stylesheet" />
  <script src="{{asset('/')}}backend/assets/js/pace.min.js"></script>

  <!--plugins-->
  <link href="{{asset('/')}}backend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />

  <!-- CSS Files -->
  <link href="{{asset('/')}}backend/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{asset('/')}}backend/assets/css/bootstrap-extended.css" rel="stylesheet">
  <link href="{{asset('/')}}backend/assets/css/style.css" rel="stylesheet">
  <link href="{{asset('/')}}backend/assets/css/icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

  <title>@stack('title') | {{setting('site_title')}}</title>
</head>

<body>

    <!--start wrapper-->
    <div class="wrapper">
        <div class="">
            @yield('body')
        <!--end row-->
        </div>
    </div>
    <!--end wrapper-->


</body>

</html>
