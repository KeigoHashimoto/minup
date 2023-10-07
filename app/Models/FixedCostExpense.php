<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FixedCostExpense extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fixed_cost_id',
        'content',
        'expense'
    ];
}
