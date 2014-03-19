<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="/dist/css/production.min.css">
</head>
<body class="alternate-page">
  <nav class="main-nav main-nav__alternate">
    <div class="site-width">
      <span class="icon icon_hamburger"></span>
      <a href="/" class="logo logo--login">LectureLoot</a>
    </div>
  </nav>
  <div class="site-width content">
    @if (Session::has('success'))
      <h2>{{ Session::get('success') }}</h2>
    @endif
    @if (Session::has('error'))
      <h2>{{ Session::get('error') }}</h2>
    @endif
    {{ Form::open(['route' => 'users.store']) }}
        {{ Form::text('first_name', null,
          [
            'placeholder' => 'First Name',
            'class' => 'text-field'
          ])
        }}
        {{ Form::text('last_name', null,
          [
            'placeholder' => 'Last Name',
            'class' => 'text-field'
          ])
        }}
        {{ Form::text('email', null,
          [
            'placeholder' => 'Email Address',
            'class' => 'text-field'
          ])
        }}
        {{ Form::password('password',
          [
            'placeholder' => 'Password',
            'class' => 'text-field'
          ])
        }}
        <button class="submit--button submit--button__register" type="submit">Register</button>
    {{ Form::close() }}
  </div>
</body>
</html>