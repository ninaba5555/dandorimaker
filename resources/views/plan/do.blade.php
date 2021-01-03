@extends('layouts.helloapp')

@section('title', 'Plan.Do')

@section('menubar')
    @parent
    実行ページ
    <script src="{{ asset('/js/dateformat.js') }}"></script>
    <script src="{{ asset('/js/timer.js') }}"></script>
@endsection

@section('content')
    プラン情報
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Message</th>
            <th>Ideal</th>
        </tr>
        <tr>
            <td>{{$plan->id}}</td>
            <td>{{$plan->title}}</td>
            <td>{{$plan->message}}</td>
            <td>{{$plan->s2m($plan->ideal)}}</td>
        </tr>
    </table>
    <hr />
    タスク情報
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Message</th>
            <th>Ideal</th>
        </tr>
        <tr>
            <td>
                {{$task->id}}
                <input type="hidden" name="task_id" value="{{$task->id}}">
            </td>
            <td>{{$task->title}}</td>
            <td>{{$task->message}}</td>
            <td>{{$task->s2m($task->ideal)}}</td>
        </tr>
    </table>
    <button id="timer-btn" class="timer-btn" data-mode="start" onclick="timer({{$task->id}})">
        開始
    </button>
@endsection

@section('footer')
    copyright 2020 ○○○○.
@endsection
