<?php

namespace App\Http\Controllers\Admin\Managers;

use App\Extenders\Controllers\FetchController as Controller;
use App\Models\Users\User;
use App\Models\Positions\Position;
use App\Models\Managers\Manager;
use App\Models\Specializations\Specialization;
class ManagerFetchController extends Controller
{
    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new Manager;
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
        if ($this->request->filled('email_verified_at')) {
            if ($this->request->input('email_verified_at') == 1) {
                $query = $query->whereNotNull('email_verified_at');
            } else {
                $query = $query->whereNull('email_verified_at');
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
            'name' => $item->renderName(),
            'email' => $item->email,
            'position' => $item->position->name,
            'status' => $item->renderStatus(),
            'is_assistant_manager' => $item->is_assistant_manager ? true : false,
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
        $managers = Manager::where('is_assistant_manager', false)->where('position_id', 1)->get();
        $positions = Position::all();
        $specializations = Specialization::all();        

        if ($id) {
            $item = Manager::withTrashed()->findOrFail($id);
            $item->specialization_ids = $item->specializations()->pluck('id')->toArray();                        
            $item->manager_id = $item->specializations()->pluck('id')->toArray();                        
            $item->archiveUrl = $item->renderArchiveUrl();
            $item->restoreUrl = $item->renderRestoreUrl();
            $item->renderImage = $item->renderImagePath();
        }

        return response()->json([
            'item' => $item,
            'positions' => $positions,
            'managers' => $managers,
            'specializations' => $specializations,

        ]);
    }
}
