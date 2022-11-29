<?php

namespace App\Http\Controllers\Admin\PPP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Requests\PppRequest;

use Illuminate\Validation\ValidationException;

use App\Models\Users\Admin;

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
        $user = auth()->guard('admin')->user()->isSuperAdmin();
        $pending_status = auth()->guard('admin')->user()->isSuperAdmin() ? 2 : 1;
        $approved_status = auth()->guard('admin')->user()->isSuperAdmin() ? 2 : 2;
        return view('admin.ppp-requests.index', [
            'for_approval' => $user,
            'approved_status' => $approved_status,
            'pending_status' => $pending_status,
        ]);
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
        $item = PppRequest::withTrashed()->findOrFail($id);
        $item->budget_name = $item->budget->name;
        $item->product_name = $item->product->name;
        $item->period = $item->getDatePeriod();
        $item->reason = $item->denieds()->count() ? $item->denieds()->latest()->first()->reason : '';
        $item->attachments = $item->getAttachments();
        $user = auth()->guard('admin')->user();
        $canApproved = $item->canApprovedByLoggedUser($user);
        return view('admin.ppp-requests.show', [
            'item' => $item,
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
        $item = PppRequest::withTrashed()->findOrFail($id);
        $user = auth()->guard('admin')->user();
        $class = Admin::class;

        DB::beginTransaction();

            if(!$item->canApprovedByLoggedUser($user)) {
                if(!$user->isSuperAdmin() && $item->finance_approved_at) {
                    throw ValidationException::withMessages([
                        'message' => 'This request is already approved',
                    ]);
                } elseif ($user->isSuperAdmin() && !$item->finance_approved_at) {
                    throw ValidationException::withMessages([
                        'message' => 'This request has no approval of Finance.',
                    ]);
                } elseif ($user->isSuperAdmin() && $item->super_admin_approved_at) {
                    throw ValidationException::withMessages([
                        'message' => 'This request is already approved.',
                    ]);
                }
            }

            $item->updateStatus($request->status, $user, $class, $request);

        DB::commit();

        switch ($request->status) {
            case 3:
                $message = "You denied the PPP Request ID {$item->number}";
                $title = "Successfully update status";
                break;
            case 2:
                $message = "You have successfully approved the PPP Request ID {$item->number}";
                $title = "Successfully update status";
                break;
            
            default:
                $message = "You set the status as pending for this PPP Request ID {$item->number}";
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
