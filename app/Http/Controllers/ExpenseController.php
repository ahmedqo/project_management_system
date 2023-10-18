<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class ExpenseController extends Controller
{
    public function index()
    {
        $data = Expense::with('employee')->orderBy('id', 'DESC')->get();
        return view('expense.index', compact('data'));
    }

    public function create()
    {
        $employees = Employee::orderBy('id', 'DESC')->get();
        return view('expense.create', compact('employees'));
    }

    public function edit($id)
    {
        $data = Expense::findorfail($id);
        $employees = Employee::orderBy('id', 'DESC')->get();
        return view('expense.edit', compact('data', 'employees'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee' => ['required', 'integer'],
            'type' => ['required', 'string'],
            'date' => ['required', 'date'],
            'amount' => ['required', 'numeric'],
            'status' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.expenses.create")->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Expense::create([
            'employee' => $request->employee,
            'type' => $request->type,
            'date' => $request->date,
            'amount' => $request->amount,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return Redirect::route('views.expenses.index')->with([
            'message' => 'Expense successfully created',
            'type' => 'success'
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'employee' => ['required', 'integer'],
            'type' => ['required', 'string'],
            'date' => ['required', 'date'],
            'amount' => ['required', 'numeric'],
            'status' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.expenses.edit", $id)->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Expense::findorfail($id)->update([
            'employee' => $request->employee,
            'type' => $request->type,
            'date' => $request->date,
            'amount' => $request->amount,
            'status' => $request->status,
            'description' => $request->description,
            'note' => $request->note,
        ]);

        return Redirect::route('views.expenses.index')->with([
            'message' => 'Expense successfully updated',
            'type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        Expense::findorfail($id)->delete();

        return Redirect::route('views.expenses.index')->with([
            'message' => 'Expense successfully deleted',
            'type' => 'success'
        ]);
    }
}
