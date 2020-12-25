@extends('layouts.helloapp')

@section('title', 'Task.Add')

@section('menubar')
    @parent
    新規作成ページ
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
    <form action="/task/add" method="post">
        <table>
            @csrf
            <tr>
                <th>プランID</th>
                @if (isset($plan_id))
                    <td>
                        {{$plan_id}}
                        <input type="hidden" name="plan_id" value="{{$plan_id}}"></td>    
                    </td>
                @else
                    <td><input type="text" name="plan_id" value="{{old('plan_id')}}"></td>
                @endif
            </tr>
            <tr>
                <th>Title</th>
                <td><input type="text" name="title" value="{{old('title')}}"></td>
            </tr>
            <tr>
                <th>Message</th>
                <td><input type="text" name="message" value="{{old('message')}}"></td>
            </tr>
            <tr>
                <th>Ideal</th>
                <td><input type="number" name="ideal" value="{{old('ideal')}}">秒</td>
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
