<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BudgetsController;
use App\Models\Budget;
use App\Models\User;
use App\Models\Expense;
use App\Models\FixedCostExpense;
use App\Models\FixedCost;

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

    public function fixedCostExpensesStore(Request $request){
        $user=\Auth::user();
        $fixedCostId = $request->fiexedCostId;
        $budgetId = $request->budgetId;
        // dd('cost:'. $fixedCostId. ' + budget'. $budgetId);

        $expenses = FixedCostExpense::where('user_id','=',$user->id)
                ->where('fixed_cost_id','=',$fixedCostId)
                ->get();

        foreach ($expenses as $e) {
            $expense=new Expense;
            $expense->user_id = $user->id;
            $expense->budget_id = $budgetId;
            $expense->content = $e->content;
            $expense->expense = $e->expense;
            $expense->save();
        }
    
        return response()->json('登録完了しました');
    }

    public function showChart($id)
    {
        $expenses = Budget::rightJoin('expenses', 'expenses.budget_id', '=', 'budgets.id')
            ->where('budgets.id', $id)
            ->get();

        return view('chart/chart', ['expenses' => $expenses]);
    }
}
