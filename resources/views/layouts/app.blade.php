<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Study MBBS in Europe | World-Class Medical Education')</title>
  <meta name="description" content="@yield('description', 'Pursue your dream of becoming a doctor by studying MBBS in Europe. Affordable tuition, globally recognized degrees, English-taught programs in Germany, Poland, Hungary, Czech Republic, Romania & Latvia.')">
  <meta name="keywords" content="MBBS in Europe, Study Medicine Europe, MBBS abroad, medical university Europe, MBBS Germany, MBBS Poland, MBBS Hungary, MBBS Romania">
  <meta property="og:title" content="Study MBBS in Europe | EuroMedStudy">
  <meta property="og:description" content="World-class medical education in Europe. Affordable, WHO recognized, English-taught MBBS programs.">
  <meta property="og:type" content="website">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet" />

  <!-- Main CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

  @stack('styles')
</head>
<body>

  @yield('content')

  <!-- Main JS -->
  <script src="{{ asset('js/script.js') }}"></script>
  @stack('scripts')
</body>
</html>
