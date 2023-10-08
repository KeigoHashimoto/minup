<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>minUP</title>
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic" rel="stylesheet">     <link rel="stylesheet" href={{ asset('/css/main.css') }}>
</head>
<body>
    @include('commons.header')

    <div class="container">
        @include('commons.error')

        @yield('content')
    </div>
    
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src={{ mix('js/app.js') }}></script>
    <script src={{ asset('js/main.js') }}></script>
</body>
</html>