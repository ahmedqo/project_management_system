<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Note;
use App\Models\Notification;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class TaskController extends Controller
{
    public function status(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Task::findorfail($id)->update([
            'status' => $request->status,
        ]);

        return response()->json([
            'message' => 'Task successfully updated',
            'type' => 'success'
        ]);
    }

    public function summary($id)
    {
        $data = Task::findorfail($id);
        $employees = TaskEmployee::with('employee')->where('task', $id)->get();
        return view('task.summary', compact('data', 'employees'));
    }

    public function note_index($id)
    {
        $data = Task::findorfail($id);
        $notes = Note::where('task', $id)->orderBy('id', 'DESC')->get();
        return view('task.note', compact('data', 'notes'));
    }

    public function note_store(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'note' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.tasks.notes.index", $id)->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Note::create([
            'employee' => Auth::user()->id,
            'task' => $id,
            'note' => $request->note
        ]);

        return Redirect::route('views.tasks.notes.index', $id)->with([
            'message' => 'Note successfully created',
            'type' => 'success'
        ]);
    }

    public function note_destroy($task, $id)
    {
        Note::findorfail($id)->delete();

        return Redirect::route('views.tasks.notes.index', $task)->with([
            'message' => 'Note successfully deleted',
            'type' => 'success'
        ]);
    }

    public function index()
    {
        $pending = Task::where('status', 'pending')->orderBy('id', 'DESC')->get();
        $ready = Task::where('status', 'ready')->orderBy('id', 'DESC')->get();
        $progress = Task::where('status', 'progress')->orderBy('id', 'DESC')->get();
        $closed = Task::where('status', 'closed')->orderBy('id', 'DESC')->get();
        $hold = Task::where('status', 'hold')->orderBy('id', 'DESC')->get();
        return view('task.index', compact('pending', 'ready', 'progress', 'closed', 'hold'));
    }

    public function create()
    {
        $employees = Employee::orderBy('id', 'DESC')->get();
        $projects = Project::orderBy('id', 'DESC')->get();
        return view('task.create', compact('employees', 'projects'));
    }

    public function edit($id)
    {
        $data = Task::findorfail($id);
        $employees = Employee::orderBy('id', 'DESC')->get();
        $projects = Project::orderBy('id', 'DESC')->get();
        $taskEmployees = TaskEmployee::where('task', $id)->get();
        return view('task.edit', compact('data', 'employees', 'projects', 'taskEmployees'));
    }

    public function store(Request $request)
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
            return Redirect::route("views.tasks.create")->with([
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
                'body' => 'you are assigned to work on task #' . $task->id,
            ]);
        }

        return Redirect::route('views.tasks.index')->with([
            'message' => 'Task successfully created',
            'type' => 'success'
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:tasks,name,' . $id],
            'project' => ['required', 'numeric'],
            'priority' => ['required', 'string'],
            'dueDate' => ['required', 'date'],
            'duration' => ['required', 'numeric'],
            'status' => ['required', 'string'],
            'employees' => ['required', 'array'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.tasks.edit", $id)->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Task::findorfail($id)->update([
            'name' => $request->name,
            'project' => $request->project,
            'priority' => $request->priority,
            'dueDate' => $request->dueDate,
            'duration' => $request->duration,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        $employees = TaskEmployee::where('task', $id)->get(['employee']);
        TaskEmployee::where('task', $id)->delete();

        foreach ($employees as $employee) {
            if (!in_array($employee->employee, $request->employees))
                Notification::create([
                    'employee' => (int) $employee->employee,
                    'body' => 'you are no longer assigned to work on task #' . $id,
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
                    'body' => 'you are assigned to work on task #' . $id,
                ]);
        }

        return Redirect::route('views.tasks.index')->with([
            'message' => 'Task successfully updated',
            'type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        Task::findorfail($id)->delete();

        return Redirect::route('views.tasks.index')->with([
            'message' => 'Task successfully deleted',
            'type' => 'success'
        ]);
    }
}
