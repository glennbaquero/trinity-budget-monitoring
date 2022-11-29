<?php

namespace App\Http\Controllers\Admin\PO;

use App\Extenders\Controllers\FetchController as Controller;

use App\Models\Requests\PoRequest;

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
        switch ($this->request->tab) {
            case 'pending':
                $query = $query->whereNull('super_admin_approved_at')->whereNull('denied_at')->whereNotNull('manager_approved_at')->whereNull('resubmitted_at');
                break;
            case 'approved':
                $query = $query->whereNotNull('super_admin_approved_at');
                break;
            case 'denied':
                $query = $query->whereNull('super_admin_approved_at')->whereNotNull('manager_approved_at')->whereNotNull('denied_at');
                break;
            case 'resubmitted':
                $query = $query->whereNull('super_admin_approved_at')->whereNotNull('manager_approved_at')->whereNotNull('resubmitted_at');
                break;
            default:
                # code...
                break;
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
                'short_description' => $item->description ? str_limit($item->description, 150) : '---',
                'request_amount' => $item->renderRequestAmount(),
                'person_in_charge' => $item->user->renderName(),
                'image_path' => $item->user->renderImagePath(),
                'created_at' => $item->renderDate(),
                'deleted_at' => $item->deleted_at,
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
            $item = PoRequest::withTrashed()->findOrFail($id); 
            $item = $this->formatView($item);
        }

        return response()->json([
            'item' => $item,
        ]);
    }
}
