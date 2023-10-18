<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Employee;
use App\Models\Notification;
use App\Models\Project;
use App\Models\ProjectEmployee;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class ProjectController extends Controller
{

    public function index()
    {
        $data = Project::orderBy('id', 'DESC')->get();
        return view('project.index', compact('data'));
    }

    public function summary($id)
    {
        $data = Project::findorfail($id);
        $employees = ProjectEmployee::with('employee')->where('project', $id)->get();
        $progress = [
            'Completed task' => Task::where('project', $id)->where('status', 'closed')->count(),
            'Other tasks' => Task::where('project', $id)->where('status', '!=', 'hold')->where('status', '!=', 'closed')->count()
        ];
        return view('project.summary', compact('data', 'employees', 'progress'));
    }

    public function task($id)
    {
        $data = Project::findorfail($id);
        $pending = Task::where('project', $id)->where('status', 'pending')->orderBy('id', 'DESC')->get();
        $ready = Task::where('project', $id)->where('status', 'ready')->orderBy('id', 'DESC')->get();
        $progress = Task::where('project', $id)->where('status', 'progress')->orderBy('id', 'DESC')->get();
        $closed = Task::where('project', $id)->where('status', 'closed')->orderBy('id', 'DESC')->get();
        $hold = Task::where('project', $id)->where('status', 'hold')->orderBy('id', 'DESC')->get();
        return view('project.task', compact('data', 'pending', 'ready', 'progress', 'closed', 'hold'));
    }

    public function create()
    {
        $clients = Client::orderBy('id', 'DESC')->get();
        $employees = Employee::orderBy('id', 'DESC')->get();
        return view('project.create', compact('clients', 'employees'));
    }

    public function edit($id)
    {
        $data = Project::findorfail($id);
        $clients = Client::orderBy('id', 'DESC')->get();
        $employees = Employee::orderBy('id', 'DESC')->get();
        $projectEmployees = ProjectEmployee::where('project', $id)->get();
        return view('project.edit', compact('data', 'clients', 'employees', 'projectEmployees'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client' => ['required', 'integer'],
            'manager' => ['required', 'integer'],
            'name' => ['required', 'string', 'unique:projects'],
            'dueDate' => ['required', 'date'],
            'budget' => ['required', 'numeric'],
            'status' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.projects.create")->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $project = Project::create([
            'client' => $request->client,
            'manager' => $request->manager,
            'name' => $request->name,
            'dueDate' => $request->dueDate,
            'budget' => $request->budget,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        Notification::create([
            'employee' => $request->manager,
            'body' => 'you are assigned to manage project #' . $project->id,
        ]);

        if ($request->employees)
            foreach ($request->employees as $employee) {
                ProjectEmployee::create([
                    'project' => $project->id,
                    'employee' => (int) $employee,
                ]);

                Notification::create([
                    'employee' => (int) $employee,
                    'body' => 'you are assigned to join the team on project #' . $project->id,
                ]);
            }

        return Redirect::route('views.projects.index')->with([
            'message' => 'Project successfully created',
            'type' => 'success'
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'client' => ['required', 'integer'],
            'manager' => ['required', 'integer'],
            'name' => ['required', 'string', 'unique:projects,name,' . $id],
            'dueDate' => ['required', 'date'],
            'budget' => ['required', 'numeric'],
            'status' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.projects.edit", $id)->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $project = Project::findorfail($id);
        Project::findorfail($id)->update([
            'client' => $request->client,
            'manager' => $request->manager,
            'name' => $request->name,
            'dueDate' => $request->dueDate,
            'budget' => $request->budget,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        $employees = ProjectEmployee::where('project', $id)->get(['employee']);
        ProjectEmployee::where('project', $id)->delete();

        if ($project->manager != $request->manager) {
            Notification::create([
                'employee' => $request->manager,
                'body' => 'you are assigned to manage project #' . $id,
            ]);

            Notification::create([
                'employee' => $project->manager,
                'body' => 'you are no longer assigned to manage project #' . $id,
            ]);
        }


        if ($request->employees) {
            foreach ($employees as $employee) {
                if (!in_array($employee->employee, $request->employees))
                    Notification::create([
                        'employee' => (int) $employee->employee,
                        'body' => 'you are no longer assigned to join the team on project #' . $id,
                    ]);
            }

            foreach ($request->employees as $employee) {
                ProjectEmployee::create([
                    'project' => $id,
                    'employee' => (int) $employee,
                ]);

                if (!$employees->contains('employee', $employee)) {
                    Notification::create([
                        'employee' => (int) $employee,
                        'body' => 'you are assigned to join the team on project #' . $id,
                    ]);
                }
            }
        }

        return Redirect::route('views.projects.index')->with([
            'message' => 'Project successfully updated',
            'type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        Project::findorfail($id)->delete();
        ProjectEmployee::where('project', $id)->delete();

        return Redirect::route('views.projects.index')->with([
            'message' => 'Project successfully deleted',
            'type' => 'success'
        ]);
    }
}
