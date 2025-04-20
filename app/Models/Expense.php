<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'comment', 'amount', 'user_id'];

    public function items()
    {
        return $this->hasMany(ExpenseItem::class);
    }
}
