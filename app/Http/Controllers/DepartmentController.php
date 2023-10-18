<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class DepartmentController extends Controller
{
    public function index()
    {
        $data = Department::orderBy('id', 'DESC')->get();
        return view('department.index', compact('data'));
    }

    public function create()
    {
        return view('department.create');
    }

    public function edit($id)
    {
        $data = Department::findorfail($id);
        return view('department.edit', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:departments'],
            'location' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.departments.create")->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Department::create([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
        ]);

        return Redirect::route('views.departments.index')->with([
            'message' => 'Department successfully created',
            'type' => 'success'
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:departments,name,' . $id],
            'location' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.departments.edit", $id)->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Department::findorfail($id)->update([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
        ]);

        return Redirect::route('views.departments.index')->with([
            'message' => 'Department successfully updated',
            'type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        Department::findorfail($id)->delete();

        return Redirect::route('views.departments.index')->with([
            'message' => 'Department successfully deleted',
            'type' => 'success'
        ]);
    }
}
