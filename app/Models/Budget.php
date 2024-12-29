<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Expense;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = ['title','budget', 'month', 'year', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function expenses(){
        return $this->hasMany(Expense::class);
    }

    public function shareUsers(){
        return $this->belongsToMany(Budget::class,'shares','budget_id','share_user_id');
    }
}
