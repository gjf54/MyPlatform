<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EditProfileController extends Controller
{
    public function fresh_data(Request $request) {
        Validator::make($request->all(), [
            'name' => 'required',
            'surname' => 'required',
            'password' => 'required',
        ])->validate();

        $auth_user = auth()->user();

        if(auth()->attempt(['login' => $auth_user->login, 'password' => $request->password])){
            $user = User::where([
                'login' => $auth_user->login,
            ])->first();

            $user->name = $request->name;
            $user->surname = $request->surname;

            $user->save();
            Auth::setUser($user);

            return redirect(route('profile'));
        } 

        return back()->withErrors([
            'data' => 'Incorrect password!',
        ]);
    }

    public function fresh_password(Request $request) {
        Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:3',
            'confirm_new_password' => 'required|same:new_password',
        ])->validate();

        $auth_user = auth()->user();

        if(auth()->attempt(['login' => $auth_user->login, 'password' => $request->old_password])) {
            $user = User::where([
                'login' => $auth_user->login,
            ])->first();

            $user->password = Hash::make($request->new_password);
            
            $user->save();
            Auth::setUser($user);

            return back()->with('message', 'Password was changed!');
        }

        return back()->withErrors([
            'pass' => 'Incorrect password!',
        ]);
    }   

    public function fresh_email(Request $request) {
        Validator::make($request->all(),[
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ])->validate();

        $auth_user = auth()->user();

        if(auth()->attempt(['login' => $auth_user->login, 'password' => $request->password,])){
            $user = User::where([
                'login' => $auth_user->login,
            ])->first();
            
            $user->email = $request->email;

            $user->save();
            Auth::setUser($user);

            return back()->with('message', 'Success E-Mail update!');
        }

        return back()->withErrors([
            'email' => 'Incorrect password!'
        ]);
    }
}
