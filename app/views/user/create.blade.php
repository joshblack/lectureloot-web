<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
</head>
<body>
  <!-- Flash Messages -->
  <div>
    @if (Session::has('success'))
      <h2>{{ Session::get('success') }}</h2>
    @endif
  </div>
  <div>
    @if (Session::has('error'))
      <h2>{{ Session::get('error') }}</h2>
    @endif
  </div>

  {{ Form::open(['route' => 'users.store']) }}

    <div>
      {{ Form::label('first_name', 'First Name') }}
      {{ Form::text('first_name') }}
    </div>
    <div>
      {{ Form::label('last_name', 'Last Name') }}
      {{ Form::text('last_name') }}
    </div>
    <div>
      {{ Form::label('email', 'Email Address') }}
      {{ Form::text('email') }}
    </div>
    <div>
      {{ Form::label('password', 'Password') }}
      {{ Form::password('password') }}
    </div>
    <div>{{ Form::submit() }}</div>
  {{ Form::close() }}
</body>
</html>