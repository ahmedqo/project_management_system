<?php

namespace App\Http\Controllers;


use App\Models\Complaint;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class ComplaintController extends Controller
{
    public function summary($id)
    {
        $data = Complaint::findorfail($id);
        return view('complaint.summary', compact('data'));
    }

    public function index()
    {
        $data = Complaint::orderBy('id', 'DESC')->get();
        return view('complaint.index', compact('data'));
    }

    public function create()
    {
        $employees = Employee::orderBy('id', 'DESC')->get();
        return view('complaint.create', compact('employees'));
    }

    public function edit($id)
    {
        $data = Complaint::findorfail($id);
        $employees = Employee::orderBy('id', 'DESC')->get();
        return view('complaint.edit', compact('data', 'employees'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee' => ['required', 'integer'],
            'grievance' => ['required', 'string'],
            'date' => ['required', 'date'],
            'time' => ['required', 'string'],
            'location' => ['required', 'string'],
            'status' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.complaints.create")->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Complaint::create([
            'employee' => $request->employee,
            'grievance' => $request->grievance,
            'date' => $request->date,
            'time' => $request->time,
            'location' => $request->location,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return Redirect::route('views.complaints.index')->with([
            'message' => 'Complaint successfully created',
            'type' => 'success'
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'employee' => ['required', 'integer'],
            'grievance' => ['required', 'string'],
            'date' => ['required', 'date'],
            'time' => ['required', 'string'],
            'location' => ['required', 'string'],
            'status' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.complaints.edit", $id)->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Complaint::findorfail($id)->update([
            'employee' => $request->employee,
            'grievance' => $request->grievance,
            'date' => $request->date,
            'time' => $request->time,
            'location' => $request->location,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return Redirect::route('views.complaints.index')->with([
            'message' => 'Complaint successfully updated',
            'type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        Complaint::findorfail($id)->delete();

        return Redirect::route('views.complaints.index')->with([
            'message' => 'Complaint successfully deleted',
            'type' => 'success'
        ]);
    }
}
