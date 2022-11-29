<?php

use Illuminate\Database\Seeder;

use App\Models\Specializations\Specialization;
use App\Models\Products\Product;

class ProductsAndSpecializationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Specialization::truncate();
    	Product::truncate();
    	
        $items = [
        	[
        		'name' => 'Cardiologist',
        		'products' => [
        			[
        				'name' => 'Diabetamil Nutty Chocolate Cookies',
        			],
        			[
        				'name' => 'Diabetamil Vanilla Dried Fruit Cookies',
        			],
        		]
        	],
        	[
        		'name' => 'Rheumatology',
        		'products' => [
        			[
        				'name' => 'Entrasol Platinum Vanilla 600g',
        			],
        			[
        				'name' => 'Entrasol Platinum Chocolate 600g	',
        			],
        		]
        	],
        	[
        		'name' => 'Anesthesiologist',
        		'products' => [
        			[
        				'name' => 'Entrasol Platinum Chocolate 200g	',
        			],
        			[
        				'name' => 'Entrasol Platinum Vanilla 200g	',
        			],
        		]
        	]
        ];

        foreach ($items as $item) {
        	$specialization = Specialization::create([
        		'name' => $item['name']
        	]);

        	foreach ($item['products'] as $product) {
		    	$specialization->products()->create($product);
        	}
        }
    }
}
