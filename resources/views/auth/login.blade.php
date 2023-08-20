<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href={{ asset('/css/main.css') }}>
    <title>ログインフォーム</title>
</head>
<body>
@isset($errors)
    <p style="color:red">{{ $errors->first('message') }}</p>
@endisset

{{ Form::open(['route'=>'login.post',"class"=>"form"]) }}
<img src={{ asset('img/minup_logo.png') }} alt="logo" class="logo">
<h2 class="center-title">ログイン</h2>
    <div class="form-group">
        {{ Form::label('email','メール') }}
        {{ Form::email('email',null,['class'=>'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('password','パスワード') }}
        {{ Form::password('password',['class'=>'form-control']) }}
    </div>
    <div class="remember-form-group">
        {{ Form::label('remember','ログイン状態を保持') }}
        {{ Form::checkbox('remember',1,false,['class'=>'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::submit('ログイン',['class'=>'form-control submit']) }}
    </div>

    {!! link_to_route('register','会員登録',[],['class'=>'small']) !!}
{{ Form::close() }}


</body>
</html>