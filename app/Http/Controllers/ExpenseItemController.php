<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseItem;
use App\Http\Requests\StoreExpenseItemRequest;
use App\Http\Requests\UpdateExpenseItemRequest;

class ExpenseItemController extends Controller
{
    // ------------------------- Статьи расходов ------------------------- //
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    // Метод для создания новой статьи расхода
    public function create(Expense $expense)
    {
        return view('expenses.create-item', compact('expense'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseItemRequest $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $validated['total'] = $validated['quantity'] * $validated['price'];

        $expense->items()->create($validated);

        // Обновляем общую сумму в общих данных
        $expense->update([
            'amount' => $expense->items->sum('total'),
        ]);

        return redirect()->route('expenses.index')->with('success', 'Статья расхода успешно добавлена!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ExpenseItem $expenseItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExpenseItem $expenseItem)
    {
        $this->authorize('update', $expenseItem->expense);
        return view('expenses.edit-item', compact('expenseItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseItemRequest $request, ExpenseItem $expenseItem)
    {
        $this->authorize('update', $expenseItem->expense);

        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $validated['total'] = $validated['quantity'] * $validated['price'];

        $expenseItem->update($validated);

        // Обновляем общую сумму в общих данных
        $expenseItem->expense->update([
            'amount' => $expenseItem->expense->items->sum('total'),
        ]);

        return redirect()->route('expenses.index')->with('success', 'Статья расхода успешно обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExpenseItem $expenseItem)
    {
        //
    }
}
