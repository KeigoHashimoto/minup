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
            'quantity' => 'integer',
        ]);
        $task = new Task();
        $task -> user_id = \Auth::user()->id;
        $task -> task = $request -> task;
        $task -> quantity = $request -> quantity;
        $task->save();

        return back();
    } 

    public function destroy($id){
        $task = Task::findOrFail($id);

        $task->delete();

        return back();
    }

    public function status($id)
    {
        $task = Task::findOrFail($id);
        if($task->status == 0)
        {
            $task->status = 1;
            $task->update();

        }else {
            $task->status = 0;
            $task->update();
        }

        return back();
    }
}
