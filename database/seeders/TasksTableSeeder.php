<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $task = new Task;
        $task->title = 'taskのモデルとコントローラを追加';
        $task->message = 'taskのモデルとコントローラを追加する。';
        $task->ideal = 1800;
        $task->reality = 2700;
        $task->save();

        $task = new Task;
        $task->title = 'テンプレートを追加';
        $task->message = 'テンプレートを追加する。';
        $task->ideal = 900;
        $task->reality = 1350;
        $task->save();

        $task = new Task;
        $task->title = 'シーダーを追加';
        $task->message = 'シーダーを追加する。';
        $task->ideal = 800;
        $task->reality = 1200;
        $task->save();
    }
}
