<?php

namespace App\Http\Controllers\Web\PPP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Budgets\Budget;
use App\Models\Requests\PoRequest;
use App\Models\Requests\PppRequest;
use App\Models\Managers\Manager;

use Storage;
use DB;
use Carbon\Carbon;

class PPPAvailableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // // Doughnut chart
        // $manager = auth()->guard('manager')->user();
        // $pppRequests = $manager->pppRequests;
        // $ppp_ids = $manager->pppRequests->pluck('id');
        // $poRequests = PoRequest::whereIn('ppp_request_id', $ppp_ids);
        // $doughnut_data = [];
        // $doughnut_labels = [];
        // $doughnut_data_color = [];
        // $table_data = [];

        // foreach ($poRequests->get() as $po) {
        //     $color = '#'.str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
        //     array_push($table_data, [
        //         'legend' => $color,
        //         'name' => $po->name,
        //         'request_amount' => $po->getPercentage(true).' - '.$po->renderShortAmountLabel(),
        //         'po_date' => Carbon::parse($po->po_date)->format('F d Y'),
        //     ]);
        //     array_push($doughnut_data_color, $color);
        // }


        // Table Data
        $manager = auth()->guard('web')->user()->manager; 
        $specializations = $manager->specializations;
        $specialization_ids = $manager->specializations->pluck('id'); 
        $pppRequests = $manager->pppRequests()->whereNotNull('super_admin_approved_at');
        $ppp_ids = $manager->pppRequests()->whereNotNull('super_admin_approved_at')->pluck('id');
        $poRequests = PoRequest::whereIn('ppp_request_id', $ppp_ids)->whereNotNull('super_admin_approved_at');
        $items = [];
        $doughnut_data = [];
        $doughnut_labels = [];
        $doughnut_data_color = [];        

        foreach ($poRequests->get() as $po) {
            $color = '#'.str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
            array_push($items, [
                'legend' => $color,
                'name' => $po->name,
                'request_amount' => $po->getPercentage(true).' - '.$po->renderShortAmountLabel(),
                'po_date' => Carbon::parse($po->po_date)->format('F d Y'),
            ]);

            array_push($doughnut_data_color, $color);

        }      

		$manager = auth()->guard('web')->user()->manager; 
        $pppRequests = $manager->pppRequests;
        // $ppp_ids = $manager->pppRequests->pluck('id');
        // $poRequests = PoRequest::whereIn('ppp_request_id', $ppp_ids);

        $specialization_ids = $manager->specializations->pluck('id');
        $main_budgets = Budget::whereIn('specialization_id', $specialization_ids)->get();
        $doughnut_labels = $poRequests->whereNotNull('super_admin_approved_at')->pluck('name');

        // $doughnut_data = $poRequests->whereNotNull('super_admin_approved_at')->pluck('request_amount');
        // $doughnut_data = $poRequests->whereNotNull('super_admin_approved_at')->pluck('request_amount');

        $poRequests = $poRequests->whereNotNull('super_admin_approved_at')->get();
        $doughnut_data = [];
        foreach ($poRequests as $po) {
            array_push($doughnut_data, [
                $po->getPercentage()
            ]);
         } 


        $total_budget = $main_budgets->sum('budget_amount') - $manager->pppRequests()->whereNotNull('super_admin_approved_at')->sum('total_balance');
        return view('web.pages.sales.ppp-available.ppp-budget', [
            'specializations' => $specializations,
            'doughnut_labels' => $doughnut_labels,
            'doughnut_data' => $doughnut_data,
            'doughnut_data_color' => $doughnut_data_color,
            'doughnut' => $this->renderDoughnutLabel($total_budget),
            'items' => $items
        ]);
    }

    public function renderDoughnutLabel($amount) {
        $label = null;
        $units = ['', 'K', 'M', 'B', 'T'];
        for ($i = 0; $amount >= 1000; $i++) {
            $amount /= 1000;
        }
        
        $label = round($amount, 1) . $units[$i];

        return $label;
    }

    public function doughnutUpdate(Request $request) {
        $manager = auth()->guard('web')->user()->manager;
        // $specializations = $manager->specializations->get();
        $specialization_ids = $manager->specializations->pluck('id');

        $pppRequests = $manager->pppRequests()->whereNotNull('super_admin_approved_at');
        $specialization_id = $request->specialization_id ? $request->specialization_id : $specialization_ids;
        $ppp_ids = PppRequest::whereHas('product', function($query) use($specialization_id) {
            $query->where('specialization_id', $specialization_id);
        })->whereNotNull('super_admin_approved_at')->pluck('id');

        if($request->year) {
            $ppp_ids = PppRequest::whereYear('period_start_at', $request->year)->whereHas('product', function($query) use($specialization_id) {
                $query->where('specialization_id', $specialization_id);
            })->whereNotNull('super_admin_approved_at')->pluck('id');
        }

        $main_budgets = Budget::whereIn('specialization_id', $specialization_ids)->get();

        $poRequests = PoRequest::whereIn('ppp_request_id', $ppp_ids)->whereNotNull('super_admin_approved_at');
        $doughnut_data = [];
        $doughnut_labels = [];
        $doughnut_data_color = [];
        $items = [];

        foreach ($poRequests->get() as $po) {
            $color = '#'.str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
            array_push($items, [
                'legend' => $color,
                'name' => $po->name,
                'request_amount' => $po->getPercentage(true).' - '.$po->renderShortAmountLabel(),
                'po_date' => Carbon::parse($po->po_date)->format('F d Y'),
            ]);
            array_push($doughnut_data_color, $color);
        }

        $doughnut_labels = $poRequests->pluck('name');

        $doughnut_data = $poRequests->whereNotNull('super_admin_approved_at')->pluck('request_amount');

        $total_budget = $main_budgets->sum('budget_amount') - $pppRequests->sum('total_balance');
        
        $data = [];

      return response()->json([
            'doughnut_labels' => $doughnut_labels,
            'doughnut_data' => $doughnut_data,
            'doughnut_data_color' => $doughnut_data_color,
            'items' => $items
      ]);

    }
}
