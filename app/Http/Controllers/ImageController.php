<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function uploadAvatar(Request $request){
        if($request->hasFile('image')){
            $request->image->storeAs('public/avatar', 'avatar_' . $request->id . '.jpg');

            User::where('id', $request->id)->update(['avatar' => 'storage/avatar/' . 'avatar_' . $request->id . '.jpg']);
        }
        else{
            return response(['not an image'], 400);
        }
    }
}
