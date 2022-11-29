<?php

namespace App\Http\Controllers\Web\PO;

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
        $user = auth()->guard('web')->user();        

        if($this->request->filled('status')) {
        	$query = $query->where('status', $this->request->status);
        }

        return $query->where('user_id', $user->id);
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
            'number' => $item->number,
            'showUrl' => $item->renderShowUrl('web.'),
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

    // protected function formatView($item)
    // {
    //     $item->archiveUrl = $item->renderArchiveUrl();
    //     $item->restoreUrl = $item->renderRestoreUrl();

    //     return $item;
    // }
}
