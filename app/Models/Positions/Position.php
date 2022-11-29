<?php

namespace App\Models\Positions;

use App\Extenders\Models\BaseModel as Model;
use App\Models\Managers\Manager;
use App\Models\Users\User;
class Position extends Model
{
	/*
	 * Relationship
	 */
	
	public function positions() {
		return $this->hasMany(User::class);
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
    public static function store($request, $item = null, $columns = ['name'])
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
        return route($prefix . '.positions.show', $this->id);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.positions.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.positions.restore', $this->id);
    }	
}
