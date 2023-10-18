<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller
{
    public function index()
    {
        $data = Contact::orderBy('id', 'DESC')->get();
        return view('contact.index', compact('data'));
    }

    public function create()
    {
        $clients = Client::orderBy('id', 'DESC')->get();
        return view('contact.create', compact('clients'));
    }

    public function edit($id)
    {
        $data = Contact::findorfail($id);
        $clients = Client::orderBy('id', 'DESC')->get();
        return view('contact.edit', compact('data', 'clients'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client' => ['required', 'integer'],
            'title' => ['required', 'string'],
            'firstName' => ['required', 'string'],
            'lastName' => ['required', 'string'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'string'],
            'function' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.contacts.create")->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Contact::create([
            'client' => $request->client,
            'title' => $request->title,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'phone' => $request->phone,
            'function' => $request->function,
        ]);

        return Redirect::route('views.contacts.index')->with([
            'message' => 'Contact successfully created',
            'type' => 'success'
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'client' => ['required', 'integer'],
            'title' => ['required', 'string'],
            'firstName' => ['required', 'string'],
            'lastName' => ['required', 'string'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'string'],
            'function' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.contacts.edit", $id)->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Contact::findorfail($id)->update([
            'client' => $request->client,
            'title' => $request->title,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'phone' => $request->phone,
            'function' => $request->function,
        ]);

        return Redirect::route('views.contacts.index')->with([
            'message' => 'Contact successfully updated',
            'type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        Contact::findorfail($id)->delete();

        return Redirect::route('views.contacts.index')->with([
            'message' => 'Contact successfully deleted',
            'type' => 'success'
        ]);
    }
}
