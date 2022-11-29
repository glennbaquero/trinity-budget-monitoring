<?php

namespace App\Http\Controllers\Admin\Budgets;

use Illuminate\Http\Request;
use App\Extenders\Controllers\FetchController as Controller;

use App\Models\Budgets\Budget;
use App\Models\Specializations\Specialization;
class BudgetFetchController extends Controller
{
    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new Budget;
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
            $data = array_merge($data, [
                'id' => $item->id,
                'name' => $item->name,
                'period_start_at' => $item->period_start_at,
                'period_end_at' => $item->period_end_at,
                'remaining_budget' => '₱ '.number_format((float)$item->budget_amount , 2, '.', ','),
                'original_budget' => '₱ '.number_format((float)$item->original_budget , 2, '.', ','),
                'description' => $item->description,
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
            'showUrl' => $item->renderShowUrl(),
            'archiveUrl' => $item->renderArchiveUrl(),
            'restoreUrl' => $item->renderRestoreUrl(),
        ];
    }

    public function fetchView($id = null)
    {
        $item = null;
        $specializations = Specialization::all();

        if ($id) {
            $item = Budget::withTrashed()->findOrFail($id); 
            $item->specialization_ids = $item->specialization_id;            
            $item->budget_amount = number_format($item->budget_amount, 2, '.', ',');
            $item = $this->formatView($item);
        }       

        return response()->json([
            'item' => $item,
            'specializations' => $specializations,

        ]);
    }

    protected function formatView($item)
    {
        $item->archiveUrl = $item->renderArchiveUrl();
        $item->restoreUrl = $item->renderRestoreUrl();

        return $item;
    }
}
