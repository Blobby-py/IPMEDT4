<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'finished' => 'required|boolean',
            'user_id' => 'required|integer',
        ];
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $task = Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'finished' => $request->finished,
            'user_id' => $request->user_id
        ]);

        $token = $task->createToken('Personal Access Token')->plainTextToken;
        $response = ['task' => $task, 'token' => $token];
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($user_id)
    {
        $tasks = DB::table('tasks')->where('user_id', $user_id)->get();
            $counter =0;
            foreach ($tasks as $task) 
            {
                $counter += 1;
                $response = 
                [ 
                    'name' => $task->name,
                    "description" => $task->description,
                    "start_date" => $task->start_date,
                    "end_date" => $task->end_date,
                    "finished" => $task->finished,
                    'aantal keer geteld' => $counter
                ];
            $totaleResponse [] = $response;

            }
            return response()->json($totaleResponse);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {        
        $task = DB::table('tasks')->where('id', $id)->delete();
        return response()->json(["De taak ", $task, " is succesvol verwijderd", 204]);
    }
}