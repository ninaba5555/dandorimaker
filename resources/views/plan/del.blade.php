@extends('layouts.helloapp')

@section('title', 'Plan.Delete')

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
        <h2 class="section__ttl">削除</h2>
        <div class="panel">
            <form class="form" action="/plan/del" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$form->id}}">
                <div class="panel__ttl">{{$form->title}}</div>
                <div class="panel__message">{{$form->message}}</div>
                <div class="panel__info panel__info--del">
                    <div class="panel__info__ideal">予想 {{$form->s2m($form->ideal)}}</div> ｜
                    @if ($form->reality == 0)
                        <div class="panel__info__reality">未実行</div>
                    @else
                        <div class="panel__info__reality">実際 {{$form->s2m($form->reality)}}</div>
                    @endif
                </div><!--panel__info END-->
                <button class="form__btn form__btn--del">削除</button>
            </form>
        </div><!--panel END-->
    </div><!--section END-->
@endsection

@section('footer')
    copyright 2020 ○○○○.
@endsection
