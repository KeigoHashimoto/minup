<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\User;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BudgetsController extends Controller
{
    public function index(){
        
        $new = \DB::table('budgets')
            ->select(['month'])
            ->selectRaw('date_format(month,"%Y-%m") as new_month')
            ->orderBy('new_month','desc')
            ->first();

        $budgets=array();

        if(isset($new)){
            $budgets=Budget::where('user_id',\Auth::id())
            ->where('month','like',$new->new_month.'%')
            ->orderBy('created_at','desc')
            ->get();
        }else{
            $budgets=[];
        }
        

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
        ]);

        $budget=new Budget;

        $budget->user_id = \Auth::id();
        $budget->title = $request->title;
        $budget->budget = $request -> budget;
        $budget->month = $request -> month;
        $budget->save();

        return redirect('/');
    }

    public function show($id){
        $budget=Budget::findOrFail($id);

        $expenses=Expense::where('budget_id',$budget->id)->where('user_id',\Auth::id())->orderBy('created_at','desc')->get();

        $sum = $expenses->sum('expense');

        return view('budgets.show',compact('budget','expenses','sum'));
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
            'budget'=> 'required|integer|min:1|max:500000',
        ]);

        $budget=Budget::findOrFail($id);

        $budget->title = $request->title;
        $budget->budget = $request -> budget;
        $budget->month = date('Y/m/d');
        $budget->save();

        return redirect('/');
    }

    public function month(){
        $subQuery=function($query){
            $query->from('budgets')
                ->selectRaw('date_format(month,"%Y-%m") as new_month')
                ->where('user_id',\Auth::id())
                ->groupBy('new_month');
        };

        $budgets_month=\DB::table($subQuery)
            ->orderBy('new_month','desc')
            ->get();

        return view('budgets.month',compact('budgets_month'));
    }

    public function monthShow($newMonth){
        $budgets=Budget::where('month','like',$newMonth.'%')->where('user_id',\Auth::id())->orderBy('created_at','desc')->get();
        
        return view('budgets.monthShow',compact('budgets'));
    }
}
