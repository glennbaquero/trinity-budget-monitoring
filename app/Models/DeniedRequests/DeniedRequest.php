<?php

namespace App\Models\DeniedRequests;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class DeniedRequest extends Model
{
    /*
     * Relationships
     */
    
    protected $guarded = [];

    /*
     * Relationship
     */
    
    public function requestable() {
        return $this->morphTo();
    }

    public function deniedable() {
        return $this->morphTo();
    }

    public function renderDate() {
        $date = Carbon::parse($this->denied_at)->format('F d, Y');
        
        return $date; 
    }
}
