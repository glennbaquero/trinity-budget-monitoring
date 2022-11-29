<?php

namespace App\Http\Controllers\Admin\PO;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Requests\PoRequest;

use Illuminate\Validation\ValidationException;

use App\Models\Users\Admin;

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
        return view('admin.po-requests.index');
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
        $item->can_approved = $item->canApproved('admin');
        $item->text = $item->canApprovedLabel('admin');
        $ppp = $item->pppRequest->getItem();
        $name = $item->user->renderName();
        $image_path = $item->user->renderImagePath();
        $file_attached = $item->files;
        $user = auth()->guard('admin')->user();
        $canApproved = $item->canApproved('admin');

        return view('admin.po-requests.show', [
            'name' => $name,
            'image_path' => $image_path,
            'po_request' => $item,
            'file_attached' => $file_attached,
            'ppp' => $ppp,
            'canApproved' => $canApproved
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
        $user = auth()->guard('admin')->user();
        $class = Admin::class;

        DB::beginTransaction();
            if($item->canApproved('admin')) {
                $item->updateStatus($request->status, $user, $class, $request);
            } else {
                if(!$item->manager_approved_at && $item->district_manager_approved_at) {
                    throw ValidationException::withMessages([
                        'message' => 'This request is need to be approved by the Manager.',
                    ]);    
                } elseif(!$item->manager_approved_at && !$item->district_manager_approved_at) {
                    throw ValidationException::withMessages([
                        'message' => 'This request is need to be approved by the District Manager.',
                    ]);
                } elseif($item->manager_approved_at && $item->district_manager_approved_at && $item->super_admin_approved_at) {
                    throw ValidationException::withMessages([
                        'message' => 'This request is already approved.',
                    ]);
                } elseif(!$user->isSuperAdmin()) {
                    throw ValidationException::withMessages([
                        'message' => 'No permission to approve this',
                    ]);
                }
            }
        DB::commit();

        switch ($request->status) {
            case 3:
                $message = "You denied the Purchase Order Request ID {$item->number}";
                $title = "Successfully update status";
                break;
            case 2:
                $message = "You have successfully approved the Purchase Order Request ID {$item->number}";
                $title = "Successfully update status";
                break;
            
            default:
                $message = "You set the status as pending for this Purchase Order Request ID {$item->number}";
                $title = "Successfully update status";
                break;
        }

        return response()->json([
            'message' => $message,
            'title' => $title
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
