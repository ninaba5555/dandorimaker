@extends('layouts.helloapp')

@section('title', 'Plan.Add')

@section('header__btn--before')
    <a href="/plan" class="header__btn">
        <i class="fa fa-chevron-left"></i>
    </a><!--header__btn END-->
@endsection

@section('header__btn--after')
    <div class="header__btnSpacer"></div>
@endsection

@section('content')
    <div class="section">
        <h2 class="section__ttl">登録</h2>
        <div class="panel">
            @if (count($errors) > 0)
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="form" action="/plan/add" method="post">
                @csrf
                <label><input type="text" name="title" value="{{old('title')}}" placeholder="タイトル"></label>
                <label><input type="text" name="message" value="{{old('message')}}" placeholder="メッセージ"></label>
                <label><input type="number" name="ideal" value="{{old('ideal')}}" placeholder="予想時間"><div class="form__label__unit">秒</div></label>
                <button class="form__btn">送信</button>
            </form>
        </div><!--panel END-->
    </div><!--section END-->
@endsection

@section('footer')
    copyright 2020 ○○○○.
@endsection
