<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use \Auth;

class Share extends Model
{
    use HasFactory;

    protected $table = "shares";

    protected $fillable=['budget_id','share_user_id'];

    public function share($userMail,$budgetId){
        $user = User::where('email',$userMail)->first();

        if($user==null){
            return false;
        }else{
            $exists = $this->where('share_user_id',$user->id)
            ->where('budget_id',$budgetId)
            ->exists();

            if($exists){
                return false;
            }

            $this->create([
                'budget_id'=>$budgetId,
                'share_user_id'=>$user->id,
            ]);
            return true;
        }
    }

    public function shareApi($userId,$budgetId){
        $user = User::findOrFail($userId);

        if($user==null){
            return false;
        }else{
            $exists = $this->where('share_user_id',$user->id)
            ->where('budget_id',$budgetId)
            ->exists();

            if($exists){
                return false;
            }

            $this->create([
                'budget_id'=>$budgetId,
                'share_user_id'=>$user->id,
            ]);
            return true;
        }
    }

    public function shareRemove($budgetId){
        $user = Auth::user();
        $budget = Budget::findOrFail($budgetId);
        if($user->shareBudgets()->exists($budget)){
            $user->shareBudgets()->detach($budgetId);
        }else{
            return false;
        }
        
        return true;
    }
}
