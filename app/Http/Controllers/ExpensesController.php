<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BudgetsController;
use App\Models\Budget;
use App\Models\User;
use App\Models\Expense;


class ExpensesController extends Controller
{
    public function store(Request $request,$budget){
        $request->validate([
            'content' => 'required|string|max:255',
            'expense' => 'required|integer|min:1|max:3000000',
        ]);

        $user=\Auth::user();

        $expense=new Expense;
        $expense->user_id = $user->id;
        $expense->budget_id = $budget;
        $expense->content = $request->content;
        $expense->expense = $request->expense;
        $expense->save();

        return back();

    }

    public function destroy($id){
        $expense=Expense::findOrFail($id);

        $expense->delete();

        return back();
    }

    public function edit($id){
        $expense = Expense::findOrFail($id);
        return view('expenses.edit',compact('expense'));
    }

    public function update(Request $request ,$id){
        $request->validate([
            'content' => 'required|string|max:255',
            'expense' => 'required|integer|min:1|max:3000000',
        ]);

        $user=\Auth::user();

        $expense = Expense::findOrFail($id);
        $expense->content = $request->content;
        $expense->expense = $request->expense;
        $expense->save();

        return redirect()->action([BudgetsController::class,'index']);
    }
}
