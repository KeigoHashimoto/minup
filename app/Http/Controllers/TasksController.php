<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TasksController extends Controller
{
    public function index(){
        $tasks = Task::where('user_id',\Auth::id())->get();

        return view('tasks.index',compact('tasks'));
    }

    public function store(Request $request){
        $request->validate([
            'task'=>'required|string|max:255',
        ]);

        $request->user()->tasks()->create([
            'task' => $request->task,
        ]);

        return back();
    } 

    public function destroy($id){
        $task = Task::findOrFail($id);

        $task->delete();

        return back();
    }
}
