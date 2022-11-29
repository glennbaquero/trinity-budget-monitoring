<?php

namespace App\Http\Controllers\Manager\PO;

use App\Extenders\Controllers\FetchController as Controller;

use App\Models\Requests\PoRequest;

use Carbon\Carbon;

class PORequestFetchController extends Controller
{
    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new PoRequest;
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
        $user = auth()->guard('manager')->user();
        
        // if($this->request->filled('status')) {
        // 	$query = $query->where('status', $this->request->status);
        // }

        if($user->is_assistant_manager) {
        	$user_ids = [];
        	foreach ($user->managers as $manager) {
                foreach ($manager->salesRepresentatives as $rep) {
                    array_push($user_ids, $rep->id);
                }
        	}
        	$query = $query->whereIn('user_id', $user_ids);
        } else {
        	$query = $query->whereIn('user_id', $user->salesRepresentatives->pluck('id'));
        }

        if($this->request->filled('tab') ) {
            if($user->is_assistant_manager) {
                switch ($this->request->tab) {
                    case 'pending':
                        $query = $query->whereNull('district_manager_approved_at')->whereNull('denied_at')->whereNull('resubmitted_at');
                        break;
                    case 'approved':
                        $query = $query->whereNotNull('district_manager_approved_at');
                        break;
                    case 'denied':
                        $query = $query->whereNull('district_manager_approved_at')->whereNotNull('denied_at');
                        break;
                    case 'resubmitted':
                        $query = $query->whereNull('district_manager_approved_at')->whereNotNull('resubmitted_at');
                        break;
                    default:
                        # code...
                        break;
                }
            } else {
                switch ($this->request->tab) {
                    case 'pending':
                        $query = $query->whereNull('manager_approved_at')->whereNull('denied_at')->whereNotNull('district_manager_approved_at')->whereNull('resubmitted_at');
                        break;
                    case 'approved':
                        $query = $query->whereNotNull('manager_approved_at');
                        break;
                    case 'denied':
                        $query = $query->whereNull('manager_approved_at')->whereNotNull('district_manager_approved_at')->whereNotNull('denied_at');
                        break;
                    case 'resubmitted':
                        $query = $query->whereNull('manager_approved_at')->whereNotNull('district_manager_approved_at')->whereNotNull('resubmitted_at');
                        break;
                    default:
                        # code...
                        break;
                }
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
                'po_number' => $item->number,
                'image_path' => $item->user->renderImagePath(),
                'short_description' => $item->description ? str_limit($item->description, 150) : '---',
                'request_amount' => $item->renderRequestAmount(),
                'person_in_charge' => $item->user->renderName(),
                'created_at' => $item->renderDate(),
                'deleted_at' => $item->deleted_at,

                // For export data
                'date' => Carbon::parse($item->date)->format('F d, Y'),
                'transaction_currency' => $item->transaction_currency,
                'ppp_request' => $item->pppRequest->name,
                'transaction_group' => $item->transaction_group,
                'supplier' => $item->supplier,
                'country' => $item->country,
                'exchange_rate' => $item->exchange_rate,
                'program_title' => $item->program_title,
                'purpose' => $item->purpose,
                'denied_at' => $item->denied_at ? Carbon::parse($item->denied_at)->format('F d, Y') : '---',
                'manager_approved_at' => $item->manager_approved_at ? Carbon::parse($item->manager_approved_at)->format('F d, Y') : '---',
                'district_manager_approved_at' => $item->district_manager_approved_at ? Carbon::parse($item->district_manager_approved_at)->format('F d, Y') : '---',
                'super_admin_approved_at' => $item->super_admin_approved_at ? Carbon::parse($item->super_admin_approved_at)->format('F d, Y') : '---',
                'resubmitted_at' => $item->resubmitted_at ? Carbon::parse($item->resubmitted_at)->format('F d, Y') : '---',
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
            'number' => $item->number,
            'showUrl' => $item->renderShowUrl('manager.'),
            'archiveUrl' => $item->renderArchiveUrl(),
            'restoreUrl' => $item->renderRestoreUrl(),
        ];
    }

    public function fetchView($id = null)
    {
        $item = null;

        if ($id) {
            $item = PoRequest::withTrashed()->findOrFail($id); 
            $item = $this->formatView($item);
        }

        return response()->json([
            'item' => $item,
        ]);
    }
}
