@extends('communs.base')
@section('title', 'Complaint #' . $data->id . ' Summary')

@section('content')
    <div class="w-full bg-white rounded-lg -mt-12 overflow-hidden">
        <div class="p-4 flex items-center justify-between gap-4">
            <h1 class="font-black text-gray-900 text-2xl">
                Complaint #{{ $data->id }} Summary
            </h1>
            <div class="w-max flex items-center gap-2">
                <button onclick="Print()"
                    class="w-[42px] h-[42px] flex items-center justify-center rounded-full text-white bg-green-400 outline-none hover:bg-green-300 focus:bg-green-300">
                    <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                        <path
                            d="M37.05 12.95H11v-5.7q0-.95.675-1.625T13.3 4.95h21.4q.95 0 1.65.675t.7 1.625Zm-.85 11.8q.9 0 1.475-.55.575-.55.575-1.45 0-.85-.55-1.45t-1.5-.6q-.9 0-1.45.6-.55.6-.55 1.45 0 .9.55 1.45.55.55 1.45.55Zm-20.65 14.6h16.9V32.4h-16.9v6.95Zm0 4.3q-1.85 0-3.2-1.325T11 39.1V34H5.3q-.95 0-1.625-.675T3 31.7V20.8q0-2.7 1.825-4.575T9.3 14.35h29.4q2.7 0 4.525 1.875Q45.05 18.1 45.05 20.8v10.9q0 .95-.7 1.625T42.7 34h-5.65v5.1q0 1.9-1.375 3.225Q34.3 43.65 32.45 43.65Z" />
                    </svg>
                </button>
                <a href="{{ route('views.complaints.edit', $data->id) }}"
                    class="w-[42px] h-[42px] flex items-center justify-center rounded-full text-white bg-yellow-400 outline-none hover:bg-yellow-300 focus:bg-yellow-300">
                    <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                        <path
                            d="M10 45.25q-3 0-5.125-2.125T2.75 38q0-2.35 1.35-4.275Q5.45 31.8 7.75 31.1V16.8q-2.3-.6-3.65-2.525Q2.75 12.35 2.75 10q0-3.05 2.125-5.175T10 2.7q2.35 0 4.275 1.375Q16.2 5.45 16.9 7.7h5.2l-1.7-1.8q-.7-.7-.7-1.625t.7-1.575q.6-.65 1.55-.625.95.025 1.65.625l5.7 5.65q.6.7.6 1.675 0 .975-.6 1.575l-5.7 5.6q-.4.35-.75.6t-.675.3q-.325.05-.825-.125-.5-.175-.95-.725-.7-.65-.675-1.625.025-.975.675-1.625l1.75-1.75H16.9q-.55 1.75-1.725 2.925Q14 16.35 12.3 16.8v14.3q2.25.75 3.625 2.65T17.3 38q0 3-2.125 5.125T10 45.25ZM38 2.7q3 0 5.15 2.125Q45.3 6.95 45.3 10q0 3-2.125 5.125T38 17.25q-3 0-5.125-2.125T30.75 10q0-3 2.125-5.15Q35 2.7 38 2.7Zm-6.25 22.1 4.7 4.6 4.65 4.55-9.8 9.9q-.7.7-1.55 1.05-.85.35-1.7.35h-5.1q-1 0-1.625-.65T20.7 43v-5.1q0-.9.3-1.75t.95-1.5Zm10.8 7.7-9.3-9.1 1.95-1.9q1.3-1.35 3.225-1.325 1.925.025 3.325 1.425l2.7 2.75q1.25 1.4 1.25 3.25t-1.35 3.2Z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <div class="w-full flex flex-col gap-4 p-4 bg-white rounded-lg">
        <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
            <div class="w-full">
                <label x-ucfirst class="block text-sm font-black text-gray-900 mb-1">First name</label>
                <div x-ucfirst
                    class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary">
                    {{ $data->employee()->first()->firstName }}</div>
            </div>
            <div class="w-full">
                <label x-ucfirst class="block text-sm font-black text-gray-900 mb-1">Last name</label>
                <div x-ucfirst
                    class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary">
                    {{ $data->employee()->first()->lastName }}</div>
            </div>
        </div>
        <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-3 gap-4">
            <div class="w-full">
                <label x-ucfirst class="block text-sm font-black text-gray-900 mb-1">Grievance</label>
                <div x-ucfirst
                    class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary">
                    {{ $data->grievance }}</div>
            </div>
            <div class="w-full">
                <label x-ucfirst class="block text-sm font-black text-gray-900 mb-1">Create date</label>
                <div
                    class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary">
                    {{ Carbon::parse($data->created_at)->diffForHumans() }}</div>
            </div>
            <div class="w-full">
                <label x-ucfirst class="block text-sm font-black text-gray-900 mb-1">Status</label>
                <div x-ucfirst
                    class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary">
                    {{ $data->status }}</div>
            </div>
        </div>
        <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-3 gap-4">
            <div class="w-full">
                <label x-ucfirst class="block text-sm font-black text-gray-900 mb-1">Incident location</label>
                <div x-ucfirst
                    class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary">
                    {{ $data->location }}</div>
            </div>
            <div class="w-full">
                <label x-ucfirst class="block text-sm font-black text-gray-900 mb-1">Incident time</label>
                <div
                    class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary">
                    {{ $data->time }}</div>
            </div>
            <div class="w-full">
                <label x-ucfirst class="block text-sm font-black text-gray-900 mb-1">Incident date</label>
                <div
                    class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary">
                    {{ Carbon::parse($data->date)->diffForHumans() }}</div>
            </div>
        </div>
        <div class="w-full">
            <label x-ucfirst class="block text-sm font-black text-gray-900 mb-1">Description</label>
            <div class="bg-gray-50 border border-gray-300 rounded-md block w-full p-2">
                @if (strlen($data->description))
                    <div class="w-full revert">
                        {!! $data->description !!}
                    </div>
                @else
                    <span class="text-gray-900 text-md block w-full px-2">
                        N/A
                    </span>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('print')
    <h1 class="text-gray-900 font-black text-2xl text-center mb-16">
        Complaint #{{ $data->id }} Summary
    </h1>
    <div class="w-full flex flex-col gap-4">
        <div class="grid grid-rows-1 grid-cols-2 gap-4">
            <div class="w-full">
                <label x-ucfirst class="block text-sm font-black text-gray-900 mb-1">First name</label>
                <div x-ucfirst
                    class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary">
                    {{ $data->employee()->first()->firstName }}</div>
            </div>
            <div class="w-full">
                <label x-ucfirst class="block text-sm font-black text-gray-900 mb-1">Last name</label>
                <div x-ucfirst
                    class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary">
                    {{ $data->employee()->first()->lastName }}</div>
            </div>
        </div>
        <div class="grid grid-rows-1 grid-cols-3 gap-4">
            <div class="w-full">
                <label x-ucfirst class="block text-sm font-black text-gray-900 mb-1">Grievance</label>
                <div x-ucfirst
                    class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary">
                    {{ $data->grievance }}</div>
            </div>
            <div class="w-full">
                <label x-ucfirst class="block text-sm font-black text-gray-900 mb-1">Create date</label>
                <div
                    class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary">
                    {{ Carbon::parse($data->created_at)->toDateString() }}</div>
            </div>
            <div class="w-full">
                <label x-ucfirst class="block text-sm font-black text-gray-900 mb-1">Status</label>
                <div x-ucfirst
                    class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary">
                    {{ $data->status }}</div>
            </div>
        </div>
        <div class="grid grid-rows-1 grid-cols-3 gap-4">
            <div class="w-full">
                <label x-ucfirst class="block text-sm font-black text-gray-900 mb-1">Incident location</label>
                <div x-ucfirst
                    class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary">
                    {{ $data->location }}</div>
            </div>
            <div class="w-full">
                <label x-ucfirst class="block text-sm font-black text-gray-900 mb-1">Incident time</label>
                <div
                    class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary">
                    {{ Carbon::parse($data->time)->toDateString() }}</div>
            </div>
            <div class="w-full">
                <label x-ucfirst class="block text-sm font-black text-gray-900 mb-1">Incident date</label>
                <div
                    class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary">
                    {{ Carbon::parse($data->date)->toDateString() }}</div>
            </div>
        </div>
        <div class="w-full">
            <label x-ucfirst class="block text-sm font-black text-gray-900 mb-1">Description</label>
            @if (strlen($data->description))
                <div class="w-full revert">
                    {!! $data->description !!}
                </div>
            @else
                <span class="text-gray-900 text-md block w-full px-2">
                    N/A
                </span>
            @endif
        </div>
    </div>
@endsection
