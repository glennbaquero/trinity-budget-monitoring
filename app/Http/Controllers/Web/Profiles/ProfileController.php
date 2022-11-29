<?php

namespace App\Http\Controllers\Web\Profiles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Profiles\ProfileUpdateRequest;
use App\Http\Requests\Web\Profiles\ChangePasswordRequest;
use Illuminate\Validation\ValidationException;

use App\Models\Users\User;
use App\Models\Positions\Position;
use DB;
use Hash;
use Storage;

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

    // public function changePassword(ChangePasswordRequest $request)
    // {
    //     $request->user()->changePassword($request->input('current_password'), $request->input('new_password'), $request->user());

    //     return response()->json([
    //         'message' => 'You have successfully updated your password.',
    //     ]);
    // }
    
    /**
     * Update user password
     *
     * @return [boolean/string] $is_updated
     */
    public function updatePassword(Request $request) {
        $user = auth()->guard('web')->user();
        $current_password = $user->password;
        $new_password = Hash::make($request->new_password);
        DB::beginTransaction();
            if($request->new_password != $request->password_confirmation) {
                throw ValidationException::withMessages([
                    'password_confirm' => ['Password did not match.']
                ]);
            }

            if(Hash::check($request->current_password, $current_password)) {
                $user->update([
                    'password' => $new_password
                ]);
            } else {
                throw ValidationException::withMessages([
                    'current_password' => ['Old password did not match.']
                ]);
            }
        DB::commit();

        return response()->json([
            'is_updated' => true
        ]);
    }


    public function fetch(Request $request)
    {
        $item = $request->user();
        $item->renderImage = $item->renderImagePath();        
        $positions = Position::all();
        
        return response()->json([
            'item' => $item,
            'positions' => $positions,
            
        ]);
    }

    public function upload(Request $request) {
        $files = [];
        $directory = 'images';

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $action = new FileUploader;
                $action->execute($file, $directory);
                $vars = $action->getAttributes();
                $vars['file_path'] = $action->getFilePath();

                $newFile = FileRecord::create($vars);
                $files[] = FileRecord::formatItem($newFile);
            }
        }

        return response()->json([
            'files' => $files
        ]);
    }

    public function remove(Request $request, $id) {
        DB::beginTransaction();

        $filters = [
            'id' => $request->input('id'),
        ];

        $file = FileRecord::where($filters)->first();

        if ($file) {
            $file->delete();
        } else {
            abort(403, 'You are not authorized to delete the selected image.');
        }

        DB::commit();

        return response()->json(true);
    }

    public function removeTemp(Request $request) {
        DB::beginTransaction();

        $filters = [
            'id' => $request->input('id'),
        ];

        $file = FileRecord::where($filters)->whereNull('parent_id')->whereNull('parent_type')->first();

        if ($file) {
            $path = 'public/' . $file->file_path;

            if (Storage::exists($path)) {
                Storage::delete($path);
            }

            $file->delete();
        } else {
            abort(403, 'You are not authorized to delete the selected image.');
        }

        DB::commit();

        return response()->json(true);
    }

}
