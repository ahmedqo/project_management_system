<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountClient;
use App\Models\Client;
use App\Models\AccountEmployee;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function index()
    {
        $data = Account::orderBy('id', 'DESC')->get();
        return view('account.index', compact('data'));
    }

    public function create()
    {
        $employees = Employee::orderBy('id', 'DESC')->get();
        $clients = Client::orderBy('id', 'DESC')->get();
        return view('account.create', compact('employees', 'clients'));
    }

    public function edit($id)
    {
        $data = Account::findorfail($id);
        $employees = Employee::orderBy('id', 'DESC')->get();
        $clients = Client::orderBy('id', 'DESC')->get();
        $bankEmployee = AccountEmployee::where('account', $id)->first();
        $bankClient = AccountClient::where('account', $id)->first();
        return view('account.edit', compact('data', 'employees', 'clients', 'bankEmployee', 'bankClient'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bank' => ['required', 'string'],
            'rib' => ['required', 'string'],
            'type' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.accounts.create")->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        if ($request->type == 'employee') {
            $validator = Validator::make($request->all(), [
                'employee' => ['required'],
            ]);

            if ($validator->fails()) {
                return Redirect::route("views.accounts.create")->with([
                    'message' => $validator->errors()->all(),
                    'type' => 'error'
                ]);
            }
        }

        if ($request->type == 'client') {
            $validator = Validator::make($request->all(), [
                'client' => ['required'],
            ]);

            if ($validator->fails()) {
                return Redirect::route("views.accounts.create")->with([
                    'message' => $validator->errors()->all(),
                    'type' => 'error'
                ]);
            }
        }

        $account = Account::create([
            'bank' => $request->bank,
            'type' => $request->type,
            'rib' => $request->rib,
            'description' => $request->description,
        ]);

        if ($request->type == 'employee') {
            AccountEmployee::create([
                'employee' => $request->employee,
                'account' => $account->id,
            ]);
        }

        if ($request->type == 'client') {
            AccountClient::create([
                'client' => $request->client,
                'account' => $account->id,
            ]);
        }

        return Redirect::route('views.accounts.index')->with([
            'message' => 'Account successfully created',
            'type' => 'success'
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'bank' => ['required', 'string'],
            'rib' => ['required', 'string'],
            'type' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.accounts.edit")->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        if ($request->type == 'employee') {
            $validator = Validator::make($request->all(), [
                'employee' => ['required'],
            ]);

            if ($validator->fails()) {
                return Redirect::route("views.accounts.edit")->with([
                    'message' => $validator->errors()->all(),
                    'type' => 'error'
                ]);
            }
        }

        if ($request->type == 'client') {
            $validator = Validator::make($request->all(), [
                'client' => ['required'],
            ]);

            if ($validator->fails()) {
                return Redirect::route("views.accounts.create")->with([
                    'message' => $validator->errors()->all(),
                    'type' => 'error'
                ]);
            }
        }

        Account::findorfail($id)->update([
            'bank' => $request->bank,
            'type' => $request->type,
            'rib' => $request->rib,
            'description' => $request->description,
        ]);

        AccountEmployee::where('account', $id)->delete();
        AccountClient::where('account', $id)->delete();

        if ($request->type == 'employee') {
            AccountEmployee::create([
                'employee' => $request->employee,
                'account' => $id,
            ]);
        }

        if ($request->type == 'client') {
            AccountClient::create([
                'client' => $request->client,
                'account' => $id,
            ]);
        }

        return Redirect::route('views.accounts.index')->with([
            'message' => 'Account successfully updated',
            'type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        Account::findorfail($id)->delete();
        AccountEmployee::where('account', $id)->delete();

        return Redirect::route('views.accounts.index')->with([
            'message' => 'Account successfully deleted',
            'type' => 'success'
        ]);
    }
}
