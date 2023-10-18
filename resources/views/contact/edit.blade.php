@extends('communs.base')
@section('title', 'Edit Contact #' . $data->id)

@section('content')
    <div class="w-full bg-white rounded-lg -mt-12 overflow-hidden">
        <div class="p-4 flex items-center justify-between gap-4">
            <h1 class="font-black text-gray-900 text-2xl">
                Edit Contact #{{ $data->id }}
            </h1>
        </div>
    </div>

    <div class="grid grid-rows-1 grid-cols-1 gap-4">
        <div class="w-full bg-white p-4 rounded-lg ">
            <form action="{{ route('actions.contacts.update', $data->id) }}" method="POST" class="w-full flex flex-col gap-4">
                @csrf
                <div class="w-full">
                    <label x-ucfirst for="client" class="block text-sm font-black text-gray-900 mb-1">Client</label>
                    <div class="relative">
                        <select x-select id="client" placeholder="Client" name="client">
                            @foreach ($clients as $client)
                                <option x-ucfirst value="{{ $client->id }}"
                                    @if ($client->id == $data->client) selected @endif>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-3 gap-4">
                    <div class="w-full">
                        <label x-ucfirst for="title" class="block text-sm font-black text-gray-900 mb-1">Title</label>
                        <div class="relative">
                            <select x-select id="title" placeholder="Title" name="title">
                                <option x-ucfirst value="madame" @if ($data->title == 'madame') selected @endif>Madame
                                </option>
                                <option x-ucfirst value="mister" @if ($data->title == 'mister') selected @endif>Mister
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="w-full">
                        <label x-ucfirst for="firstName" class="block text-sm font-black text-gray-900 mb-1">First
                            name</label>
                        <div class="relative">
                            <input id="firstName" type="text" placeholder="First name" name="firstName"
                                value="{{ $data->firstName }}"
                                class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary" />
                        </div>
                    </div>
                    <div class="w-full">
                        <label x-ucfirst for="lastName" class="block text-sm font-black text-gray-900 mb-1">Last
                            name</label>
                        <div class="relative">
                            <input id="lastName" type="text" placeholder="Last name" name="lastName"
                                value="{{ $data->lastName }}"
                                class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary" />
                        </div>
                    </div>
                </div>
                <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-3 gap-4">
                    <div class="w-full">
                        <label x-ucfirst for="function" class="block text-sm font-black text-gray-900 mb-1">Function</label>
                        <input id="function" type="text" placeholder="Function" name="function"
                            value="{{ $data->function }}"
                            class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary" />
                    </div>
                    <div class="w-full">
                        <label x-ucfirst for="email" class="block text-sm font-black text-gray-900 mb-1">Email</label>
                        <div class="relative">
                            <input id="email" type="email" placeholder="Email" name="email"
                                value="{{ $data->email }}"
                                class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary" />
                        </div>
                    </div>
                    <div class="w-full">
                        <label x-ucfirst for="phone" class="block text-sm font-black text-gray-900 mb-1">Phone</label>
                        <div class="relative">
                            <input id="phone" type="tel" placeholder="Phone" name="phone"
                                value="{{ $data->phone }}"
                                class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary" />
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <button type="submit"
                        class="appearance-none lg:w-max ml-auto text-md flex items-center justify-center rounded-md font-semibold w-full p-2 px-4 text-white outline-none bg-primary hover:bg-light focus:bg-light">
                        <span x-ucfirst>Save</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
