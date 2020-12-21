@extends('layouts.helloapp')

@section('title', 'Task.index')

@section('menubar')
    @parent
    インデックスページ
@endsection

@section('content')
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Message</th>
            <th>Ideal</th>
            <th>Reality</th>
        </tr>
        @foreach ($items as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->title}}</td>
                <td>{{$item->message}}</td>
                <td>{{$item->s2m($item->ideal)}}</td>
                <td>{{$item->s2m($item->reality)}}</td>
            </tr>
        @endforeach
    </table>
@endsection

@section('footer')
    copyright 2020 ○○○○.
@endsection
