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

        if (isset($request->task_id)) {
            $task = Task::find($request->task_id);
        } else {
            $task = Task::planID($request->plan_id)->first();
        }

        return view('plan.do', [
            'plan' => $plan,
            'task' => $task,
            'mode' => 'start'
        ]);
    }

    public function time(Request $request)
    {
        // 計測時間を格納
        $task = Task::find($request->id);
        $task->start = $request->start;
        $task->end = $request->end;
        $task->reality = strtotime($task->end) - strtotime($task->start);
        $task->save();

        $next = $task->getNext();
        if (isset($next)) {
            return response()->json([
                'status' => 'next',
                'plan_id' => $task->plan_id,
                'task_id' => $next->id,
            ]);
        } else {
            // TODO: 計測時間を集計し、プランに格納
            Plan::aggregate($task->plan_id);

            return response()->json([
                'status' => 'end'
            ]);
        }
    }

}
