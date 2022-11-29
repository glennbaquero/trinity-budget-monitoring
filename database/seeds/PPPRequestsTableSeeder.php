<?php

use Illuminate\Database\Seeder;

use App\Models\Requests\PppRequest;

class PPPRequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $row = 0;
        
        if(($handle = fopen('database/csv/ppp_requests.csv', "r")) !== FALSE){
        	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

            	if ($row > 0) {
	                $this->command->info('writing row ' . $row . ' ' . $data[8]);

	                $item = new PppRequest();
	                $item->budget_id = $data[0];
	                $item->product_id = $data[1];
	                $item->manager_id = $data[2];
                    // $item->finance_type = $data[3];
                    // $item->finance_id = $data[4];
                    // $item->super_admin_type = $data[5];
                    // $item->super_admin_id = $data[6];
                    $item->number = $data[7];
                    $item->name = $data[8];
                    $item->requested_amount = $data[9];
                    $item->current_balance = $data[10];
                    $item->total_balance = $data[11];
                    $item->line_business = $data[12];
                    $item->period_start_at = $data[13];
                    $item->period_end_at = $data[14];
                    $item->finance_approved_at = $data[15];
                    $item->super_admin_approved_at = $data[16];
                    $item->approval_status = $data[17];

	                $item->save();
            	}

                $row++;

            }
            fclose($handle);
        }
    }
}
