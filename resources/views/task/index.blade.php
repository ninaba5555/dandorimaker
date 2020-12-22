@extends('layouts.helloapp')

@section('title', 'Task.Index')

@section('menubar')
    @parent
    インデックスページ
    <a href="/task/add">新規登録</a>
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
                    <a href="/task/edit?id={{$item->id}}">編集</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection

@section('footer')
    copyright 2020 ○○○○.
@endsection
