<?php

namespace App\Http\Controllers;

use App\Models\Plan;
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
}
