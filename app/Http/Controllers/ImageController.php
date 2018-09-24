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

    public function getPreviousAvatars($id){
        $response = Storage::disk('public')->files('/avatar');
        $pattern = '/avatar_' . $id . '_.*/';

        return response()->json([
            'pictures' => preg_grep($pattern , $response)
        ], 200);
    }
}
