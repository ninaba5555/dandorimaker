<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        if (isset($request->plan_id)) {
            // プランに紐づくタスク一覧を表示
            $items = Task::planID($request->plan_id)->get();
            return view('task.index', ['items' => $items])
                ->with('plan_id', $request->plan_id);
        } else {
            $items = Task::all();
            return view('task.index', ['items' => $items]);
        }
    }

    public function add(Request $request)
    {
        if (isset($request->plan_id)) {
            return view('task.add')->with('plan_id', $request->plan_id);
        } else {
            return view('task.add');
        }
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
        $form['sort'] = time();
        $task->fill($form)->save();

        return redirect()->action(
            [TaskController::class, 'index'],
            ['plan_id' => $task['plan_id']]
        );
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

        return redirect()->action(
            [TaskController::class, 'index'],
            ['plan_id' => $task['plan_id']]
        );
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

    public function up($id)
    {
        $task = Task::find($id);
        $prev = $task->getPrev();
        // $prev = Task::where('sort', '<', $task->sort)->orderBy('sort', 'desc')->first();

        if (! isset($prev)) {
            return response()->json([
                'status' => 'err',
                'msg' => '変更はありませんでした。'
            ]);
        }

        $tmp = $task->sort;
        $task->sort = $prev->sort;
        $prev->sort = $tmp;
        $task->save();
        $prev->save();

        return response()->json($task->sort);
    }

    public function down($id)
    {
        $task = Task::find($id);
        $next = $task->getNext();

        if (! isset($next)) {
            return response()->json([
                'status' => 'err',
                'msg' => '変更はありませんでした。'
            ]);
        }

        $tmp = $task->sort;
        $task->sort = $next->sort;
        $next->sort = $tmp;
        $task->save();
        $next->save();

        return response()->json($task->sort);
    }
}
