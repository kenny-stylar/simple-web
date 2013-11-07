<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>
    {{ ( !empty($meta['title']) ) ? $meta['title'] : $title }}
  </title>
  <meta name="description" content="{{ $meta['description'] }}">
  <link href="http://getbootstrap.com/dist/css/bootstrap.css" rel="stylesheet">
  <link href="{{ URL::asset('css/common.css') }}" rel="stylesheet">
</head>
<body>
  <header id="header">
    <div class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <a href="{{ URL::route('index') }}" class="navbar-brand">Simple Web</a>
        </div>
        <nav class="navicontrol">
          <ul class="nav navbar-nav">
            <li><a href="{{ URL::route('user_register') }}">User</a></li>
            <li><a href="{{ URL::route('feed') }}">Feed</a></li>
            <li><a href="{{ URL::route('user_posts') }}">Post</a></li>
            <li><a href="{{ URL::route('cities') }}">Explore</a></li>
            <li><a href="{{ URL::route('system_category') }}">System</a></li>
          </ul>
        </nav>
      </div>
    </div>
    <div class="bs-header">
      <div class="container">
        <h1>{{ ( !empty($title) ) ? $title : "No Title" }}</h1>
        @if ( !empty($desc) )
        <p>{{ $desc }}</p>
        @endif
      </div>
    </div>
  </header>

  <div id="wrapper">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <nav id="sidebar">
            @yield('sidebar')
          </nav>
        </div>
        <div class="col-md-9">
          @yield('content')
        </div>
      </div>
    </div>
  </div>

  <footer id="footer">
    <div class="container">
      <div class="text-right">&copy; 2013.</div>
    </div>
  </footer>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  @if (isset($scripts) && is_array($scripts))
  @foreach ($scripts AS $script)
  <script src="{{ $script }}"></script>
  @endforeach
  @endif
</body>
</html>