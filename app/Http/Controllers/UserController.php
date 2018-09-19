<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Mail\ForgotPasswordMail;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Lcobucci\JWT\Token;

class UserController extends Controller
{
    public function changePasswordUser(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6'
        ]);

        return $this->updatePassword($request->email, $request->password);
    }

    public function changePassword(Request $request){
        $this->validate($request, [
            'password' => 'required|confirmed|min:6'
        ]);

        $token = DB::table('password_resets')->where('token', $request->token)->first();

        if(!$token){
            return response(['data' => 'The token is invalid'], 403);
        }

        if($token->used == 1){
            return response(['data' => 'The token has been used'], 403);
        }

        $user = User::where('email', $token->email)->first();

        DB::table('password_resets')->update(['used' => 1]);

        return $this->updatePassword($user->email, $request->password);
    }

    public function forgotPassword(Request $request){
        $user = User::where('email', $request->email)->first();

        if(!$user){
            return response(['data' => 'The email does not exist'], 403);
        }

        $token = uniqid();

        DB::table('password_resets')->insert([
            'email' => $user->email,
            'token' => $token,
            'used' => 0,
            'created_at' => Carbon::now()->addHour()
        ]);

        Mail::send(new ForgotPasswordMail($user->email, $user->name, $token));

        return response(['data' => 'The email has been sent!'], 200);
    }

    protected function updatePassword($email, $password){
        User::where('email', $email)->update(['password' => bcrypt($password) ]);

        return User::where('email', $email)->get();
    }

    public function contactUsForm(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'name' => 'required',
            'text' => 'required|max:255'
        ]);

        DB::table('contact_us')->insert([
            'email' => $request->email,
            'name' => $request->name,
            'text' => $request->text,
            'device' => $request->device,
            'browser' => $request->browser,
            'created_at' => Carbon::now()->addHour()
        ]);

        return response(['data' => 'Form submitted successfully'], 200);
    }

    public function updateUser(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:10',
            'idCity' => 'required',
            'idCollege' => 'required',
        ]);

        User::where('email', $request->email)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'idCity' => $request->idCity,
            'idCollege' => $request->idCollege
        ]);

        return response(['data' => 'User updated successfully!'], 200);
    }
}
