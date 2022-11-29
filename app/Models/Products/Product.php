<?php

namespace App\Models\Products;

use App\Extenders\Models\BaseModel as Model;

use App\Models\Specializations\Specialization;
use App\Models\Requests\PppRequest;

class Product extends Model
{

    /*
     * Relationship
     */
    
    public function specialization() {
        return $this->belongsTo(Specialization::class)->withTrashed();
    }

    public function pppRequests() {
        return $this->hasMany(PppRequest::class);
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
    public static function store($request, $item = null, $columns = ['specialization_id','name','description'])
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
        ];
    }


    /**
     * @Render
     */
    
    public function renderShowUrl($prefix = 'admin') {
        return route($prefix . '.products.show', $this->id);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.products.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.products.restore', $this->id);
    }
}