<header>
    <div>
        <p class="greet">こんにちは
            @if(Auth::check())
            {{ \Auth::user()->name}}さん</p>
            <nav>
                {!! link_to_route('logout','ログアウト',[],['class'=>'menu-item nav']) !!}
            </nav>

            <a href="/"><img src={{ asset('/img/minup_logo.png') }} alt="logo" class="header-logo"></a>

            <div class='menu'>
                {!! link_to_route('budget.index','ホームへ',[],['class'=>'menu-item']) !!}
                {!! link_to_route('budget.create','予算の作成',[],['class'=>'menu-item']) !!}
                {!! link_to_route('budget.month','月ごと一覧',[],['class'=>'menu-item']) !!}
                {!! link_to_route('tasks.index','タスクリスト',[],['class'=>'menu-item']) !!}
            </div>
            @else

            <a href="/"><img src={{ asset('/img/minup_logo.png') }} alt="logo" class="header-logo"></a>

            @endif
    </div>
</header>