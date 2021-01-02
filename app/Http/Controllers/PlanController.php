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

        $form['reality'] = 0;
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
        $tasks = Task::where('plan_id', $request->plan_id)->orderBy('sort', 'asc')->get();
        $task = $tasks[0];
        return view('plan.do', [
            'plan' => $plan,
            'task' => $task
        ]);
    }

    public function doTask(Request $request)
    {
        $task = Task::find($request->task_id);
        // 仮で1000秒
        $task->reality = 1000;
        $task->save();
        return redirect('/plan');
    }
}
