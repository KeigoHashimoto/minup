<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>minUP</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p&display=swap" rel="stylesheet">
    <link rel="stylesheet" href={{ asset('/css/main.css') }}>
</head>
<body>
    @include('commons.header')

    <div class="container">
        @include('commons.error')

        @yield('content')
    </div>
    
    <script src={{ asset('js/main.js') }}></script>
</body>
</html>