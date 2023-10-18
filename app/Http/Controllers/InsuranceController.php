<?php

namespace App\Http\Controllers;

use App\Models\Insurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class InsuranceController extends Controller
{
    public function index()
    {
        $data = Insurance::orderBy('id', 'DESC')->get();
        return view('insurance.index', compact('data'));
    }

    public function create()
    {
        return view('insurance.create');
    }

    public function edit($id)
    {
        $data = Insurance::findorfail($id);
        return view('insurance.edit', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:insurances'],
            'company' => ['required', 'string'],
            'fees' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.insurances.create")->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Insurance::create([
            'name' => $request->name,
            'company' => $request->company,
            'fees' => $request->fees,
            'description' => $request->description,
        ]);

        return Redirect::route('views.insurances.index')->with([
            'message' => 'Insurance successfully created',
            'type' => 'success'
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:insurances,name,' . $id],
            'company' => ['required', 'string'],
            'fees' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.insurances.edit", $id)->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Insurance::findorfail($id)->update([
            'name' => $request->name,
            'company' => $request->company,
            'fees' => $request->fees,
            'description' => $request->description,
        ]);

        return Redirect::route('views.insurances.index')->with([
            'message' => 'Insurance successfully updated',
            'type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        Insurance::findorfail($id)->delete();

        return Redirect::route('views.insurances.index')->with([
            'message' => 'Insurance successfully deleted',
            'type' => 'success'
        ]);
    }
}
