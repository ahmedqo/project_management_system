<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class PolicyController extends Controller
{
    public function summary($id)
    {
        $data = Policy::findorfail($id);
        return view('policy.summary', compact('data'));
    }

    public function index()
    {
        $data = Policy::orderBy('id', 'DESC')->get();
        return view('policy.index', compact('data'));
    }

    public function create()
    {
        return view('policy.create');
    }

    public function edit($id)
    {
        $data = Policy::findorfail($id);
        return view('policy.edit', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:policies'],
            'description' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.policies.create")->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Policy::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return Redirect::route('views.policies.index')->with([
            'message' => 'Policy successfully created',
            'type' => 'success'
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:policies,name,' . $id],
            'description' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.policies.edit", $id)->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Policy::findorfail($id)->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return Redirect::route('views.policies.index')->with([
            'message' => 'Policy successfully updated',
            'type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        Policy::findorfail($id)->delete();

        return Redirect::route('views.policies.index')->with([
            'message' => 'Policy successfully deleted',
            'type' => 'success'
        ]);
    }
}
