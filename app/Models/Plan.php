<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\TimeTrait;
use App\Scopes\ScopePlan;

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

        // 格納
        $plan = Plan::find($planID);
        $plan->reality = $reality;
        $plan->save();

        return;
    }
}
