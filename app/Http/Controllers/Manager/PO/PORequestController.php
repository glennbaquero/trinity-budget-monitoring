<?php

namespace App\Http\Controllers\Manager\PO;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Requests\PoRequest;
use App\Models\Managers\Manager;

use Storage;
use DB;
use Carbon\Carbon;

class PORequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('web.pages.manager.po-request.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = PoRequest::withTrashed()->findOrFail($id);
        $item->reason = $item->denieds()->count() ? $item->denieds()->latest()->first()->reason : '';
        $item->can_approved = $item->canApproved('manager');
        $item->text = $item->canApprovedLabel('manager');
        $ppp = $item->pppRequest->getItem();
        $name = $item->user->renderName();
        $image_path = $item->user->renderImagePath();
        $file_attached = $item->files;

        return view('web.pages.manager.po-request.show',[
            'name' => $name,
            'image_path' => $image_path,
            'po_request' => $item,
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
        $user = auth()->guard('manager')->user();
        $class = Manager::class;
        DB::beginTransaction();
            if($request->status == 3) {
                $request->validate([
                    'reason' => 'required'
                ]);
                $item->update([
                    'denied_at' => Carbon::now(),
                    'status' => 3
                ]);

                $item->denieds()->create([
                    'deniedable_type' => $class,
                    'deniedable_id' => $user->id,
                    'reason' => $request->reason,
                    'denied_at' => Carbon::now()
                ]);

            } elseif ($request->status === 2) {
                if($user->is_assistant_manager && $user->position_id === 2) {
                    $item->update([
                        'status' => 2,
                        'denied_at' => null,
                        'resubmitted_at' => null,
                        'district_manager_approved_at' => Carbon::now(),
                        'approval_status' => 1, // manager approval
                    ]);    
                } else {
                    $item->update([
                        'status' => 2,
                        'denied_at' => null,
                        'resubmitted_at' => null,
                        'manager_approved_at' => Carbon::now(),
                        'approval_status' => 2 // superadmin approval
                    ]);
                }

                $item->approves()->create([
                    'approvable_type' => $class,
                    'approvable_id' => $user->id,
                    'approved_at' => Carbon::now(),
                ]);
            }
        DB::commit();

        return response()->json([
            'message' => true
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
