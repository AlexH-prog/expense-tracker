<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    // Метод для отображения списка всех расходов
    public function index()
    {
        $expenses = Expense::with('items')->get();
        return view('expenses.index', compact('expenses'));
    }

}
