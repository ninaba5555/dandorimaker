<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\TimeTrait;

class Plan extends Model
{
    use HasFactory;
    use TimeTrait;

    protected $guarded = array('id');

    public static $rules = array(
        'title' => "required",
        'ideal' => "integer",
    );
}
