<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name ="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
<body>
HEE
<ul>
    <li> <a href="{{ route ('temp') }}">Temp</a></li>
    <li> <a href="{{ route ('form') }}">Form</a></li>
{{--    <li> <a href="{{ route ('posts.index') }}">Blog Posts</a></li>--}}

</ul>
@yield('content')
</body>
</html>
