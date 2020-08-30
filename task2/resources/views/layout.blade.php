<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>getCode TASK2</title>
</head>
<body>
    <div id="menu">
        <div><a href="{{ route('home') }}">Home</a></div>
        <div><a href="{{ route('good_list') }}">Good list</a></div>
    </div>
    @yield('content')
</body>
</html>
