<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskUpdateController extends Controller
{
    public function update(Request $request)
    {
        $updatedData = $request->all();

        $task = Task::where('user_id', $request->user_id)->first();

        $task->update($updatedData);

        return response()->json(['message' => 'Record bijgewerkt'], 200);
    }
}
