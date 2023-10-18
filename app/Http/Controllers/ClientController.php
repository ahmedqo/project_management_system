<?php

namespace App\Http\Controllers;

use App\Functions\DocumentFn;
use App\Models\AccountClient;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class ClientController extends Controller
{
    public function index()
    {
        $data = Client::orderBy('id', 'DESC')->get();
        return view('client.index', compact('data'));
    }

    public function summary($id)
    {
        $data = Client::findorfail($id);
        return view('client.summary', compact('data'));
    }

    public function contact($id)
    {
        $data = Contact::where('client', $id)->orderBy('id', 'DESC')->get();
        $client = Client::findorfail($id);
        return view('client.contact', compact('data', 'client'));
    }

    public function project($id)
    {
        $data = Project::where('client', $id)->orderBy('id', 'DESC')->get();
        $client = Client::findorfail($id);
        return view('client.project', compact('data', 'client'));
    }

    public function account($id)
    {
        $data = AccountClient::where('client', $id)->get();
        $client = Client::findorfail($id);
        return view('client.account', compact('data', 'client'));
    }

    public function document($id)
    {
        $data = DocumentFn::getClientDoc($id);
        $client = Client::findorfail($id);
        return view('client.document', compact('data', 'client'));
    }


    public function create()
    {
        return view('client.create');
    }

    public function edit($id)
    {
        $data = Client::findorfail($id);
        $docs = DocumentFn::getClientDoc($id);

        return view('client.edit', compact('data', 'docs'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:clients'],
            'type' => ['required', 'string'],
            'fixPhone' => ['required', 'string'],
            'address' => ['required', 'string'],
            'email' => ['required', 'email'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.clients.create")->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $client = Client::create([
            'name' => $request->name,
            'type' => $request->type,
            'fixPhone' => $request->fixPhone,
            'cellPhone' => $request->cellPhone,
            'faxPhone' => $request->faxPhone,
            'email' => $request->email,
            'address' => $request->address,
            'description' => $request->description,
        ]);

        if ($request->hasFile('document')) {
            $documents = $request->file('document');
            foreach ($documents as $document) {
                $doc  = DocumentFn::store($document, 'client');
                DB::table('client_document')->insert(['client' => $client->id, 'document' => $doc->id]);
            }
        }

        return Redirect::route('views.clients.index')->with([
            'message' => 'Client successfully created',
            'type' => 'success'
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:clients,name,' . $id],
            'type' => ['required', 'string'],
            'fixPhone' => ['required', 'string'],
            'address' => ['required', 'string'],
            'email' => ['required', 'email'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.clients.edit", $id)->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Client::findorfail($id)->update([
            'name' => $request->name,
            'type' => $request->type,
            'fixPhone' => $request->fixPhone,
            'cellPhone' => $request->cellPhone,
            'faxPhone' => $request->faxPhone,
            'email' => $request->email,
            'address' => $request->address,
            'description' => $request->description,
        ]);

        if ($request->hasFile('document')) {
            $documents = $request->file('document');
            foreach ($documents as $document) {
                $doc  = DocumentFn::store($document, 'client');
                DB::table('client_document')->insert(['client' => $id, 'document' => $doc->id]);
            }
        }

        return Redirect::route('views.clients.index')->with([
            'message' => 'Client successfully updated',
            'type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        $docs = DocumentFn::getClientDoc($id);
        foreach ($docs as $doc) {
            DocumentFn::destroy($doc->id);
        }
        Client::findorfail($id)->delete();

        return Redirect::route('views.clients.index')->with([
            'message' => 'Client successfully deleted',
            'type' => 'success'
        ]);
    }
}
