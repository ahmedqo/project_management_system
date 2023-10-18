<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string'],
            'password' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return Redirect::route('views.login')->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return Redirect::route('views.dashboard');
        }

        return Redirect::route('views.login')->with([
            'message' => 'Login details are not valid',
            'type' => 'error'
        ]);
    }

    public function destroy()
    {
        Auth::logout();
        return Redirect::route("views.login")->with([
            'message' => 'Logout successfully',
            'type' => 'success'
        ]);
    }
}
