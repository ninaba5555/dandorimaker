@extends('layouts.helloapp')

@section('title', 'Task.Edit')

@section('header__btn--before')
    @if (isset($plan_id))
        <a href="/task?plan_id={{$plan_id}}" class="header__btn">
            <i class="fa fa-chevron-left"></i>
        </a><!--header__btn END-->
    @else
        <a href="/task" class="header__btn">
            <i class="fa fa-chevron-left"></i>
        </a><!--header__btn END-->
    @endif
@endsection

@section('header__btn--after')
    <div class="header__btnSpacer"></div>
@endsection

@section('content')
    <div class="section">
        <h2 class="section__ttl">編集</h2>
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
            <form class="form" action="/task/edit" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$form->id}}">
                <label><input type="text" name="title" value="{{$form->title}}" placeholder="タイトル"></label>
                <label><input type="text" name="message" value="{{$form->message}}" placeholder="メッセージ"></label>
                <label><input type="number" name="ideal" value="{{$form->ideal}}" placeholder="予想時間"><div class="form__label__unit">秒</div></label>
                <button class="form__btn">送信</button>
            </form>
        </div><!--panel END-->
    </div><!--section END-->
@endsection

@section('footer')
    copyright 2020 ○○○○.
@endsection
