<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Traits\TimeTrait;
use App\Scopes\ScopePlan;
use App\Models\Crystal;

class Plan extends Model
{
    use HasFactory;
    use TimeTrait;

    protected $guarded = array('id');

    public static $rules = array(
        'title' => "required",
        'ideal' => "integer",
    );

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ScopePlan);
    }

    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
    }

    /**
     * 計測時間を集計し、プランに格納
     */
    public static function aggregate($planID)
    {
        // 集計
        $tasks = Task::planID($planID)->get();
        $reality = 0;
        foreach ($tasks as $task) {
            $reality += $task->reality;
        }

        // 努力の結晶を付与
        $plan = Plan::find($planID);
        if (! $plan->crystallize) {
            Crystal::give(Auth::user()->id, 'プラン実行報酬', 25);
        }

        // 格納
        $plan->reality = $reality;
        $plan->crystalize = true;
        $plan->save();

        return;
    }
}
