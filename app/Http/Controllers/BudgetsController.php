<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\User;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Share;

class BudgetsController extends Controller
{
    public function index(){
        $budgets = Budget::select(['budgets.id', 'budgets.title', 'budgets.year', 'budgets.month', 'users.name'])
        ->leftjoin('shares', 'budgets.id', '=', 'shares.budget_id')
        ->leftjoin('users', 'budgets.user_id', '=', 'users.id')
        ->where(function ($query) {
            $query->where('budgets.user_id', '=', Auth::id())
                  ->orWhere('shares.share_user_id', '=', Auth::id());
        })
        ->where('budgets.year', '=', (int)date('Y'))
        ->where('budgets.month', '=', (int)date('m'))
        ->orderBy('budgets.created_at', 'desc')
        ->get();
        
              
        return view('home',compact('budgets')); 
    }

    public function create(){
        $date = date('Y-m-d');
        return view('budgets.create',compact('date'));
    }

    public function store(Request $request){
        $request->validate([
            'title'=> 'required|string|max:260',
            'budget'=> 'required|integer|min:1|max:500000',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:1980|',
        ]);

        $budget=new Budget;

        $budget->user_id = \Auth::id();
        $budget->title = $request->title;
        $budget->budget = $request -> budget;
        $budget->year = $request->year;
        $budget->month = $request -> month;
        $budget->save();

        return redirect()->route('budget.show', ['id' => $budget->id]);
    }

    public function show($id){
        $budget=Budget::findOrFail($id);
        $expenses=$budget->expenses;
        $sum = $expenses->sum('expense');

        $shareExists = Share::join('budgets','shares.budget_id','=','budgets.id')
        ->where('shares.budget_id','=',$id)
        ->where('shares.share_user_id','=',Auth::id())
        ->get();
        

        return view('budgets.show',compact('budget','expenses','sum','shareExists'));
    }

    public function destroy($id){
        $budget=Budget::findOrFail($id);
        $budget->delete();

        return redirect('/');
    }

    public function edit($id){
        $budget = Budget::findOrfail($id);

        return view('budgets.edit',compact('budget'));
    }

    public function update(Request $request ,$id){
        $request->validate([
            'title'=> 'required|string|max:255',
            'budget'=> 'required|integer|min:1|max:1000000',
            'year' => 'required|integer|min:1980',
            'month' => 'required|integer|min:1|max:12',
        ]);

        $budget=Budget::findOrFail($id);

        $budget->title = $request->title;
        $budget->budget = $request -> budget;
        $budget->year = $request->year;
        $budget->month = $request->month;
        $budget->save();

        return redirect()->route('budget.show', ['id' => $budget->id]);
    }

    public function month(){
        $budgets_month = Budget::select('month','year',DB::raw('count(month) AS 件数'))
        ->leftjoin('shares','budgets.id','=','shares.budget_id')
        ->where('shares.share_user_id','=',Auth::id())
        ->orWhere('budgets.user_id','=',Auth::id()) 
        ->groupBy('month','year')
        ->orderBy('year','desc')
        ->orderBy('month','desc')
        ->get();

        return view('budgets.month',compact('budgets_month'));
    }

    public function monthShow($year,$month){
        $budgets = Budget::select(['budgets.id', 'budgets.title', 'budgets.year', 'budgets.month', 'users.name'])
        ->leftjoin('shares', 'budgets.id', '=', 'shares.budget_id')
        ->leftjoin('users', 'budgets.user_id', '=', 'users.id')
        ->where(function ($query) {
            $query->where('budgets.user_id', '=', Auth::id())
                  ->orWhere('shares.share_user_id', '=', Auth::id());
        })
        ->where('budgets.year', '=', $year)
        ->where('budgets.month', '=', $month)
        ->orderBy('budgets.created_at', 'desc')
        ->get(); 

        $userId = Auth::id();
        
        return view('budgets.monthShow',compact('budgets', 'userId'));
    }
}
