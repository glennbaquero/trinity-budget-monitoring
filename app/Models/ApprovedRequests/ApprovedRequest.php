<?php

namespace App\Models\ApprovedRequests;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class ApprovedRequest extends Model
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
    
    public function approvable() {
        return $this->morphTo();
    }

    public function renderDate() {
        $date = Carbon::parse($this->approved_at)->format('F d, Y');
        
        return $date; 
    }
}
