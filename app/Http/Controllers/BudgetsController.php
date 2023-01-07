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
        /**
         * 現在時刻の年と月が同じ予算をホーム画面に表示させる。
         */
        $budgets = Budget::where('year',(int)date('Y'))->where('month',(int)date('m'))->orderBy('created_at','desc')->limit(5)->get();

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

        return redirect('/');
    }

    public function month(){
        $subQuery=function($query){
            $query->from('budgets')
                ->select(['month','year'])
                ->where('user_id','=',\Auth::id());
        };

        $budgets_month=\DB::table($subQuery)
            ->orderBy('year','desc')
            ->orderBy('month')
            ->get();

        return view('budgets.month',compact('budgets_month'));
    }

    public function monthShow($year,$month){
        $budgets=Budget::where('year','=',$year)->where('month','=',$month)->where('user_id',\Auth::id())->orderBy('created_at','desc')->get();
        
        return view('budgets.monthShow',compact('budgets'));
    }

    public function report($id){
        //該当の予算を取得
        $budget = Budget::findOrfail($id);
        //該当予算に対する出費を取得
        $expenses = $budget->expenses()->get();

        $date=date('YmdHis');

        $file_path = "reports/{$budget->title}{$date}.csv";

        //ファイルを新規作成モードで開く
        $fp = fopen($file_path,"w");
        //csvファイルにshiftt-JIS形式で保存
        $budgetString = [];
        $budgetString[] = mb_convert_encoding($budget->title, "sjis");
        $budgetString[] = mb_convert_encoding($budget->budget, "sjis");
        fputcsv($fp,$budgetString);
        //ファイルを閉じる
        fclose($fp);

        //ファイルを追記モードで開く
        $fp2 = fopen($file_path,"a");
        //出費をforeachで一個ずつ取り出す
        foreach($expenses as $content){
            $string = [];
            $string[] = mb_convert_encoding($content->content ,"sjis");
            $string[] = mb_convert_encoding($content->expense ,"sjis");
            $string[] = mb_convert_encoding($content->created_at ,"sjis");
            fputcsv($fp2,$string);
        }
        //csvに追記保存
        fclose($fp2);

        header('Content-Type: application/octet-stream');
        // ファイルのコンテンツタイプを指定
        header('Content-Disposition:attachment;filename = "budget.csv');
        // ファイルのダウンロードバーを表示; ダウンロード後のファイル名を設定
        header('Content-Length: '.filesize( $file_path ));
        // ファイルの大きさを明示
        echo file_get_contents($file_path);
        // ファイルを出力

        unlink($file_path);

        exit;
        // 処理を終了

    }
}
