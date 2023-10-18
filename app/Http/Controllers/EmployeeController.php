<?php

namespace App\Http\Controllers;

use App\Functions\SystemFn;
use App\Mail\ResetMail;
use App\Models\AccountEmployee;
use App\Models\Complaint;
use App\Models\Contract;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\Insurance;
use App\Models\Leave;
use App\Models\Project;
use App\Models\ProjectEmployee;
use App\Models\Review;
use App\Models\TaskEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function status($id, $status)
    {
        Employee::findorfail($id)->update([
            'status' => $status,
        ]);

        return Redirect::route('views.employees.index')->with([
            'message' => 'User status successfully updated',
            'type' => 'success'
        ]);
    }

    public function index()
    {
        $data = Employee::orderBy('id', 'DESC')->get();
        return view('employee.index', compact('data'));
    }

    public function summary($id)
    {
        $data = Employee::findorfail($id);
        return view('employee.summary', compact('data'));
    }

    public function contract($id)
    {
        $data = Contract::where('employee', $id)->orderBy('id', 'DESC')->get();
        $employee = Employee::findorfail($id);
        return view('employee.contract', compact('data', 'employee'));
    }

    public function leave($id)
    {
        $data = Leave::where('employee', $id)->orderBy('id', 'DESC')->get();
        $employee = Employee::findorfail($id);
        return view('employee.leave', compact('data', 'employee'));
    }

    public function expense($id)
    {
        $data = Expense::where('employee', $id)->orderBy('id', 'DESC')->get();
        $employee = Employee::findorfail($id);
        return view('employee.expense', compact('data', 'employee'));
    }

    public function account($id)
    {
        $data = AccountEmployee::where('employee', $id)->get();
        $employee = Employee::findorfail($id);
        return view('employee.account', compact('data', 'employee'));
    }

    public function project($id)
    {
        $pros = ProjectEmployee::where('employee', $id)->get();
        $data =  Project::where('manager', $id)->get();
        foreach ($pros as $pro) {
            $data->push(Project::findorfail($pro->project));
        }
        $employee = Employee::findorfail($id);
        return view('employee.project', compact('data', 'employee'));
    }

    public function task($id)
    {
        $tasks = TaskEmployee::where('employee', $id)->get();
        $pending = [];
        $ready = [];
        $progress = [];
        $closed = [];
        $hold = [];

        foreach ($tasks as $task) {
            $_ = $task->task()->first();
            switch ($_->status) {
                case "pending":
                    array_push($pending, $_);
                    break;
                case "ready":
                    array_push($ready, $_);
                    break;
                case "progress":
                    array_push($progress, $_);
                    break;
                case "closed":
                    array_push($closed, $_);
                    break;
                case "hold":
                    array_push($hold, $_);
                    break;
            }
        }

        $employee = Employee::findorfail($id);
        return view('employee.task', compact('pending', 'ready', 'progress', 'closed', 'hold', 'employee'));
    }

    public function review_index($id)
    {
        $data = Review::where('employee', $id)->get();
        $employee = Employee::findorfail($id);
        return view('employee.review.index', compact('data', 'employee'));
    }

    public function review_summary($id)
    {
        $data = Review::findorfail($id);
        return view('employee.review.summary', compact('data'));
    }

    public function complaint_index($id)
    {
        $data = Complaint::where('employee', $id)->get();
        $employee = Employee::findorfail($id);
        return view('employee.complaint.index', compact('data', 'employee'));
    }

    public function complaint_summary($id)
    {
        $data = Complaint::findorfail($id);
        return view('employee.complaint.summary', compact('data'));
    }

    public function create()
    {
        $departments = Department::orderBy('id', 'DESC')->get();
        $designations = Designation::orderBy('id', 'DESC')->get();
        $insurances = Insurance::orderBy('id', 'DESC')->get();
        return view('employee.create', compact('departments', 'designations', 'insurances'));
    }

    public function edit($id)
    {
        $data = Employee::findorfail($id);
        $departments = Department::orderBy('id', 'DESC')->get();
        $designations = Designation::orderBy('id', 'DESC')->get();
        $insurances = Insurance::orderBy('id', 'DESC')->get();
        return view('employee.edit', compact('data', 'departments', 'designations', 'insurances'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'unique:employees'],
            'phone' => ['required', 'string', 'unique:employees'],
            'identity' => ['required', 'string', 'unique:employees'],
            'firstName' => ['required', 'string'],
            'lastName' => ['required', 'string'],
            'address' => ['required', 'string'],
            'state' => ['required', 'string'],
            'city' => ['required', 'string'],
            'zipcode' => ['required', 'string'],
            'identityType' => ['required', 'string'],
            'birthDate' => ['required', 'string'],
            'gender' => ['required', 'string'],
            'department'  => ['required', 'integer'],
            'designation'  => ['required', 'integer'],
            'insurance'  => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.employees.create")->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $file = null;

        if ($request->hasFile('photo')) {
            $file = substr(Storage::putFile('public/profile', $request->file('photo')), strlen('public/profile/'));
        }

        Employee::create([
            'email' => $request->email,
            'phone' => $request->phone,
            'identity' => $request->identity,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'address' => $request->address,
            'state' => $request->state,
            'city' => $request->city,
            'zipcode' => $request->zipcode,
            'identityType' => $request->identityType,
            'birthDate' => $request->birthDate,
            'gender' => $request->gender,
            'status' => 1,
            'department' => $request->department,
            'designation' => $request->designation,
            'insurance' => $request->insurance,
            'password' => Hash::make(Str::random(10)),
            'photo' => $file,
            'bg' => SystemFn::randomColor(),
        ]);

        $token = Str::random(20);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
        ]);

        $mail = new ResetMail([
            'name' => $request->firstName . ' ' . $request->lastName,
            'token' => $token,
        ]);

        //Mail::to($request->email)->send($mail);
        return Redirect::route('views.employees.index')->with([
            'message' => 'User successfully created',
            'type' => 'success'
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'unique:employees,email,' . $id],
            'phone' => ['required', 'string', 'unique:employees,phone,' . $id],
            'identity' => ['required', 'string', 'unique:employees,identity,' . $id],
            'firstName' => ['required', 'string'],
            'lastName' => ['required', 'string'],
            'address' => ['required', 'string'],
            'state' => ['required', 'string'],
            'city' => ['required', 'string'],
            'zipcode' => ['required', 'string'],
            'identityType' => ['required', 'string'],
            'birthDate' => ['required', 'string'],
            'gender' => ['required', 'string'],
            'department'  => ['required', 'integer'],
            'designation'  => ['required', 'integer'],
            'insurance'  => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.employees.edit", $id)->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $file = null;
        $employee = Employee::findorfail($id);

        if ($request->hasFile('photo')) {
            if (Storage::exists('public/profile/' . $employee->photo))
                Storage::delete('public/profile/' . $employee->photo);
            $file = substr(Storage::putFile('public/profile', $request->file('photo')), strlen('public/profile/'));
        }

        $employee->update([
            'email' => $request->email,
            'phone' => $request->phone,
            'identity' => $request->identity,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'address' => $request->address,
            'state' => $request->state,
            'city' => $request->city,
            'zipcode' => $request->zipcode,
            'identityType' => $request->identityType,
            'birthDate' => $request->birthDate,
            'gender' => $request->gender,
            'department' => $request->department,
            'designation' => $request->designation,
            'insurance' => $request->insurance,
            'photo' => $file,
        ]);

        return Redirect::route('views.employees.index')->with([
            'message' => 'User successfully updated',
            'type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        $employee = Employee::findorfail($id);
        if (Storage::exists('public/profile/' . $employee->photo))
            Storage::delete('public/profile/' . $employee->photo);
        $employee->delete();
        return Redirect::route('views.employees.index')->with([
            'message' => 'User successfully deleted',
            'type' => 'success'
        ]);
    }
}
