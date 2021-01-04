<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\ScopeCrystal;

class Crystal extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public static $rules = array(
        'title' => "required",
    );

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ScopeCrystal);
    }

    // 努力の結晶を付与
    public static function give($userID, $title, $number)
    {
        $crystal = new Crystal;
        $crystal->user_id = $userID;
        $crystal->title   = $title;
        $crystal->number  = $number;
        $crystal->save();
    }

    public static function number()
    {
        $crystals = Crystal::get();
        $number = 0;
        foreach ($crystals as $crystal) {
            $number += $crystal->number;
        }
        return '努力の結晶：' . $number;
    }
}
