<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class ReviewController extends Controller
{
    public function summary($id)
    {
        $data = Review::findorfail($id);
        return view('review.summary', compact('data'));
    }

    public function index()
    {
        $data = Review::with('employee')->orderBy('id', 'DESC')->get();
        return view('review.index', compact('data'));
    }

    public function create()
    {
        $employees = Employee::orderBy('id', 'DESC')->get();
        return view('review.create', compact('employees'));
    }

    public function edit($id)
    {
        $data = Review::findorfail($id);
        $employees = Employee::orderBy('id', 'DESC')->get();
        return view('review.edit', compact('data', 'employees'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee' => ['required', 'integer'],
            'date' => ['required', 'date'],
            'work' => ['required', 'string'],
            'productivity' => ['required', 'string'],
            'communication' => ['required', 'string'],
            'collaboration' => ['required', 'string'],
            'punctuality' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.reviews.create")->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Review::create([
            'employee' => $request->employee,
            'date' => $request->date,
            'work' => $request->work,
            'productivity' => $request->productivity,
            'communication' => $request->communication,
            'collaboration' => $request->collaboration,
            'punctuality' => $request->punctuality,
            'description' => $request->description,
        ]);

        return Redirect::route('views.reviews.index')->with([
            'message' => 'Review successfully created',
            'type' => 'success'
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'employee' => ['required', 'integer'],
            'date' => ['required', 'date'],
            'work' => ['required', 'string'],
            'productivity' => ['required', 'string'],
            'communication' => ['required', 'string'],
            'collaboration' => ['required', 'string'],
            'punctuality' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.reviews.edit", $id)->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Review::findorfail($id)->update([
            'employee' => $request->employee,
            'date' => $request->date,
            'work' => $request->work,
            'productivity' => $request->productivity,
            'communication' => $request->communication,
            'collaboration' => $request->collaboration,
            'punctuality' => $request->punctuality,
            'description' => $request->description,
        ]);

        return Redirect::route('views.reviews.index')->with([
            'message' => 'Review successfully created',
            'type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        Review::findorfail($id)->delete();

        return Redirect::route('views.reviews.index')->with([
            'message' => 'Review successfully deleted',
            'type' => 'success'
        ]);
    }
}
