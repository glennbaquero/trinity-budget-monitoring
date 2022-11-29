<?php

use Illuminate\Database\Seeder;

use App\Models\Budgets\Budget;

use Carbon\Carbon;
class BudgetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Budget::create([
        	'name' => 'FB Advertisement',
        	'period_start_at' => Carbon::now(),
        	'period_end_at' => Carbon::now()->addDays(30),
        	'budget_amount' => 100000
        ]);
    }
}
