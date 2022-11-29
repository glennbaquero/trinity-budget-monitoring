<?php

namespace App\Http\Controllers\Admin\PPP;

use App\Extenders\Controllers\FetchController as Controller;

use App\Models\Requests\PppRequest;

use Carbon\Carbon;

class PPPRequestDashboardFetchController extends Controller
{
    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new PppRequest;
    }

    /**
     * Custom filtering of query
     * 
     * @param Illuminate\Support\Facades\DB $query
     * @return Illuminate\Support\Facades\DB $query
     */
    public function filterQuery($query)
    {
        /**
         * Queries
         * 
         */
        if(!$this->request->filled('for_approval')) {
            if($this->request->filled('status')) {
                $query = $query->where('status', $this->request->status);
            }
        } else {
            if($this->request->filled('status')) {
                $query = $query->where('status', $this->request->status)->where('approval_status', $this->request->for_approval);
            }
        }        

        if(!auth()->guard('admin')->user()->isSuperAdmin()) {
            if($this->request->filled('status')) {
                $query = $query->where('status', 2)->whereNotNull(['finance_approved_at']);
            }
        } else {
            if($this->request->filled('status')) {
                $query = $query->where('status', 2)->whereNotNull(['super_admin_approved_at']);
            }
        }
        

        return $query;
    }

    /**
     * Custom formatting of data
     * 
     * @param Illuminate\Support\Collection $items
     * @return array $result
     */
    public function formatData($items)
    {
        $result = [];

        foreach($items as $item) {
            $data = $this->formatItem($item);
            $data = array_merge($data, [
                'id' => $item->id,
                'name' => $item->name,
                'line_business' => $item->line_business,
                'request_amount' => $item->renderRequestAmount(),
                'product' => $item->product->name,
                'date_period' => $item->getDatePeriod(),
                'brand' => $item->product->name,
                'ppp_date' => Carbon::parse($item->period_start_at)->format('M d Y').' to '. Carbon::parse($item->period_end_at)->format('M d Y'),
                'budget_amount' => $item->requested_amount,
                'remaining_budget' => $item->current_balance,                 
                                
                'attachment_count' => $item->getAttachment(),
                'showAttachmentIcon' => $item->files->count() ? true : false,
                'created_at' => $item->renderDate(),
                'denied_at' => $item->denied_at,
                'for_approval_of' => $item->finance_approve_at ? 'Super Admin' : 'Finance',

                // for export data 
                'number' => $item->number,
                'budget' => $item->budget->name,
                'current_balance' => $item->renderCurrentBalance(),

                'financed_approved_at' => $item->finance_approve_at ? Carbon::parse($item->finance_approve_at)->format('F d, Y') : '---',
                'admin_approved_at' => $item->super_admin_approved_at ? Carbon::parse($item->super_admin_approved_at)->format('F d, Y') : '---',
                'resubmitted_at' => $item->resubmitted_at ? Carbon::parse($item->resubmitted_at)->format('F d, Y') : '---',

                'approved_by' => $item->approves->count() ? $item->approves()->latest()->first()->approvable->renderName() : '---',
                'approved_date' => $item->approves->count() ? $item->approves()->latest()->first()->renderDate() : '---',
                'denied_by' => $item->denieds->count() ? $item->denieds()->latest()->first()->deniedable->renderName() : '---',
                'denied_at' => $item->denieds->count() ? $item->denieds()->latest()->first()->renderDate() : '---',
            ]);

            array_push($result, $data);
        }

        return $result;
    }

    /**
     * Build array data
     * 
     * @param  App\Contracts\AvailablePosition
     * @return array
     */
    protected function formatItem($item)
    {
        return [
            'showUrl' => $item->renderShowUrl('admin.'),
        ];
    }

    public function fetchView($id = null)
    {
        $item = null;

        if ($id) {
            $item = PppRequest::withTrashed()->findOrFail($id); 
        }

        return response()->json([
            'item' => $item,
        ]);
    }
}
