<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    // ------------------------- Общие данные ------------------------- //
    /**
     * Display a listing of the resource.
     */
    /*public function index()
    {
        //
    }*/

    /**
     * Show the form for creating a new resource.
     */
    // Метод для создания общих данных расхода
    public function create()
    {
        return view('expenses.create-general');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseRequest $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'comment' => 'nullable|string|max:255',
        ]);

        $expense = Auth::user()->expenses()->create([
            'date' => $validated['date'],
            'comment' => $validated['comment'],
            'amount' => 0, // Пустая сумма для начала
        ]);

        return redirect()->route('expenses.index')->with('success', 'Общие данные расхода успешно созданы!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // Метод для редактирования общих данных расхода
    public function edit(Expense $expense)
    {
        $this->authorize('update', $expense);
        return view('expenses.edit-general', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        $this->authorize('update', $expense);

        $validated = $request->validate([
            'date' => 'required|date',
            'comment' => 'nullable|string|max:255',
        ]);

        $expense->update($validated);

        return redirect()->route('expenses.index')->with('success', 'Общие данные расхода успешно обновлены!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        //
    }
}
