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
            </div>
        </div>
        @include('profile.navigation')
    </div>

    <div class="w-full flex flex-col gap-4 p-4 bg-white rounded-lg">
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
                <label x-ucfirst class="block text-sm font-black text-gray-900 mb-1">Incident Location</label>
                <div x-ucfirst
                    class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary">
                    {{ $data->location }}</div>
            </div>
            <div class="w-full">
                <label x-ucfirst class="block text-sm font-black text-gray-900 mb-1">Incident time</label>
                <div
                    class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary">
                    {{ Carbon::parse($data->time)->diffForHumans() }}</div>
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
    <h1 class="text-gray-900 font-black text-2xl text-center mb-16">Complaint #{{ $data->id }} Summary</h1>
    <div class="w-full flex flex-col gap-4">
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
