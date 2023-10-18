<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Employee;
use App\Models\Message;
use App\Models\Participant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class MessageController extends Controller
{
    public function index()
    {
        $conversations = Participant::with('conversation')->where('employee', Auth::user()->id)->orderBy('id', 'DESC')->get();
        foreach ($conversations as $conversation) {
            $messages = Message::where('conversation', $conversation->conversation)->where('employee', '!=', Auth::user()->id)->where('isRead', 0);
            $conversation['count'] = $messages->count();
            $conversation['message'] = Message::where('conversation', $conversation->conversation)->latest()->first();
            $conversation['conversation'] = Conversation::where('id', $conversation->conversation)->first();
            foreach ($messages->get() as $message) $message->update(['isRead' => 1]);
        }
        $conversations = $conversations->sortByDesc('count');
        $recipients = Employee::where('id', '!=', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('message.index', compact('conversations', 'recipients'));
    }

    public function single($id)
    {
        $data = Conversation::findorfail($id);
        $messages = Message::with('employee')->where('conversation', $id)->get();
        $recipient = $messages->where('employee', '!=', Auth::user()->id)->first();
        $recipient = $recipient ? $recipient->employee()->first() : $recipient;
        foreach ($messages as $message) $message->update(['isRead' => 1]);
        return view('message.single', compact('data', 'messages', 'recipient'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'recipient' => ['required', 'integer'],
            'subject' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.conversations.index")->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        $conversation = Conversation::create([
            'subject' => $request->subject,
        ]);

        foreach ([Auth::user()->id, $request->recipient] as $id) {
            Participant::create([
                'conversation' => $conversation->id,
                'employee' => $id,
            ]);
        }

        return Redirect::route("views.conversations.single", $conversation->id);
    }

    public function send(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'content' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return Redirect::route("views.conversations.single", $id)->with([
                'message' => $validator->errors()->all(),
                'type' => 'error'
            ]);
        }

        Message::create([
            'conversation' => $id,
            'employee' => Auth::user()->id,
            'content' => $request->content
        ]);

        return Response::json([
            'message' => 'Message successfully created',
            'type' => 'success'
        ]);
    }

    public function data($id)
    {
        $messages = Message::where('conversation', $id)->get();
        foreach ($messages as $message) {
            if ($message->employee != Auth::user()->id) $message->update(['isRead' => 1]);
            $message['date'] = Carbon::parse($message->created_at)->diffForHumans();
            $message['text'] = nl2br($message->content);
            $message['user'] = Employee::where('id', $message->employee)->first();
        }
        return Response::json($messages);
    }

    public function destroy($id)
    {
        Conversation::findorfail($id)->delete();

        return Redirect::route('views.conversations.index')->with([
            'message' => 'Conversation successfully deleted',
            'type' => 'success'
        ]);
    }
}
