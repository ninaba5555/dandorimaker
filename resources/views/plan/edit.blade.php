@extends('layouts.helloapp')

@section('title', 'Plan.Edit')

@section('menubar')
    @parent
    編集ページ
@endsection

@section('content')
    @if (count($errors) > 0)
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/plan/edit" method="post">
        <table>
            @csrf
            <input type="hidden" name="id" value="{{$form->id}}">
            <tr>
                <th>Title</th>
                <td><input type="text" name="title" value="{{$form->title}}"></td>
            </tr>
            <tr>
                <th>Message</th>
                <td><input type="text" name="message" value="{{$form->message}}"></td>
            </tr>
            <tr>
                <th>Ideal</th>
                <td><input type="number" name="ideal" value="{{$form->ideal}}">秒</td>
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
