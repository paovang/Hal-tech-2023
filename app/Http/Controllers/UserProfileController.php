<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserProfileRequest;

class UserProfileController extends Controller
{
    
    public function listUserProfile()
    {
        $items = UserProfile::orderBy('id', 'desc')->get();

        return $items;
    }

    public function addUserProfile(UserProfileRequest $request)
    {
        if ($request->hasFile('image')) {
            $destination_path = '/images/UserProfile';
            $imageFile = $request->file('image');
            // Get just ext
            $extension = $imageFile->getClientOriginalExtension();
            // Filename to store
            $filename = 'user_profile' . '_' . time() . '.' . $extension;
            Storage::disk('public')->putFileAs($destination_path, $imageFile, $filename);

            $addUserProfile = new UserProfile();
            $addUserProfile->user_id = $request->user_id;
            $addUserProfile->image = $filename;
            $addUserProfile->save();

            return response()->json([
                'filename' => $filename
            ]);
        }
    }
}
