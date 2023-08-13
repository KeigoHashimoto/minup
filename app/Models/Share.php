<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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
}
