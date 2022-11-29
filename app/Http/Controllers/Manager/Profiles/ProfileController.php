<?php

namespace App\Http\Controllers\Manager\Profiles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Manager\Profiles\ProfileUpdateRequest;
use App\Http\Requests\Manager\Profiles\ChangePasswordRequest;

use App\Models\Users\User;
use App\Models\Managers\Manager;
use App\Models\Positions\Position;


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

        // return view('web.pages.manager.user-acc', [

        return view('manager.profiles.show', [
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


        $columns = ['first_name', 'last_name', 'email', 'contact_number'];
        $item = User::store($request, $request->user(), $columns);

        // $item = User::store($request, $request->user(), User::FILLABLE);


        return response()->json([
            'message' => $message,
            'action' => $action,
            // 'reload' => $reload,


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

        $item->renderImage = $item->renderImagePath();
        
 		$positions = $item->getPosition();

 		// dd($positions);

        return response()->json([
            'item' => $item,
            'position' => $item->getPosition(),
        ]);
    }

}
