<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Budget;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = ['content','expense'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function budget(){
        return $this->belongsTo(Budget::class);
    }
}
