<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CkeditorController extends Controller
{
    public function upload(Request $request) {
    	$result = $request->file('upload')->store('ckeditor-images', 'public');

    	$url = url('/') . '/storage/';

    	switch (config('web.filesystem')) {
            case 's3':
                    $url = config('filesystems.disks.s3.endpoint');
                break;
        }
    	
    	$path = $url . $result;

    	return response()->json([
    		'url' => $path,
    	]);
    }
}
