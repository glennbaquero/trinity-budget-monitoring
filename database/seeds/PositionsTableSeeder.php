<?php

use Illuminate\Database\Seeder;

use App\Models\Positions\Position;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Position::truncate();
    	
        Position::create(['name' => 'Manager']);
        Position::create(['name' => 'District Manager']);
    }
}
