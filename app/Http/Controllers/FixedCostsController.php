<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FixedCost;
use App\Models\FixedCostExpense;;
use \Auth;

class FixedCostsController extends Controller
{
    public function fixedCostCreate() {
        return view('fixedCosts/createForm');
    }

    public function fixedCostStore(Request $request) {
        $costTitle = $request->input('cost-title');
        $contents = $request->input('content');
        $expenses = $request->input('expense');
        $user = Auth::user();

        //FixedCostに登録
        $fixedCost = new FixedCost();
        $newCost = $fixedCost->create([
            'user_id' => $user->id,
            'cost_title' => $costTitle,
        ]);
        $fixedCostId = $newCost->id;

        //fixedCostExpenseに登録
        for($i=0;$i < count($contents);$i++){
            $fixedCostExpense = new FixedCostExpense();
            $fixedCostExpense->create([
                'user_id' => $user->id,
                'fixed_cost_id' => $fixedCostId,
                'content' => $contents[$i],
                'expense' => $expenses[$i]
            ]);
        }
        
        return redirect()->route('fixedCreate.form');
    }

    public function getCosts() {
        $user = Auth::user();
        $costs = FixedCost::where('user_id','=',$user->id)->get();


        return response()->json($costs);
    }
}
