<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $items = Task::all();
        return view('task.index', ['items' => $items]);
    }

    public function add(Request $request)
    {
        return view('task.add');
    }

    public function create(Request $request)
    {
        $this->validate($request, Task::$rules);
        $task = new Task;
        $form = $request->all();
        unset($form['_token']);

        // TODO: 未入力カラムの初期値設定方法について調べる
        // TODO: messageカラムは任意入力にしたい
        // TODO: 分秒入力にしたい

        $form['reality'] = 0;
        $task->fill($form)->save();
        return redirect('/task');
    }

    public function edit(Request $request)
    {
        $task = Task::find($request->id);
        return view('task.edit', ['form' => $task]);
    }

    public function update(Request $request)
    {
        $this->validate($request, Task::$rules);
        $task = Task::find($request->id);
        $form = $request->all();
        unset($form['_token']);
        $task->fill($form)->save();
        return redirect('/task');
    }

    public function delete(Request $request)
    {
        $task = Task::find($request->id);
        return view('task.del', ['form' => $task]);
    }

    public function remove(Request $request)
    {
        Task::find($request->id)->delete();
        return redirect('/task');
    }
}
