<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Share;
use \Auth;
use \Redirect;

class ShareController extends Controller
{
    public function share(Request $req){
        $share = new Share();
        $result = false;

        $userMail = $req->input('user_mail');
        $budgetId = $req->input('budget_id');
        if(Auth::user()->email != $userMail){
            $result = $share->share($userMail,$budgetId);
        }

        $message = '';

        if(!$result){
            $message = 'メールアドレスのユーザーがいないか、すでに共有済みです';
            return response()->json($message);
        }

        return response()->json($message);
    }

    public function shareRemove($budgetId){
        $share = new Share();

        $remove = $share->shareRemove($budgetId);

        return back();
    }
}
