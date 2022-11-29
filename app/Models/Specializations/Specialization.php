<?php

namespace App\Models\Specializations;

use App\Extenders\Models\BaseModel as Model;

use App\Models\Products\Product;
use App\Models\Managers\Manager;
use App\Models\Budgets\Budget;

class Specialization extends Model
{
	/*
	 * Relationship
	 */
	
	public function products() {
		return $this->hasMany(Product::class);
	}

    public function managers() {
        return $this->belongsToMany(Manager::class, 'manager_specializations', 'specialization_id', 'manager_id');
    }

    // public function budgets() {
    //     return $this->belongsToMany(Budget::class, 'budgets_specializations', 'specialization_id', 'budget_id');
    // }

    public function budgets() {
        return $this->hasMany(Budget::class);
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
            'description' => $this->description,
        ];
    }

    /**
     * @Setters
     */
    public static function store($request, $item = null, $columns = ['name','description'])
    {
        $vars = $request->only($columns);

        if (!$item) {
            $item = static::create($vars);
    } else {
            $item->update($vars);
        }

        return $item;
    }

    public static function formatItem($item) {
        return [
            'name' => $item->name,
            'description' => $item->description,
        ];
    }


    /**
     * @Render
     */
    
    public function renderShowUrl($prefix = 'admin') {
        return route($prefix . '.specializations.show', $this->id);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.specializations.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.specializations.restore', $this->id);
    }	

}