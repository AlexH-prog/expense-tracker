<?php

namespace Database\Factories;

use App\Models\Expenseitem;
use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExpenseItem>
 */
class ExpenseItemFactory extends Factory
{
    protected $model = Expenseitem::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantity = $this->faker->numberBetween(1, 5);
        $price = $this->faker->randomFloat(2, 10, 100);

        return [
            'expense_id' => Expense::factory(),
            'category' => $this->faker->word(),
            'quantity' => $quantity,
            'price' => $price,
            'total' => $quantity * $price,
        ];
    }
}
