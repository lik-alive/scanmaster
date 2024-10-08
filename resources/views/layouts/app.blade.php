<!DOCTYPE html>
<html lang="ru" class='h-100'>

<head xmlns:og="http://ogp.me/ns#">
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="icon" href="{{ env('BASE_PATH') }}/favicon.ico" />

  <title>SCAN Master</title>
  <meta name="description" content="Shared environment for scanned documents" />

  <meta property="og:title" content="SCAN Master" />
  <meta property="og:url" content="{{ env('SITE_URL') }}" />
  <meta property="og:description" content="Shared environment for scanned documents" />
  <meta property="og:image" content="{{ env('SITE_URL') }}/charm.jpg" />
  <meta property="og:site_name" content="SCAN Master" />
  <meta property="og:type" content="website" />


  <link rel="stylesheet" href="{{ env('BASE_PATH') }}/plugins/bootstrap-icons.min.css">
  <link href="{{ env('BASE_PATH') }}/plugins/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ env('BASE_PATH') }}/styles.css">
</head>

<body class='bootstrap-dark d-flex flex-column h-100'>
  <main class='flex-shrink-0 mb-5'>
    <div class='text-center mb-3 mb-md-5'>
      <img class='logo mt-2 mt-md-4' src="{{ env('BASE_PATH') }}/logo.png" />

      @if(isset($_SESSION['user']))
      <a class='btn btn-dark me-2' href="{{ env('BASE_PATH') }}/logout" title='Выйти'>
        <i class="bi-door-closed" style="font-size:1.3rem"></i>
      </a>
      @endif
    </div>
    @yield('content')
  </main>

  <footer class='footer mt-auto py-2 px-3 text-center'>
    <?php echo date('Y') ?>-2022 — SCAN Master
    <span class='float-end'>©LIK</span>
  </footer>

  <script src="{{ env('BASE_PATH') }}/plugins/bootstrap.bundle.min.js"></script>
</body>

</html>