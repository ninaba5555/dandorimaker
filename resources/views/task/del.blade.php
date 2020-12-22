@extends('layouts.helloapp')

@section('title', 'Task.Delete')

@section('menubar')
    @parent
    削除ページ
@endsection

@section('content')
    <form action="/task/del" method="post">
        <table>
            @csrf
            <input type="hidden" name="id" value="{{$form->id}}">
            <tr>
                <th>Title</th>
                <td>{{$form->title}}</td>
            </tr>
            <tr>
                <th>Message</th>
                <td>{{$form->message}}</td>
            </tr>
            <tr>
                <th>Ideal</th>
                <td>{{$form->s2m($form->ideal)}}</td>
            </tr>
            <tr>
                <th></th>
                <td><input type="submit" value="send"></td>
            </tr>
        </table>
    </form>
@endsection

@section('footer')
    copyright 2020 ○○○○.
@endsection
