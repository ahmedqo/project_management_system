@extends('communs.base')
@section('title', 'Client #' . $client->id . ' Documents List')

@section('content')
    <div class="w-full bg-white rounded-lg -mt-12 overflow-hidden">
        <div class="p-4 flex items-center justify-between gap-4">
            <h1 class="font-black text-gray-900 text-2xl">
                Client #{{ $client->id }} Documents List
            </h1>
        </div>
        @include('client.navigation', ['id' => $client->id])
    </div>

    <div class="w-full bg-white p-4 rounded-lg">
        <div class="w-full grid grid-rows-1 grid-cols-1 gap-2">
            @forelse($data as $row)
                <a class="bg-gray-50 border relative pr-10 border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 truncate text-ellipsis overflow-hidden  hover:underline"
                    download="{{ $row->name }}" href="{{ $row->doc }}"
                    title="({{ $row->type }}) {{ $row->size }}kb">
                    {{ $row->name }}
                    <span class="flex w-5 h-5 items-center justify-center absolute right-2 top-1/2 -translate-y-1/2">
                        <svg class="block w-4 h-4 text-gray-900 pointer-events-none" fill="currentcolor"
                            viewBox="0 0 48 48">
                            <path
                                d="M23.95 30.35q-.45 0-.85-.2-.4-.2-.7-.5l-8-7.95q-.6-.65-.6-1.625t.7-1.675q.65-.6 1.575-.6.925 0 1.625.65l4 4.1V7q0-1 .675-1.675T24 4.65q1 0 1.625.675T26.25 7v15.55l4.1-4.1q.65-.65 1.6-.65.95 0 1.6.65.65.65.65 1.625t-.65 1.625l-7.95 7.95q-.3.3-.75.5t-.9.2ZM10.25 42.2q-1.8 0-3.175-1.35Q5.7 39.5 5.7 37.55V30.5q0-.95.675-1.625T8 28.2q1 0 1.625.675t.625 1.625v7.1H37.7v-7.1q0-.95.65-1.625t1.6-.675q1 0 1.65.675.65.675.65 1.625v7.1q0 1.9-1.4 3.25T37.7 42.2Z">
                            </path>
                        </svg>
                    </span>
                </a>
            @empty
                <p x-ucfirst class="lg:col-span-2 w-full text-gray-900 text-lg text-center uppercase">
                    no recoreds found
                </p>
            @endforelse
        </div>
    </div>
@endsection
