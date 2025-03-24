<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="topbar">
        <div class="home">
            <form action="{{ route('index') }}" method="get">
                <button>Go To Home</button>
            </form>
        </div>
        <div class="todo">
            <form action="{{ route('todo') }}" method="get">
                <button>Go To Todo</button>
            </form>
        </div>
    </div>
    @yield('content')
</body>
</html>