<?php

namespace App\Http\Controllers\Admin\Analytics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Budgets\Budget;
use App\Models\Requests\PoRequest;
use App\Models\Requests\PppRequest;
use App\Models\Managers\Manager;
use App\Models\Users\User;
use App\Models\Specializations\Specialization;

use Storage;
use DB;
use Carbon\Carbon;

class DashboardGraphController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */ 
    
    public function index()
    {	
        // Bar Chart
        $specializations = Specialization::all();
        $specialization_ids = $specializations->pluck('id');
        $budget_list = [];
        $specialization_labels = [];
        $data = [];
        $date = [];
        $in_array_specialization = [];
        
        $main_budgets = Budget::whereHas('specializations', function($query) use ($specialization_ids) {
            $query->whereIn('id', $specialization_ids);
        })->get();

        foreach ($specializations as $specialization) {
            $budgets = $specialization->budgets->groupby(function($query) { return Carbon::parse($query->period_start_at)->format('F Y'); });
            foreach ($budgets as $key => $budget) {
                if(!in_array($specialization->id, $in_array_specialization, TRUE)) {
                    array_push($in_array_specialization, $specialization->id);
                    if(!in_array($key, $date, true)){
                        array_push($date, [
                            $key
                        ]);
                    }
                    array_push($data, [
                        'label' => $specialization->name,
                        'backgroundColor' => '#'.str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT),
                        'data'=> $specialization->budgets->pluck('budget_amount')
                    ]);
                }
            }
        }

        // Doughnut chart
        
        $pppRequests = PppRequest::all();
        $specializations = Specialization::all();
        $ppp_requests = PppRequest::whereNotNull('super_admin_approved_at')->get();
        $table_data_ppp = [];               

        foreach ($ppp_requests as $ppp) {
          $color = '#'.str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
           array_push($table_data_ppp, [
                'legend' => $color,
                'name' => $ppp->name,
                'request_amount' => $this->renderDoughnutLabel($ppp->total_balance),
                'ppp_date' => Carbon::parse($ppp->period_start_at)->format('M d Y').' to '. Carbon::parse($ppp->period_end_at)->format('M d Y'),
                'budget_amount' => $ppp->requested_amount,
                'remaining_budget' => $ppp->current_balance,                 
                'showUrl' => $ppp->renderShowUrl(),   
           ]);                 
        }

        $pppRequests = PppRequest::all();
        $ppp_ids = $pppRequests->pluck('id');
        $poRequests = PoRequest::whereIn('ppp_request_id', $ppp_ids);
        $doughnut_data = [];
        $doughnut_labels = [];
        $doughnut_data_color = [];
        $table_data = [];

        foreach ($poRequests->get() as $po) {
            $color = '#'.str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
            array_push($table_data, [
                'legend' => $color,
                'name' => $po->name,
                'request_amount' => $po->getPercentage(true).' - '.$po->renderShortAmountLabel(),
                'po_date' => Carbon::parse($po->po_date)->format('F d Y'),


            ]);
            array_push($doughnut_data_color, $color);
        }

        // for ($i=0; $i < $poRequests->count(); $i++) {
        // }

        $doughnut_labels = $poRequests->whereNotNull('super_admin_approved_at')->pluck('name');

        $doughnut_data = $poRequests->whereNotNull('super_admin_approved_at')->pluck('request_amount');

        $total_budget = $main_budgets->sum('budget_amount') - $pppRequests->sum('total_balance');

        return view('admin.dashboards.index', [
            'data' => $data,
            'date' => $date,
            'specializations' => $specializations,
            'doughnut_labels' => $doughnut_labels,
            'doughnut_data' => $doughnut_data,
            'doughnut_data_color' => $doughnut_data_color,
            'doughnut' => $this->renderDoughnutLabel($total_budget),
            'table_data' => $table_data,
            'table_data_ppp' => $table_data_ppp            
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

    public function update(Request $request) {
        $specializations = Specialization::all();
        $specialization_ids = $specializations->pluck('id');
    	$budget_list = [];
    	$specialization_labels = [];
    	$data = [];
    	$date = [];

    	switch ($request->type) {
    		case 1:
    			$type = 'W';
    			$append = 'Week #';
    			break;
    		case 2:
    			$type = 'F d Y';
    			$append = null;
    			break;
    		
    		default:
    			$type = 'F Y';
    			$append = null;
    			break;
    	}

    	$main_budgets = Budget::whereHas('specializations', function($query) use ($specialization_ids) {
    		$query->whereIn('id', $specialization_ids);
    	})->get();

        $in_array_specialization = [];

    	foreach ($specializations as $specialization) {
    		$budgets = $specialization->budgets->groupby(function($query) use ($type) { return Carbon::parse($query->period_start_at)->format($type); });

    		foreach ($budgets as $key => $budget) {
                if(!in_array($specialization->id, $in_array_specialization, TRUE)) {
                    array_push($in_array_specialization, $specialization->id);
        			if(!in_array($key, $date, true)){
    			        array_push($date, [
    		    			$append.$key
    		    		]);
    				}
        			array_push($data, [
        				'label' => $specialization->name,
        				'backgroundColor' => '#'.str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT),
        				'data'=> $specialization->budgets->pluck('budget_amount')
        			]);
                }
    		}
    	}

    	return response()->json([
    		'data' => $data,
    		'date' => $date,
    	]);
    }

    public function doughnutUpdate(Request $request) {
        $specialization_ids = Specialization::pluck('id');

        $pppRequests = PppRequest::all();
        $specialization_id = $request->specialization_id;
        $ppp_ids = PppRequest::whereHas('product', function($query) use($specialization_id) {
            $query->where('specialization_id', $specialization_id);
        })->pluck('id');

        $main_budgets = Budget::whereIn('specialization_id', $specialization_ids)->get();

        $poRequests = PoRequest::whereIn('ppp_request_id', $ppp_ids);
        $doughnut_data = [];
        $doughnut_labels = [];
        $doughnut_data_color = [];
        $table_data = [];

        foreach ($poRequests->get() as $po) {
            $color = '#'.str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
            array_push($table_data, [
                'legend' => $color,
                'name' => $po->name,
                'request_amount' => $po->renderShortAmountLabel(),
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
            'table_data' => $table_data,
            'total_budget' => $this->renderDoughnutLabel($total_budget)
        ]);
    }
}
