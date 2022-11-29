<?php

namespace App\Http\Controllers\Web\PO;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Requests\PORequestStoreRequest;
use Illuminate\Validation\ValidationException;

use App\Models\Requests\PoRequest;
use App\Models\Requests\PppRequest;

use Storage;
use DB;
use Carbon\Carbon;

use PDF;

class PORequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('web.pages.sales.po-request.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $manager = auth()->guard('web')->user()->manager;
        $ppp_requests = $manager->pppRequests()->where('approval_status', 2)->whereNotNull('super_admin_approved_at')->get();
        return view('web.pages.sales.po-request.create', [
            'ppp_requests' => $ppp_requests
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PORequestStoreRequest $request)
    {
        // dd($request->description != 'null' ? $request->description : null);
        $pos = PoRequest::latest()->first();
        $ppp = PppRequest::find($request->ppp_request_id);
        $amount = str_replace(',', '', $request->request_amount);

        if($ppp->total_balance < $amount) {
            throw ValidationException::withMessages([
                'message' => 'Requested amount is not valid. You may request starting from '.  '₱ '.number_format((float)$ppp->total_balance , 2, '.', ','),
            ]);
        }
        DB::beginTransaction();
            $po_request = auth()->guard('web')->user()->poRequests()->create([
                'ppp_request_id' => $request->ppp_request_id,
                'name' => $request->name,
                'po_date' => $request->po_date,
                'program_title' => $request->program_title,
                'purpose' => $request->purpose,
                'request_amount' => $amount,
                'transaction_currency' => $request->transaction_currency,
                'transaction_group' => $request->transaction_group,
                'exchange_rate' => $request->exchange_rate,
                'supplier' => $request->supplier,
                'status' => $request->status,
                'country' => $request->country,
                'description' => $request->description != 'null' ? $request->description : null,
                'objective' => $request->objective != 'null' ? $request->objective : null,
                'scheme' => $request->scheme != 'null' ? $request->scheme : null,
                'mechanics' => $request->mechanics != 'null' ? $request->mechanics : null,
                'additional_notes' => $request->additional_notes != 'null' ? $request->additional_notes : null,
                'additional_instruction' => $request->additional_instruction != 'null' ? $request->additional_instruction : null
            ]);

            $po_request->update(['number' => $po_request->renderRequestOrderNumber()]);
            $current_balance = $po_request->pppRequest->decrement('current_balance', $po_request->request_amount);
            $total_balance = $po_request->pppRequest->decrement('total_balance', $po_request->request_amount);
            if($request->hasfile('files')) {
                foreach ($request->file('files') as $key => $file) {
                    // $path = $file->store('product-manual', 'public', );
                    // dd($path);
                    $file_name = $file->getClientOriginalName();
                    $file_path = 'public/po-requests/';
                    Storage::putFileAs($file_path, $file, $file_name);
                    $po_request->files()->create([
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
        $po_request = PoRequest::withTrashed()->findOrFail($id);
        $po_request->archiveUrl = $po_request->renderArchiveUrl();
        $po_request->restoreUrl = $po_request->renderRestoreUrl();
        $po_request->resubmitUrl = $po_request->renderResubmitUrl();
        $po_request->can_resubmit = $po_request->canResubmit();
        $po_request->download_url = $po_request->downloadToPDFUrl();
        $po_request->reason = $po_request->denieds()->count() ? $po_request->denieds()->latest()->first()->reason : '';
        $ppp = $po_request->pppRequest->getItem();
        $file_attached = $po_request->files;
        $representative = $po_request->user;
        $name = $representative->renderName();
        $image_path = $representative->renderImagePath();
        $manager = auth()->guard('web')->user()->manager;
        $ppp_requests = $manager->pppRequests()->where('approval_status', 2)->whereNotNull('super_admin_approved_at')->get();

        return view('web.pages.sales.po-request.show', [
            'name' => $name,
            'image_path' => $image_path,
            'ppp_requests' => $ppp_requests,
            'po_request' => $po_request,
            'file_attached' => $file_attached,
            'ppp' => $ppp
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
        $item = PoRequest::withTrashed()->findOrFail($id);
        $ppp = PppRequest::find($item->ppp_request_id);
        if($ppp->total_balance < $amount) {
            throw ValidationException::withMessages([
                'message' => 'Requested amount is not valid. You may request starting from '.  '₱ '.number_format((float)$ppp->total_balance , 2, '.', ','),
            ]);
        }
        $message = "You have successfully resubmitted the PO Request ID {$item->number}";
        DB::beginTransaction();
        $item->update([
            'name' => $request->name,
            'po_date' => $request->po_date,
            'program_title' => $request->program_title,
            'purpose' => $request->purpose,
            'request_amount' => $request->request_amount,
            'transaction_currency' => $request->transaction_currency,
            'transaction_group' => $request->transaction_group,
            'exchange_rate' => $request->exchange_rate,
            'supplier' => $request->supplier,
            'status' => $request->status,
            'country' => $request->country,
            'description' => $request->description != 'null' ? $request->description : null,
            'objective' => $request->objective != 'null' ? $request->objective : null,
            'scheme' => $request->scheme != 'null' ? $request->scheme : null,
            'mechanics' => $request->mechanics != 'null' ? $request->mechanics : null,
            'additional_notes' => $request->additional_notes != 'null' ? $request->additional_notes : null,
            'additional_instruction' => $request->additional_instruction != 'null' ? $request->additional_instruction : null,
            'denied_at' => null,
            'resubmitted_at' => Carbon::now(),
            'status' => 4
        ]);

        if($request->hasfile('files')) {
            foreach ($request->file('files') as $key => $file) {
                // $path = $file->store('product-manual', 'public', );
                // dd($path);
                $file_name = $file->getClientOriginalName();
                $file_path = 'public/po-requests/';
                Storage::putFileAs($file_path, $file, $file_name);
                $po_request->files()->create([
                    'file_path' => $file_path.$file_name,
                    'name' => $file_name
                ]);
            }
        }
        DB::commit();

        return response()->json([
            'message' => $message,
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\How  $sampleItem
     * @return \Illuminate\Http\Response
     */
    public function archive($id)
    {
        $item = PoRequest::withTrashed()->findOrFail($id);
        $item->archive();

        return response()->json([
            'message' => "You have successfully archived {$item->name}",
        ]);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\How  $sampleItem
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $item = PoRequest::withTrashed()->findOrFail($id);
        $item->unarchive();

        return response()->json([
            'message' => "You have successfully restored {$item->name}",
        ]);
    }


    public function convertToPDF($id) {
        $data = PoRequest::find($id);
        $img = url('images/LOGO.png');
        $bgImg = url('images/mngr-login-bg.svg');
        // $img = base64_encode(public_path('images/sales-login.svg'));
        // dd($img);
        // return view('pdf.po-download', compact('data'));
        $pdf = PDF::loadView('pdf.po-download', compact('data'));
        return $pdf->download('PO-REQUEST #'.$data->number.'.pdf');
    }
}
