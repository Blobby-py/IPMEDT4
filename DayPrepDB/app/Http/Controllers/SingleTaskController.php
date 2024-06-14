<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SingleTaskController extends Controller
{
    public function display($id)
    {
        $tasks= DB::table('tasks')->where('id', $id)->get();
        foreach ($tasks as $task)
        {
            $response = 
            [
                'name' => $task->name,
                "description" => $task->description,
                "start_date" => $task->start_date,
                "end_date" => $task->end_date,
                "finished" => $task->finished,
            ];
            return response()->json($response);
        }
    }
}
