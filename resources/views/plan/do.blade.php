@extends('layouts.helloapp')

@section('title', 'Plan.Do')

@section('header__btn--before')
    <a href="/plan" class="header__btn">
        <i class="fa fa-chevron-left"></i>
    </a><!--header__btn END-->
@endsection

@section('header__btn--after')
    <div class="header__btnSpacer"></div>
    <script src="{{ asset('/js/common.js') }}"></script>
    <script src="{{ asset('/js/dateformat.js') }}"></script>
    <script src="{{ asset('/js/timer.js') }}"></script>
@endsection

@section('content')
    <div class="section">
        <h2 class="section__ttl">実行</h2>
        <div class="panel">
            <div class="panel__ttl">【プラン】{{$plan->title}}</div>
            <div class="panel__message">{{$plan->message}}</div>
            <div class="panel__info panel__info--del">
                <div class="panel__info__ideal">予想 {{$plan->s2m($plan->ideal)}}</div> ｜
                @if ($plan->reality == 0)
                    <div class="panel__info__reality">未実行</div>
                @else
                    <div class="panel__info__reality">実際 {{$plan->s2m($plan->reality)}}</div>
                @endif
            </div><!--panel__info END-->
        </div><!--panel END-->

        <div class="panel">
            <div class="panel__ttl">【実行タスク】{{$task->title}}</div>
            <div class="panel__message">{{$task->message}}</div>
            <div class="panel__info panel__info--del">
                <div class="panel__info__ideal">予想 {{$task->s2m($task->ideal)}}</div> ｜
                @if ($task->reality == 0)
                    <div class="panel__info__reality">未実行</div>
                @else
                    <div class="panel__info__reality">実際 {{$task->s2m($task->reality)}}</div>
                @endif
            </div><!--panel__info END-->

            <div id="timer" class="timer"></div>
            <button id="timer-btn" class="timer-btn" data-mode="start" onclick="timer({{$task->id}}, {{$task->ideal}})">
                開始
            </button>
        </div><!--panel END-->
    </div><!--section END-->


@endsection

@section('footer')
    copyright 2020 ○○○○.
@endsection
