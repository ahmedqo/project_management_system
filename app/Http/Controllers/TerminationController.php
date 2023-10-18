<?php

namespace App\Http\Controllers;

use App\Models\Termination;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class TerminationController extends Controller
{
    public function index()
    {
        //$dis =  Termination::where('id', 2)->with('employee')->get();
        $data = Termination::with('employee')->orderBy('id', 'DESC')->get();
        return view('termination.index', compact('data'));
    }

    public function create()
    {
        $employees = Employee::orderBy('id', 'DESC')->get();
        return view('termination.create', compact('employees'));
    }

    public function edit($id)
    {
        $data = Termination::findorfail($id);
        $employees = Employee::orderBy('id', 'DESC')->get();
        return view('termination.edit', compact('data', 'employees'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee' => ['required', 'integer'],
            'reason' => ['required', 'string'],
            'date' => ['required', 'date'],
            'status' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.terminations.create")->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Termination::create([
            'employee' => $request->employee,
            'reason' => $request->reason,
            'date' => $request->date,
            'description' => $request->description,
        ]);

        Employee::findorfail($request->employee)->update([
            'status' => $request->status,
        ]);

        return Redirect::route('views.terminations.index')->with([
            'message' => 'Termination successfully created',
            'type' => 'success'
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'employee' => ['required', 'integer'],
            'reason' => ['required', 'string'],
            'date' => ['required', 'date'],
            'status' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.terminations.edit", $id)->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Termination::findorfail($id)->update([
            'employee' => $request->employee,
            'reason' => $request->reason,
            'date' => $request->date,
            'description' => $request->description,
        ]);

        Employee::findorfail($request->employee)->update([
            'status' => $request->status,
        ]);

        return Redirect::route('views.terminations.index')->with([
            'message' => 'Termination successfully updated',
            'type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        Termination::findorfail($id)->delete();

        return Redirect::route('views.terminations.index')->with([
            'message' => 'Termination successfully deleted',
            'type' => 'success'
        ]);
    }
}
