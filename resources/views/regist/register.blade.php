<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href={{ asset('/css/main.css') }}>

    <title>ユーザー登録フォーム</title>
</head>
<body>
{{ Form::open(['route'=>'register.post',"class"=>"form"]) }}
    <img src={{ asset('img/minup_logo.png') }} alt="logo" class="logo">
    <h2 class="center-title">サインアップ</h2>
    <div class="form-group">
        {{ Form::label('name','名前') }}
        {{ Form::text('name',null,['class'=>'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('email','メール') }}
        {{ Form::email('email',null,['class'=>'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('password','パスワード') }}
        {{ Form::password('password',['class'=>'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('password_confirmation','パスワード(確認)') }}
        {{ Form::password('password_confirmation',['class'=>'form-control']) }}
    </div>
    
    <div class="form-group">
        {{ Form::submit('サインアップ',['class'=>'form-control submit']) }}
    </div>

    {!! link_to_route('login','ログイン',[],['class'=>'small']) !!}
{{ Form::close() }}
</body>
</html>