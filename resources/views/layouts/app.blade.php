<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name')}} : @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css')}}">
    <!-- pour loader les icones de drapeaux -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.css" rel="stylesheet">

</head>

<body class="bg-dark-subtle">

    @php $langNavig = Request::server('HTTP_ACCEPT_LANGUAGE'); @endphp
    <!-- Pour get la langue du navigateur -->














    <nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
  <a class="navbar-brand" href="{{route('blog.index')}}">Forum des Étudiants</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
      <span class="navbar-toggler-icon m-2">MENU</span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">MENU</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            @guest
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('user.registration')}}">@lang('lang.signup')</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('login')}}">@lang('lang.login')</a>
          </li>
          @else
          <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard')}}">@lang('lang.account')</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('blog.index')}}">@lang('lang.forum')</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('document.index')}}">@lang('lang.documents')</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('logout')}}">@lang('lang.logout')</a>
          </li>
          @endguest
          <li class="nav-item">
          <a class="nav-link @if($langNavig=='en') bg-secondary @endif" href="{{route('lang', 'en')}}">En <i class="flag flag-united-states"></i></a>
          </li>
          <li class="nav-item">
          <a class="nav-link @if($langNavig=='fr') bg-secondary @endif" href="{{route('lang', 'fr')}}">Fr <i class="flag flag-france"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>














    @yield('content')
</body>
<script src="{{ asset('js/bootstrap.min.js')}}"></script>

</html>