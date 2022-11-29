<?php

namespace App\Http\Controllers\Admin;

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

class DashboardController extends Controller
{
	public function index()
	{	

        // Bar Chart
        $specializations = Specialization::all();
        $specialization_ids = $specializations->pluck('id');
        $budget_list = [];
        $specialization_labels = [];
        $data = [];
        $date = [];
        $budget_array = [];
        $checker = [];

        $main_budgets = Budget::whereIn('specialization_id', $specialization_ids)->orderby('period_start_at', 'asc')->get();

        $in_array_specialization = [];
        // $budgets = $main_budgets->groupby(function($query) { return Carbon::parse($query->period_start_at)->format('F Y'); });
        $budgets = $main_budgets->groupby(function($query) { return $query->specialization->name; });
        // dd($budgets);
        $budget_arr = [];
        $total = 0;
        // dd($budgets);
        foreach ($budgets as $key => $budget) {
            $budget_per_month = [];
            $dates = [];
            foreach ($budget as $budget_key => $value) {
                $total += 1;
                $startOfMonth = Carbon::parse($value->period_start_at)->startOfMonth()->format('Y-m-d');
                $endOfMonth = Carbon::parse($value->period_start_at)->endOfMonth()->format('Y-m-d');

                // if(!in_array($value->specialization_name, $date, true)){
                if(!in_array(Carbon::parse($value->period_start_at)->format('F'), $date, true)){
                    // array_push($date,$value->specialization_name);
                    array_push($date, Carbon::parse($value->period_start_at)->format('F'));
                }
                $budget_arr[$value->specialization->name] = $value->budget_amount;
                // $dates = Carbon::parse($value->period_start_at)->format('F Y');
                
                if(!in_array(Carbon::parse($value->period_start_at)->format('F'), $dates, true)){
                    array_push($budget_per_month, $budget->whereBetween('period_start_at', [$startOfMonth, $endOfMonth])->sum('budget_amount'));
                    array_push($dates, Carbon::parse($value->period_start_at)->format('F'));
                }
            }

            // foreach ($date as $date_key => $_date) {
            //     if(isset($dates[$date_key]) && $_date == $dates[$date_key]) {
            //         var_dump($dates[$date_key]);    
            //         $dates[$date_key] = $_date;
            //     }

            //     // if(!isset($dates[$date_key])) {
            //     if($date !== $dates) {
            //         array_unshift($budget_per_month, 0);
            //     } 
            //     // }
            // }

            array_push($data, [
                'label' => $key,
                'backgroundColor' => '#'.str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT),
                'data' => $budget_per_month,
                'data_date' => collect($dates)->flatten()
            ]);
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

        // Dashboard Filter Data
        $periods = Budget::whereIn('specialization_id', $specialization_ids)->orderBy('period_start_at', 'asc')->get()->pluck('period_start_at');

         
        $months = [];
        $years = [];

        for ($i=1; $i <= 12 ; $i++) { 
            array_push($months, [
                'value' => $i,
                'name' => Carbon::parse('2020-'.$i.'-01')->format('F')
            ]);
        }

        foreach ($periods as $key => $value) {
            if(!in_array(Carbon::parse($value)->format('Y'), $years, TRUE)) {
                array_push($years, Carbon::parse($value)->format('Y'));
            }
        }

        return view('admin.dashboards.index', [
            'data' => $data,
            'date' => $date,
            'specializations' => $specializations,
            'doughnut_labels' => $doughnut_labels,
            'doughnut_data' => $doughnut_data,
            'doughnut_data_color' => $doughnut_data_color,
            'doughnut' => $this->renderDoughnutLabel($total_budget),
            'table_data' => $table_data,
            'table_data_ppp' => $table_data_ppp,
            'months' => $months,
            'years' => $years       
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
        $budget_array = [];

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

        $main_budgets = Budget::whereIn('specialization_id', $specialization_ids)->orderby('period_start_at', 'asc')->get();
        if($request->month) {
            $main_budgets = Budget::whereIn('specialization_id', $specialization_ids)->whereMonth('period_start_at', $request->month)->orderby('period_start_at', 'asc')->get();
        }

        $budgets = $main_budgets->groupby(function($query) use($type){ return Carbon::parse($query->period_start_at)->format($type); });

        if($request->year) {
            $main_budgets = Budget::whereYear('period_start_at', $request->year)->orWhereMonth('period_start_at', $request->month)->whereIn('specialization_id', $specialization_ids)->orderby('period_start_at', 'asc')->get();

            $budgets = $main_budgets->groupby(function($query) use($type){ return Carbon::parse($query->period_start_at)->format($type); });
        }
        $in_array_specialization = [];

        foreach ($budgets as $key => $budget) {
            foreach ($budget as $value) {
                if(!in_array($value->specialization_name, $date, true)){
                    array_push($date,$value->specialization_name);
                }
            }

            array_push($data, [
                'label' => $append.$key,
                'backgroundColor' => '#'.str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT),
                'data' => $budget->pluck('budget_amount')
            ]);
        }

        if($request->type === 2) {
            $data = [];
            $date = [];
            foreach ($specializations as $specialization) {
                $budgets = $specialization->budgets->groupby(function($query) use ($type) { 
                                return Carbon::parse($query->period_start_at)->format($type);
                            });
                // dd($budgets);


                foreach ($budgets as $key => $budget) {
                    if(!in_array($specialization->id, $in_array_specialization, TRUE)) {
                        array_push($in_array_specialization, $specialization->id);
                        if(!in_array($append.$key, $date, true)){
                            array_push($date, $append.$key);
                        }
                    }
                    array_push($budget_array, $budget->sum('budget_amount'));

                    if($request->month) {
                        $budget_array = [];
                        array_push($budget_array, $budget->whereMonth('period_start_at', $request->month)->sum('budget_amount'));
                    } 

                    if($request->year) {
                        array_push($budget_array, $budget->whereYear('period_start_at', $request->year)->sum('budget_amount'));
                    }
                }


                

                array_push($data, [
                    'label' => $specialization->name,
                    'backgroundColor' => '#'.str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT),
                    'data'=> $budget_array
                ]);

                $budget_array = [];
            }
        }


        return response()->json([
            'data' => $data,
            'date' => $date,
        ]);
    }	    
}
