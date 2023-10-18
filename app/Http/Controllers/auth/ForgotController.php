<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\ResetMail;
use App\Models\Employee;

class ForgotController extends Controller
{
    public function create()
    {
        return view('auth.forgot');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.forgot")->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $user = Employee::where('email', $request->email)->first();

        if (!$user) {
            return Redirect::route("views.forgot")->with([
                'message' => "User do not exists",
                'type' => 'error'
            ]);
        }

        $token = Str::random(20);

        DB::table('password_resets')->insert([
            'email' => $user->email,
            'token' => $token,
        ]);

        $mail = new ResetMail(
            [
                'name' => $user->first_name . ' ' . $user->last_name,
                'token' => $token,
            ]
        );

        Mail::to($user->email)->send($mail);
        return Redirect::route("views.forgot")->with([
            'message' => "Check your email to reset password",
            'type' => 'success'
        ]);
    }
}
