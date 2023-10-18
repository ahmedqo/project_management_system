<?php

namespace App\Http\Controllers;

use App\Models\AccountEmployee;
use App\Models\Complaint;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\Contract;
use App\Models\Expense;
use App\Models\Note;
use App\Models\Notification;
use App\Models\Project;
use App\Models\ProjectEmployee;
use App\Models\Review;
use App\Models\Task;
use App\Models\TaskEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    public function summary()
    {
        $data = Auth::user();
        return view('profile.summary', compact('data'));
    }

    public function contract()
    {
        $contracts = Contract::where('employee', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('profile.contract', compact('contracts'));
    }

    public function review_index()
    {
        $data = Review::where('employee', Auth::user()->id)->get();
        return view('profile.review.index', compact('data'));
    }

    public function review_summary($id)
    {
        $data = Review::findorfail($id);
        return view('profile.review.summary', compact('data'));
    }

    public function complaint_index()
    {
        $data = Complaint::where('employee', Auth::user()->id)->get();
        return view('profile.complaint.index', compact('data'));
    }

    public function complaint_summary($id)
    {
        $data = Complaint::findorfail($id);
        return view('profile.complaint.summary', compact('data'));
    }

    public function complaint_create()
    {
        return view('profile.complaint.create');
    }

    public function complaint_edit($id)
    {
        $data = Complaint::findorfail($id);
        return view('profile.complaint.edit', compact('data'));
    }

    public function complaint_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'grievance' => ['required', 'string'],
            'date' => ['required', 'date'],
            'time' => ['required', 'string'],
            'location' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.profile.complaints.create")->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Complaint::create([
            'employee' => Auth::user()->id,
            'grievance' => $request->grievance,
            'date' => $request->date,
            'time' => $request->time,
            'location' => $request->location,
            'status' => 'pending',
            'description' => $request->description,
        ]);

        return Redirect::route('views.profile.complaints.index')->with([
            'message' => 'Complaint successfully created',
            'type' => 'success'
        ]);
    }

    public function complaint_update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'grievance' => ['required', 'string'],
            'date' => ['required', 'date'],
            'time' => ['required', 'string'],
            'location' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.profile.complaints.edit", $id)->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Complaint::findorfail($id)->update([
            'employee' => Auth::user()->id,
            'grievance' => $request->grievance,
            'date' => $request->date,
            'time' => $request->time,
            'location' => $request->location,
            'description' => $request->description,
        ]);

        return Redirect::route('views.profile.complaints.index')->with([
            'message' => 'Complaint successfully updated',
            'type' => 'success'
        ]);
    }

    public function complaint_destroy($id)
    {
        Complaint::findorfail($id)->delete();

        return Redirect::route('views.profile.complaints.index')->with([
            'message' => 'Complaint successfully deleted',
            'type' => 'success'
        ]);
    }

    public function leave_index()
    {
        $leaves = Leave::where('employee', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('profile.leave.index', compact('leaves'));
    }

    public function leave_create()
    {
        return view('profile.leave.create');
    }

    public function leave_edit($id)
    {
        $data = Leave::findorfail($id);
        return view('profile.leave.edit', compact('data'));
    }

    public function leave_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => ['required', 'string'],
            'startDate' => ['required', 'date'],
            'endDate' => ['required', 'date'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.profile.leaves.create")->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Leave::create([
            'employee' => Auth::user()->id,
            'type' => $request->type,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'status' => 'pendding',
            'description' => $request->description,
        ]);

        return Redirect::route('views.profile.leaves.index')->with([
            'message' => 'Leave successfully created',
            'type' => 'success'
        ]);
    }

    public function leave_update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'type' => ['required', 'string'],
            'startDate' => ['required', 'date'],
            'endDate' => ['required', 'date'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.profile.leaves.edit", $id)->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Leave::findorfail($id)->update([
            'employee' => Auth::user()->id,
            'type' => $request->type,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'description' => $request->description,
        ]);

        return Redirect::route('views.profile.leaves.index')->with([
            'message' => 'Leave successfully updated',
            'type' => 'success'
        ]);
    }

    public function leave_destroy($id)
    {
        Leave::findorfail($id)->delete();

        return Redirect::route('views.profile.leaves.index')->with([
            'message' => 'Leave successfully deleted',
            'type' => 'success'
        ]);
    }

    public function expense_index()
    {
        $expenses = Expense::where('employee', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('profile.expense.index', compact('expenses'));
    }

    public function expense_create()
    {
        return view('profile.expense.create');
    }

    public function expense_edit($id)
    {
        $data = Expense::findorfail($id);
        return view('profile.expense.edit', compact('data'));
    }

    public function expense_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => ['required', 'string'],
            'date' => ['required', 'date'],
            'amount' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.profile.expenses.create")->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Expense::create([
            'employee' => Auth::user()->id,
            'type' => $request->type,
            'date' => $request->date,
            'amount' => $request->amount,
            'status' => 'pending',
            'description' => $request->description,
        ]);

        return Redirect::route('views.profile.expenses.index')->with([
            'message' => 'Expense successfully created',
            'type' => 'success'
        ]);
    }

    public function expense_update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'type' => ['required', 'string'],
            'date' => ['required', 'date'],
            'amount' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.profile.expenses.edit", $id)->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Expense::findorfail($id)->update([
            'employee' => Auth::user()->id,
            'type' => $request->type,
            'date' => $request->date,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        return Redirect::route('views.profile.expenses.index')->with([
            'message' => 'Expense successfully updated',
            'type' => 'success'
        ]);
    }

    public function expense_destroy($id)
    {
        Expense::findorfail($id)->delete();

        return Redirect::route('views.profile.expenses.index')->with([
            'message' => 'Expense successfully deleted',
            'type' => 'success'
        ]);
    }

    public function account()
    {
        $accounts = AccountEmployee::where('employee', Auth::user()->id)->with('account')->get();
        return view('profile.account', compact('accounts'));
    }

    public function task_index()
    {
        $tasks = TaskEmployee::where('employee', Auth::user()->id)->get();
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

        return view('profile.task.index', compact('pending', 'ready', 'progress', 'closed', 'hold'));
    }

    public function task_summary($id)
    {
        $data = Task::findorfail($id);
        $employees = TaskEmployee::with('employee')->where('task', $id)->get();
        return view('profile.task.summary', compact('data', 'employees'));
    }

    public function task_create()
    {
        $employees = Employee::orderBy('id', 'DESC')->get();
        return view('profile.task.create', compact('employees'));
    }

    public function task_edit($id)
    {
        $data = Task::findorfail($id);
        $employees = Employee::orderBy('id', 'DESC')->get();
        $taskEmployees = TaskEmployee::where('task', $id)->get();
        return view('profile.task.edit', compact('data', 'employees', 'taskEmployees'));
    }

    public function task_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:tasks'],
            'project' => ['required', 'numeric'],
            'priority' => ['required', 'string'],
            'dueDate' => ['required', 'date'],
            'duration' => ['required', 'numeric'],
            'status' => ['required', 'string'],
            'employees' => ['required', 'array'],
        ]);

        if ($validator->fails()) {
            return Redirect::route('views.profile.tasks.create')->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $task = Task::create([
            'name' => $request->name,
            'project' => $request->project,
            'priority' => $request->priority,
            'dueDate' => $request->dueDate,
            'duration' => $request->duration,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        foreach ($request->employees as $employee) {
            TaskEmployee::create([
                'task' => $task->id,
                'employee' => (int) $employee
            ]);

            Notification::create([
                'employee' => (int) $employee,
                'body' => 'you are assigned to work on task #' . $task->id . ' ' . $request->name,
            ]);
        }

        return Redirect::route('views.profile.projects.tasks', $request->project)->with([
            'message' => 'Task successfully created',
            'type' => 'success'
        ]);
    }

    public function task_update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:tasks,name,' . $id],
            'priority' => ['required', 'string'],
            'dueDate' => ['required', 'date'],
            'duration' => ['required', 'numeric'],
            'status' => ['required', 'string'],
            'employees' => ['required', 'array'],
        ]);

        if ($validator->fails()) {
            return Redirect::route('views.profile.tasks.edit', $id)->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Task::findorfail($id)->update([
            'name' => $request->name,
            'priority' => $request->priority,
            'dueDate' => $request->dueDate,
            'duration' => $request->duration,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        $task = Task::findorfail($id);

        $employees = TaskEmployee::where('task', $id)->get(['employee']);
        TaskEmployee::where('task', $id)->delete();

        foreach ($employees as $employee) {
            if (!in_array($employee->employee, $request->employees))
                Notification::create([
                    'employee' => (int) $employee->employee,
                    'body' => 'you are no longer assigned to work on task #' . $id . ' ' . $request->name,
                ]);
        }

        foreach ($request->employees as $employee) {
            TaskEmployee::create([
                'task' => $id,
                'employee' => (int) $employee
            ]);

            if (!$employees->contains('employee', $employee))
                Notification::create([
                    'employee' => (int) $employee,
                    'body' => 'you are assigned to work on task #' . $id . ' ' . $request->name,
                ]);
        }

        return Redirect::route('views.profile.projects.tasks', $task->project)->with([
            'message' => 'Task successfully updated',
            'type' => 'success'
        ]);
    }

    public function note_index($id)
    {
        $data = Task::findorfail($id);
        $notes = Note::where('task', $id)->orderBy('id', 'DESC')->get();
        return view('profile.task.note', compact('data', 'notes'));
    }

    public function note_store(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'note' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.profile.tasks.notes.index", $id)->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Note::create([
            'employee' => Auth::user()->id,
            'task' => $id,
            'note' => $request->note
        ]);

        return Redirect::route('views.profile.tasks.notes.index', $id)->with([
            'message' => 'Note successfully created',
            'type' => 'success'
        ]);
    }

    public function project_index()
    {
        $pros = ProjectEmployee::where('employee', Auth::user()->id)->get();
        $projects =  Project::where('manager', Auth::user()->id)->get();
        foreach ($pros as $pro) {
            if (!$projects->contains('id', $pro->project))
                $projects->push(Project::findorfail($pro->project));
        }
        $projects = $projects->sortBy([['id', 'desc']]);

        return view('profile.project.index', compact('projects'));
    }

    public function project_summary($id)
    {
        $data = Project::findorfail($id);
        $employees = ProjectEmployee::with('employee')->where('project', $id)->get();
        $progress = [
            'Completed task' => Task::where('project', $id)->where('status', 'closed')->count(),
            'Other tasks' => Task::where('project', $id)->where('status', '!=', 'hold')->where('status', '!=', 'closed')->count()
        ];
        return view('profile.project.summary', compact('data', 'employees', 'progress'));
    }

    public function project_task($id)
    {
        $data = Project::findorfail($id);

        $tasks = TaskEmployee::where('employee', Auth::user()->id)->get();
        $pending = [];
        $ready = [];
        $progress = [];
        $closed = [];
        $hold = [];

        if ($data->manager == Auth::user()->id) {
            $pending = Task::where('project', $id)->where('status', 'pending')->orderBy('id', 'DESC')->get();
            $ready = Task::where('project', $id)->where('status', 'ready')->orderBy('id', 'DESC')->get();
            $progress = Task::where('project', $id)->where('status', 'progress')->orderBy('id', 'DESC')->get();
            $closed = Task::where('project', $id)->where('status', 'closed')->orderBy('id', 'DESC')->get();
            $hold = Task::where('project', $id)->where('status', 'hold')->orderBy('id', 'DESC')->get();
        } else {
            foreach ($tasks as $task) {
                $_ = $task->task()->first();
                if ($_->project == $id) {
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
            }
        }
        return view('profile.project.task', compact('data', 'pending', 'ready', 'progress', 'closed', 'hold'));
    }

    public function project_status($id, $status)
    {
        Project::findorfail($id)->update([
            'status' => $status,
        ]);

        return Redirect::route('views.profile.projects.summary', $id)->with([
            'message' => 'Project status successfully updated',
            'type' => 'success'
        ]);
    }

    public function password()
    {
        return view('profile.password');
    }

    public function edit()
    {
        $data = Auth::user();
        return view('profile.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $data = Auth::user();

        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'unique:employees,email,' . $data->id],
            'phone' => ['required', 'string', 'unique:employees,phone,' . $data->id],
            'identity' => ['required', 'string', 'unique:employees,identity,' . $data->id],
            'firstName' => ['required', 'string'],
            'lastName' => ['required', 'string'],
            'address' => ['required', 'string'],
            'identityType' => ['required', 'string'],
            'birthDate' => ['required', 'string'],
            'gender' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.profile.edit", $data->id)->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $file = null;
        $employee = Employee::findorfail($data->id);

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
            'status' => $data->status,
            'department' => $data->department,
            'designation' => $data->designation,
            'insurance' => $data->insurance,
            'photo' => $file,
        ]);

        return Redirect::route('views.profile.summary')->with([
            'message' => 'Profile successfully updated',
            'type' => 'success'
        ]);
    }

    public function change(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oldPassword' => ['required', 'string'],
            'newPassword' => ['required', 'string'],
            'confirmPassword' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route('views.profile.password')->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        if (!Hash::check($request->oldPassword, Auth::user()->password)) {
            return Redirect::route('views.profile.password')->with([
                'message' => 'Old password missmatch',
                'type' => 'error'
            ]);
        }

        if ($request->newPassword != $request->confirmPassword) {
            return Redirect::route('views.profile.password')->with([
                'message' => 'Confirm password missmatch',
                'type' => 'error'
            ]);
        }

        $password = Hash::make($request->newPassword);
        Employee::find(Auth::user()->id)->update([
            "password" => $password
        ]);

        return Redirect::route('views.profile.password')->with([
            'message' => 'Password successfully updated',
            'type' => 'success'
        ]);
    }
}
