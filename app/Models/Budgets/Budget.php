<?php

namespace App\Models\Budgets;

use App\Extenders\Models\BaseModel as Model;
use App\Traits\NumberFormatTrait;

use App\Models\Requests\PppRequest;
use App\Models\Specializations\Specialization;

class Budget extends Model
{
    use NumberFormatTrait;

    protected $appends = ['specialization_name'];

    /*
     * Relationships
     */
    
    public function pppRequest() {
        return $this->hasMany(PppRequest::class);
    }

    // public function specializations() {
    //     return $this->belongsToMany(Specialization::class, 'budgets_specializations', 'budget_id', 'specialization_id')->with('products');
    // }

    public function specialization() {
        return $this->belongsTo(Specialization::class)->withTrashed();
    }



    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }

    /**
     * @Setters
     */
    public static function store($request, $item = null, $columns = ['name','period_start_at','period_end_at','description'])
    {
        $vars = $request->only($columns);
        $vars['specialization_id'] = $request->specialization_ids;

        if (!$item) {
            $vars['budget_amount'] = str_replace(',', '', $request->budget_amount);
            $vars['original_budget'] = str_replace(',', '', $request->budget_amount);
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        // if($request->specialization_ids) {
        //     $item->specializations()->sync($request->specialization_ids);
        // }

        return $item;
    }

    public static function formatItem($item) {
        return [
            'name' => $item->name,
            'period_start_at' => $item->period_start_at,
            'period_end_at' => $item->period_end_at,
            'budget_amount' => '₱ '.number_format((float)$item->budget_amount , 2, '.', ','),
            'description' => $item->description,
        ];
    }

    public function renderShortAmountLabel() {
        $label = null;
        $amount = $this->request_amount;
        $units = ['', 'K', 'M', 'B', 'T'];
        for ($i = 0; $amount >= 1000; $i++) {
            $amount /= 1000;
        }
        
        return round($amount, 1) . $units[$i];
    }    


    /**
     * @Render
     */

    // public function renderAmountWithFormat($amount) {
    //     return '₱ ' .number_format($amount, 2, '.', ',');
    // }    
    
    public function renderShowUrl($prefix = 'admin') {
        return route($prefix . '.budgets.show', $this->id);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.budgets.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.budgets.restore', $this->id);
    }

    public function getSpecializationNameAttribute() {
        return $this->specialization->name;
    }
}
