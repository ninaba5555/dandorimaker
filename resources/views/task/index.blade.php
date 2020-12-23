@extends('layouts.helloapp')

@section('title', 'Task.Index')

@section('menubar')
    @parent
    インデックスページ
    @if (isset($plan_id))
        <a href="/task/add?plan_id={{$plan_id}}">プランのタスクを登録する</a>
    @else
        <a href="/task/add">タスクを登録する</a>
    @endif
@endsection

@section('content')
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Message</th>
            <th>Ideal</th>
            <th>Reality</th>
            <th>操作</th>
        </tr>
        @foreach ($items as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->title}}</td>
                <td>{{$item->message}}</td>
                <td>{{$item->s2m($item->ideal)}}</td>
                <td>{{$item->s2m($item->reality)}}</td>
                <td>
                    <a href="/task/edit?id={{$item->id}}">編集</a>｜
                    <a href="/task/del?id={{$item->id}}">削除</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection

@section('footer')
    copyright 2020 ○○○○.
@endsection
