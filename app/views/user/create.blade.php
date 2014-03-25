<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
  <link rel="stylesheet" href="/dist/css/production.min.css">
</head>
<body class="alternate-page cbp-spmenu-push">
  <nav class="main-nav main-nav__alternate">
    <div class="site-width">
      <span id="showLeftPush" class="icon icon_hamburger"></span>
      <a href="/" class="logo logo--alternate">LectureLoot</a>
    </div>
  </nav>
  <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
    <h3 class="cbp-spmenu__alternate">Menu</h3>
    <a href="/"><span class="icon icon_home"></span> Home</a>
    <a href="/login">Login</a>
    <a href="/register">Register</a>
  </nav>
  <div class="site-width content">
    @if (Session::has('success'))
      <h2>{{ Session::get('success') }}</h2>
    @endif
    @if (Session::has('error'))
      <h2>{{ Session::get('error') }}</h2>
    @elseif (Session::has('validation-error'))
      @foreach (Session::get('validation-error')->all() as $message)
        <h2>{{ $message }}</h2>
      @endforeach
    @endif
    {{ Form::open(['route' => 'users.store']) }}
        {{ Form::text('first_name', null,
          [
            'placeholder' => 'First Name',
            'class' => 'text-field',
            'required'
          ])
        }}
        {{ Form::text('last_name', null,
          [
            'placeholder' => 'Last Name',
            'class' => 'text-field',
            'required'
          ])
        }}
        {{ Form::text('email', null,
          [
            'placeholder' => 'Email Address',
            'class' => 'text-field',
            'required'
          ])
        }}
        {{ Form::password('password',
          [
            'placeholder' => 'Password',
            'class' => 'text-field',
            'required'
          ])
        }}
        <button class="submit--button submit--button__register" type="submit">Register</button>
    {{ Form::close() }}
  </div>
  <script src="/dist/js/production.min.js"></script>
</body>
</html>