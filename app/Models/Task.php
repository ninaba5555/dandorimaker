<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\TimeTrait;
use App\Scopes\ScopeTask;

class Task extends Model
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
        static::addGlobalScope(new ScopeTask);
    }
    
    public function plan()
    {
        return $this->belongsTo('App\Models\Plan');
    }

    public function scopePlanID($query, $planID)
    {
        return $query->where('plan_id', $planID);
    }
    
    public function getNext()
    {
        $tasks = Task::planID($this->plan_id);
        $next = $tasks->where('sort', '>', $this->sort)->first();
        return $next;
    }

    public function getPrev()
    {
        $tasks = Task::planID($this->plan_id);
        $prev = $tasks->where('sort', '<', $this->sort)
            ->orderBy('sort', 'desc')
            ->first();
        return $prev;
    }
}
