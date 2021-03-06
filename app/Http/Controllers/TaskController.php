<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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

        // TODO: 分秒入力にしたい
        $form['sort'] = time();
        $form['user_id'] = Auth::user()->id;
        $task->fill($form)->save();

        return redirect()->action(
            [TaskController::class, 'index'],
            ['plan_id' => $task['plan_id']]
        );
    }

    public function edit(Request $request)
    {
        $task = Task::find($request->id);
        if (isset($request->plan_id)) {
            return view('task.edit', ['form' => $task])->with('plan_id', $request->plan_id);
        } else {
            return view('task.edit', ['form' => $task]);
        }
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
        if (isset($request->plan_id)) {
            return view('task.del', ['form' => $task])->with('plan_id', $request->plan_id);
        } else {
            return view('task.del', ['form' => $task]);
        }
    }

    public function remove(Request $request)
    {
        $task = Task::find($request->id);
        $planID = $task->plan_id;
        $task->delete();
        return redirect()->action(
            [TaskController::class, 'index'],
            ['plan_id' => $planID]
        );
    }

    public function up($id)
    {
        $task = Task::find($id);
        $prev = $task->getPrev();

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

    public function sort(Request $request)
    {
        $idStr = $request->id;
        $ids = explode('/', $idStr);

        for ($i = 0; $i < count($ids); $i++) {
            $task = Task::find($ids[$i]);
            $task->sort = $i;
            $task->save();
        }

        return response()->json();
    }
}
