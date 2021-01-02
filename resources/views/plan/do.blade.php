@extends('layouts.helloapp')

@section('title', 'Plan.Do')

@section('menubar')
    @parent
    実行ページ
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
    @if (count($errors) > 0)
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/plan/do" method="post">
        <table>
            @csrf
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
        <button class="start-btn" type="submit">開始</button>
    </form>
@endsection

@section('footer')
    copyright 2020 ○○○○.
@endsection
