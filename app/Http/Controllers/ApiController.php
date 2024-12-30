<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;
use App\Models\Expense;

class ApiController extends Controller
{
    public function apiBudgetRegister(Request $request)
    {
        $authorizationHeader = $request->header('Authorization');

        if ($authorizationHeader && str_starts_with($authorizationHeader, 'Bearer ')) {
            $apiKey = substr($authorizationHeader, 7); // "Bearer " を除去
        }
        $budget_title = $request->title;
        $budget_budget = $request->budget;
        $budget_month = $request->month;
        $budget_year = $request->year;
        $budget_user_id = $request->user_id;
 
        if ($apiKey == config('services.apiKey')) {
            try {
                $budget = Budget::create([
                    'user_id' => $budget_user_id,
                    'title' => $budget_title,
                    'budget' => $budget_budget,
                    'month' => $budget_month,
                    'year' => $budget_year
                ]);
                return response()->json($budget);
            } catch (Exception $e) {
                return response()->json($e);
            }
        } else {
            return response()->json($apiKey);
        }
    }

    public function apiExpensesRegister(Request $request)
    {
        $authorizationHeader = $request->header('Authorization');

        if ($authorizationHeader && str_starts_with($authorizationHeader, 'Bearer ')) {
            $apiKey = substr($authorizationHeader, 7); // "Bearer " を除去
        }
        $expense_budget_id = $request->budget_id;
        $expense_content = $request->content;
        $expense_expense = $request->expense;
        $expense_user_id = $request->user_id;

        if ($apiKey == config('services.apiKey')) {
            try {
                $budget = Expense::create([
                    'user_id' => $expense_user_id,
                    'budget_id' => $expense_budget_id,
                    'content' => $expense_content,
                    'expense' => $expense_expense
                ]);
                return response()->json($budget);
            } catch (Exception $e) {
                return response()->json($e);
            }
        }
    }
}
