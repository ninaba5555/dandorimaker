<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $items = Task::all();
        return view('task.index', ['items' => $items]);
    }
}
