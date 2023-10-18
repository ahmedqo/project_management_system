<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class LeaveController extends Controller
{
    public function index()
    {
        $data = Leave::with('employee')->orderBy('id', 'DESC')->get();
        return view('leave.index', compact('data'));
    }

    public function create()
    {
        $employees = Employee::orderBy('id', 'DESC')->get();
        return view('leave.create', compact('employees'));
    }

    public function edit($id)
    {
        $data = Leave::findorfail($id);
        $employees = Employee::orderBy('id', 'DESC')->get();
        return view('leave.edit', compact('data', 'employees'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee' => ['required', 'integer'],
            'type' => ['required', 'string'],
            'startDate' => ['required', 'date'],
            'endDate' => ['required', 'date'],
            'status' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.leaves.create")->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Leave::create([
            'employee' => $request->employee,
            'type' => $request->type,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return Redirect::route('views.leaves.index')->with([
            'message' => 'Leave successfully created',
            'type' => 'success'
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'employee' => ['required', 'integer'],
            'type' => ['required', 'string'],
            'startDate' => ['required', 'date'],
            'endDate' => ['required', 'date'],
            'status' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.leaves.edit", $id)->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Leave::findorfail($id)->update([
            'employee' => $request->employee,
            'type' => $request->type,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return Redirect::route('views.leaves.index')->with([
            'message' => 'Leave successfully updated',
            'type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        Leave::findorfail($id)->delete();

        return Redirect::route('views.leaves.index')->with([
            'message' => 'Leave successfully deleted',
            'type' => 'success'
        ]);
    }
}
