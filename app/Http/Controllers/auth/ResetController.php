<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Employee;

class ResetController extends Controller
{
    public function create($token)
    {
        return view('auth.reset', compact('token'));
    }

    public function store(Request $request, $token)
    {
        $validator = Validator::make($request->all(), [
            'new_password' => ['required', 'string'],
            'confirm_password' => ['required', 'string'],
            'token' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.reset", $token)->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $row = DB::table('password_resets')->where('token', $token)->first();

        if (!$row) {
            return Redirect::route("views.reset", $token)->with([
                'message' => 'Invalid token',
                'type' => 'error'
            ]);
        }

        $user = Employee::where('email', $row->email)->first();

        if (!$user) {
            return Redirect::route("views.reset", $token)->with([
                'message' => 'User do not exists',
                'type' => 'error'
            ]);
        }

        if ($request->new_password != $request->confirm_password) {
            return Redirect::route("views.reset", $token)->with([
                'message' => 'Confirm password missmatch',
                'type' => 'error'
            ]);
        }

        DB::table('password_resets')->where('token', $token)->delete();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return Redirect::route("views.login")->with([
            'message' => 'Password successfully updated',
            'type' => 'success'
        ]);
    }
}
