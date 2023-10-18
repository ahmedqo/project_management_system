<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\ContractPolicy;
use App\Models\Employee;
use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class ContractController extends Controller
{
    public function index()
    {
        $data = Contract::with('employee')->orderBy('id', 'DESC')->get();
        return view('contract.index', compact('data'));
    }

    public function create()
    {
        $employees = Employee::orderBy('id', 'DESC')->get();
        $policies = Policy::orderBy('id', 'DESC')->get();
        return view('contract.create', compact('employees', 'policies'));
    }

    public function edit($id)
    {
        $data = Contract::findorfail($id);
        $employees = Employee::orderBy('id', 'DESC')->get();
        $policies = Policy::orderBy('id', 'DESC')->get();
        $contractPolcies = ContractPolicy::where('contract', $id)->get();
        return view('contract.edit', compact('data', 'employees', 'policies', 'contractPolcies'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee' => ['required', 'integer'],
            'type' => ['required', 'string'],
            'salary' => ['required', 'numeric'],
            'compensation' => ['required', 'string'],
            'probation' => ['required', 'integer'],
            'startDate' => ['required', 'date'],
            'endDate' => ['required', 'date'],
            'policies' => ['required', 'array'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.contracts.create")->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $contract = Contract::create([
            'employee' => $request->employee,
            'type' => $request->type,
            'salary' => $request->salary,
            'compensation' => $request->compensation,
            'probation' => $request->probation,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'description' => $request->description,
        ]);

        foreach ($request->policies as $policy) {
            ContractPolicy::create([
                'contract' => $contract->id,
                'policy' => (int) $policy,
            ]);
        }

        return Redirect::route('views.contracts.index')->with([
            'message' => 'Contract successfully created',
            'type' => 'success'
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'employee' => ['required', 'integer'],
            'type' => ['required', 'string'],
            'salary' => ['required', 'numeric'],
            'compensation' => ['required', 'string'],
            'probation' => ['required', 'integer'],
            'startDate' => ['required', 'date'],
            'endDate' => ['required', 'date'],
            'policies' => ['required', 'array'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.contracts.edit", $id)->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        ContractPolicy::where('contract', $id)->delete();
        Contract::findorfail($id)->update([
            'employee' => $request->employee,
            'type' => $request->type,
            'salary' => $request->salary,
            'compensation' => $request->compensation,
            'probation' => $request->probation,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'description' => $request->description,
        ]);

        foreach ($request->policies as $policy) {
            ContractPolicy::create([
                'contract' => $id,
                'policy' => (int) $policy,
            ]);
        }

        return Redirect::route('views.contracts.index')->with([
            'message' => 'Contract successfully updated',
            'type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        Contract::findorfail($id)->delete();

        return Redirect::route('views.contracts.index')->with([
            'message' => 'Contract successfully deleted',
            'type' => 'success'
        ]);
    }
}
