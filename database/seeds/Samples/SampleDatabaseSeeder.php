<?php

use Illuminate\Database\Seeder;

class SampleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $this->call(AdminsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ManagersTableSeeder::class);
        
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);

        $this->call(PagesTableSeeder::class);
        $this->call(PositionsTableSeeder::class);

        $this->call(BudgetsTableSeeder::class);
        $this->call(ProductsAndSpecializationsTableSeeder::class);
        $this->call(PPPRequestsTableSeeder::class);
    }
}
