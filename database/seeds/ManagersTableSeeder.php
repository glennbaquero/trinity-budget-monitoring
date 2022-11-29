<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\Managers\Manager;

use Carbon\Carbon;

class ManagersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Manager::truncate();

        $manager = Manager::create([
        	'position_id' => 1,
        	'first_name' => 'App',
        	'last_name' => 'Manager',
        	'email' => 'manager@app.com',
        	'email_verified_at' => Carbon::now(),
        	'password' => \Hash::make('password'),
        	'contact_number' => '09123456778',
        ]);

     	
    	$item['position_id'] = 2;
        $item['first_name'] = 'App District';
        $item['last_name'] = 'Manager';
        $item['email' ] = 'district_manager@app.com';
        $item['email_verified_at' ] = Carbon::now();
        $item['password' ] = \Hash::make('password');
        $item['contact_number' ] = '09123456778';
        $item['is_assistant_manager' ] = true;

        $district = Manager::create($item);
        
        $manager->assistantManagers()->attach($district);

        // Manager::create([
        // 	'first_name' => 'App District',
        // 	'last_name' => 'Manager',
        // 	'email' => 'manager@app.com',
        // 	'email_verified_at' => Carbon::now(),
        // 	'password' => \Hash::make('password'),
        // 	'contact_number' => '09123456778',
        // 	'is_assistant_manager' => true
        // ]);
    }
}
