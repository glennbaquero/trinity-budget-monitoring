<?php

namespace App\Models\Files;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
	protected $guarded = [];
	
    /*
     * Relationship
     */
    
    public function fileable() {
        return $this->morphTo();
    }

    public function renderFilePath() {
    	$storage = 'storage';
    	$file_path = str_replace('public', '', $this->file_path);
    	// dd($file_path);
    	return url($storage.$file_path);
    }
}
