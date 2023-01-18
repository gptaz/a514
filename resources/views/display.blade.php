<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>KIT514</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

</head>
<body>
Hello {{$user->name}},
<br>

Here is your personal information :
<br>
<ul>
  <li>Name : {{$user->name}}</li>
  <li>Address : {{$user->address}}</li>
  <li>Balance : {{$user->balance}}</li>
  <li>Email : {{$user->email}}</li>
</ul>
<br>
<br>
<br>
<a href="{{route('out')}}">
    <span>Sign Out</span>
</a>
</body>

</html>
