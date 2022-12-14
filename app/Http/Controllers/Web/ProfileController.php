<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Profiles\ProfileUpdateRequest;
use App\Http\Requests\Web\Profiles\ChangePasswordRequest;

use App\Models\Users\User;
use App\Models\Positions\Position;
use Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $item = $request->user();

        return view('web.profiles.show', [
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileUpdateRequest $request)
    {
        $request->user();
        $message = 'You have successfully updated your profile.';
        $action = 1;


        $item = User::store($request, $request->user(), User::FILLABLE);

        return response()->json([
            'message' => $message,
            'action' => $action,

        ]);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $request->user()->changePassword($request->input('current_password'), $request->input('new_password'), $request->user());

        return response()->json([
            'message' => 'You have successfully updated your password.',
        ]);
    }

    public function fetch(Request $request)
    {
        $item = $request->user();
        // $item->renderImage = $item->renderImagePath();
        $positions = Position::all();
        
        return response()->json([
            'item' => $item,
            'positions' => $positions,
            
        ]);
    }
}
