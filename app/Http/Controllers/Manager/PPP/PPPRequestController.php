<?php

namespace App\Http\Controllers\Manager\PPP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

use App\Http\Requests\Manager\Requests\PPPRequestStoreRequest;

use App\Models\Requests\PppRequest;
use App\Models\Budgets\Budget;
use App\Models\Products\Product;

use Storage;
use DB;
use Carbon\Carbon;

class PPPRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('web.pages.manager.ppp-budget.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->guard('manager')->user();
        $specialization_ids = $user->specializations->pluck('id');
        $budgets = Budget::whereIn('specialization_id', $specialization_ids)->get();
        $budget_specialization_ids = [];

        foreach ($budgets as $budget) {
            // foreach ($budget->specializations as $specialization) {
                array_push($budget_specialization_ids, [
                    $budget->specialization->id
                ]);
            // }
        }

        $products = Product::whereIn('specialization_id',  $budget_specialization_ids)->get();

        return view('web.pages.manager.ppp-budget.create',[
            'budgets' => $budgets,
            'products' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PPPRequestStoreRequest $request)
    {
        $ppp = PppRequest::latest()->first();
        $budget = Budget::find($request->budget_id);

        if($budget->budget_amount < $request->requested_amount) {
            throw ValidationException::withMessages([
                'message' => 'Requested amount is not valid. You may request starting from '.  '₱ '.number_format((float)$budget->budget_amount , 2, '.', ','),
            ]);
        }

        DB::beginTransaction();
            $item = auth()->guard('manager')->user()->pppRequests()->create([
                'period_start_at' => $request->period_start_at,
                'period_end_at' => $request->period_end_at,
                'name' => $request->name,
                'budget_id' => $request->budget_id,
                'product_id' => $request->product_id,
                'requested_amount' => $request->requested_amount,
                'current_balance' => $request->requested_amount,
                'total_balance' => $request->requested_amount,
                'line_business' => $request->line_business,
                'description' => $request->description,
            ]);

            $item->update(['number' => $item->renderRequestOrderNumber()]);
            if($request->hasfile('files')) {
                foreach ($request->file('files') as $key => $file) {
                    $file_name = $file->getClientOriginalName();
                    $file_path = 'public/ppp-requests/';
                    Storage::putFileAs($file_path, $file, $file_name);
                    $item->files()->create([
                        'file_path' => $file_path.$file_name,
                        'name' => $file_name
                    ]);
                }
            }
            
        DB::commit();

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = auth()->guard('manager')->user();
        $specialization_ids = $user->specializations->pluck('id');
        $item = PppRequest::withTrashed()->findOrFail($id);
        $item->period = $item->getDatePeriod();
        $item->reason = $item->denieds()->count() ? $item->denieds()->latest()->first()->reason : '';
        $item->attachments = $item->getAttachments();
        $budgets = Budget::whereIn('specialization_id', $specialization_ids)->get();
        $budget_specialization_ids = [];

        foreach ($budgets as $budget) {
            // foreach ($budget->specializations as $specialization) {
                array_push($budget_specialization_ids, [
                    $budget->specialization->id
                ]);
            // }
        }

        $products = Product::whereIn('specialization_id',  $budget_specialization_ids)->get();
        return view('web.pages.manager.ppp-budget.show', [
            'item' => $item,
            'budgets' => $budgets,
            'products' => $products
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = PppRequest::withTrashed()->findOrFail($id);
        $message = "You have successfully resubmitted the PPP Request ID {$item->number}";

        DB::beginTransaction();
            $item->update([
                'period_start_at' => $request->period_start_at,
                'period_end_at' => $request->period_end_at,
                'name' => $request->name,
                'budget_id' => $request->budget_id ? $request->budget_id : $item->budget_id,
                'product_id' => $request->product_id ? $request->product_id : $item->product_id,
                'requested_amount' => $request->requested_amount,
                'current_balance' => $request->requested_amount,
                'total_balance' => $request->requested_amount,
                'line_business' => $request->line_business,
                'description' => $request->description,
                'denied_at' => null,
                'resubmitted_at' => Carbon::now(),
                'status' => 4
            ]);

            if($request->hasfile('files')) {
                foreach ($request->file('files') as $key => $file) {
                    $file_name = $file->getClientOriginalName();
                    $file_path = 'public/ppp-requests/';
                    Storage::putFileAs($file_path, $file, $file_name);
                    $item->files()->create([
                        'file_path' => $file_path.$file_name,
                        'name' => $file_name
                    ]);
                }
            }
        DB::commit();

        return response()->json([
            'message' => $message
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
