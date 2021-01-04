@extends('layouts.helloapp')

@section('title', 'Plan')

@section('header__btn--before')
    <a href="/" class="header__btn">
        <i class="fa fa-chevron-left"></i>
    </a><!--header__btn END-->
@endsection

@section('header__btn--after')
    <a href="/plan/add" class="header__btn">
        <i class="fa fa-plus"></i>
    </a><!--header__btn END-->
@endsection

@section('content')
    <div class="section">
        <h2 class="section__ttl">一覧</h2>
        @foreach ($items as $item)
        <div class="panel">
            <div class="panel__ttl">{{$item->title}}</div>
            <div class="panel__message">{{$item->message}}</div>

            <div class="panel__action">
                <a href="/plan/edit?id={{$item->id}}" class="panel__action__btn">
                    <i class="fa fa-pencil"></i>
                    <div class="panel__action__btn__label">編集</div>
                </a>
                <a href="/plan/del?id={{$item->id}}" class="panel__action__btn">
                    <i class="fa fa-trash"></i>
                    <div class="panel__action__btn__label">削除</div>
                </a>
                <a href="/task?plan_id={{$item->id}}" class="panel__action__btn">
                    <i class="fa fa-calendar-check-o"></i>
                    <div class="panel__action__btn__label">タスク</div>
                </a>
                <a href="/plan/do?plan_id={{$item->id}}" class="panel__action__btn">
                    <i class="fa fa-caret-square-o-right"></i>
                    <div class="panel__action__btn__label">実行</div>
                </a>
            </div><!--panel__action END-->

            <div class="panel__info">
                <div class="panel__info__ideal">予想 {{$item->s2m($item->ideal)}}</div> ｜
                @if ($item->reality == 0)
                    <div class="panel__info__reality">未実行</div>
                @else
                    <div class="panel__info__reality">実際 {{$item->s2m($item->reality)}}</div>
                @endif
            </div><!--panel__info END-->
        </div><!--panel END-->
        @endforeach
    </div><!--section END-->
@endsection

@section('footer')
    copyright 2020 ○○○○.
@endsection
