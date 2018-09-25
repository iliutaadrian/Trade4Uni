<?php

namespace App\Http\Controllers;

use App\User;

use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function uploadAvatar(Request $request){
        $exploded = explode(',', $request->image);
        $decoded = base64_decode($exploded[1]);

        if($request->image != null){
            $time = time();
            $path = 'avatar/avatar_' . $request->id . '_' . $time . '.png';

            Storage::disk('public')->put($path, $decoded);

            User::where('id', $request->id)->update(['avatar' => '/storage/' . $path]);

            return response(['path' => '/storage/' . $path], 200);
        }
        else{
            return response('not an image!', 400);
        }
    }

    public function changeAvatar(Request $request){
        if($request->avatar != null){
            User::where('id', $request->id)->update(['avatar' => $request->avatar ]);
            return response('avatar updated succesfully', 200);
        }
        else{
            return response('not an image', 400);
        }
    }

    public function getPreviousAvatars($id){
        $currentAvatar = User::where('id', $id)->first()['avatar'];
        $all = Storage::disk('public')->files('/avatar');
        $pattern = '/avatar_' . $id . '_.*/';
        $files = preg_grep($pattern , $all);
        $response = array_filter($files, function($val) use ($currentAvatar) { if('/storage/' . $val != $currentAvatar) return $val; });
        return response()->json([
            'pictures' => $response
        ], 200);
    }

    public function deletePreviousAvatar(Request $request){
        $exists = Storage::disk('public')->exists($request->name);
        if($exists){
            Storage::disk('public')->delete($request->name);
            return response('file deleted succesfully', 200);
        }
        else{
            return response('file does not exist', 400);
        }
    }
}
