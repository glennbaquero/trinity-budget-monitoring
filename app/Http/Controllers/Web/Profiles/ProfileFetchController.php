<?php

namespace App\Http\Controllers\Web\Profiles;

use App\Extenders\Controllers\FetchController as Controller;
use App\Models\Users\User;
use App\Models\Positions\Position;

class ProfileFetchController extends Controller
{
	    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new User;
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
            'id' => $item->id,
            'fullname' => $item->renderName(),
            'firstname' => $item->first_name,
            'lastname' => $item->last_name,
            'email' => $item->email,
            'position_id' => $item->position_id,
            'contact_number' => $item->contact_number,
            'manager_id' => $item->manager_id,
            'manager_name' => $item->manager->renderName(),
            'status' => $item->renderStatus(),
            'status_class' => $item->renderStatus(false),
            'verified_at' => $item->renderDate('verified_at'),
            'created_at' => $item->renderDate(),
            'showUrl' => $item->renderShowUrl(),
            'deleted_at' => $item->deleted_at,
            'archiveUrl' => $item->renderArchiveUrl(),
            'restoreUrl' => $item->renderRestoreUrl(),
        ];
    }

    public function fetchView($id = null) {
        $item = [];
        $positions = Position::all();

        if ($id) {
            $item = User::withTrashed()->findOrFail($id);
            $item->archiveUrl = $item->renderArchiveUrl();
            $item->restoreUrl = $item->renderRestoreUrl();
            $item->renderImage = $item->renderImagePath();
        }

        return response()->json([
            'item' => $item,
            'positions' => $positions,
        ]);
    }

}

