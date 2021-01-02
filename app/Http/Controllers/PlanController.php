<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Task;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index(Request $request)
    {
        $items = Plan::all();
        return view('plan.index', ['items' => $items]);
    }

    public function add(Request $request)
    {
        return view('plan.add');
    }

    public function create(Request $request)
    {
        $this->validate($request, Plan::$rules);
        $plan = new Plan;
        $form = $request->all();
        unset($form['_token']);

        // TODO: 未入力カラムの初期値設定方法について調べる
        // TODO: messageカラムは任意入力にしたい
        // TODO: 分秒入力にしたい

        $plan->fill($form)->save();
        return redirect('/plan');
    }

    public function edit(Request $request)
    {
        $plan = Plan::find($request->id);
        return view('plan.edit', ['form' => $plan]);
    }

    public function update(Request $request)
    {
        $this->validate($request, Plan::$rules);
        $plan = Plan::find($request->id);
        $form = $request->all();
        unset($form['_token']);
        $plan->fill($form)->save();
        return redirect('/plan');
    }

    public function delete(Request $request)
    {
        $plan = Plan::find($request->id);
        return view('plan.del', ['form' => $plan]);
    }

    public function remove(Request $request)
    {
        $plan = Plan::find($request->id)->delete();
        return redirect('/plan');
    }

    public function do(Request $request)
    {
        $plan = Plan::find($request->plan_id);

        if (isset($request->id)) {
            $task = Plan::find($request->id);
        } else {
            $task = Task::planID($request->plan_id)->first();
        }

        return view('plan.do', [
            'plan' => $plan,
            'task' => $task,
            'mode' => 'start'
        ]);
    }

    public function doTask(Request $request)
    {
        $task = Task::find($request->task_id);
        $task->start = date("Y-m-d H:i:s");   ;
        $task->save();
        $plan = Plan::find($task->plan_id);

        return view('plan.do', [
            'plan' => $plan,
            'task' => $task,
            'mode' => 'stop'
        ]);

        // $next = $task->getNext();

        // if (isset($next)) {
        //     return redirect()->action(
        //         [PlanController::class, 'do'],
        //         [
        //             'plan_id' => $task['plan_id'],
        //             'id' => $next['id']
        //         ]
        //     );
        // } else {
        //     return redirect('/plan');
        // }
    }

}
