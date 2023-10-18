@extends('communs.base')
@section('title', 'Accounts List')

@section('content')
    <div class="w-full bg-white rounded-lg -mt-12 overflow-hidden">
        <div class="p-4 flex items-center justify-between gap-4">
            <h1 class="font-black text-gray-900 text-2xl">
                Accounts List
            </h1>
            <button onclick="Print()"
                class="w-[42px] h-[42px] flex items-center justify-center rounded-full text-white bg-green-400 outline-none hover:bg-green-300 focus:bg-green-300">
                <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                    <path
                        d="M37.05 12.95H11v-5.7q0-.95.675-1.625T13.3 4.95h21.4q.95 0 1.65.675t.7 1.625Zm-.85 11.8q.9 0 1.475-.55.575-.55.575-1.45 0-.85-.55-1.45t-1.5-.6q-.9 0-1.45.6-.55.6-.55 1.45 0 .9.55 1.45.55.55 1.45.55Zm-20.65 14.6h16.9V32.4h-16.9v6.95Zm0 4.3q-1.85 0-3.2-1.325T11 39.1V34H5.3q-.95 0-1.625-.675T3 31.7V20.8q0-2.7 1.825-4.575T9.3 14.35h29.4q2.7 0 4.525 1.875Q45.05 18.1 45.05 20.8v10.9q0 .95-.7 1.625T42.7 34h-5.65v5.1q0 1.9-1.375 3.225Q34.3 43.65 32.45 43.65Z" />
                </svg>
            </button>
        </div>
        @include('profile.navigation')
    </div>

    <div class="flex flex-col gap-4 bg-white rounded-lg p-4">
        <table x-table x-name="accounts">
            <thead>
                <tr>
                    <td>
                        Bank
                    </td>
                    <td>
                        Rib
                    </td>
                    <td>
                        Create date
                    </td>
                </tr>
            </thead>
            <tbody>
                @foreach ($accounts as $row)
                    <tr>
                        <td x-ucfirst>
                            {{ $row->account()->first()->bank }}
                        </td>
                        <td>
                            {{ $row->account()->first()->rib }}
                        </td>
                        <td>
                            {{ Carbon::parse($row->account()->first()->created_at)->diffForHumans() }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('print')
    <h1 class="text-gray-900 font-black text-2xl text-center mb-16">Accounts List</h1>
    <div class="rounded-md overflow-hidden  border border-gray-300">
        <table class="w-full text-md text-gray-900">
            <thead class="bg-primary text-xs font-black text-white uppercase">
                <tr class="uppercase">
                    <td class="px-4 py-2">bank</td>
                    <td class="px-4 py-2">rib</td>
                    <td class="px-4 py-2">create date</td>
                    <td class="px-4 py-2">update date</td>
                </tr>
            </thead>
            <tbody>
                @forelse($accounts as $row)
                    <tr>
                        <td x-ucfirst class="px-4 py-2">
                            {{ $row->account()->first()->bank }}
                        </td>
                        <td class="px-4 py-2">
                            {{ $row->account()->first()->rib }}
                        </td>
                        <td class="px-4 py-2">
                            {{ Carbon::parse($row->account()->first()->created_at)->toDateString() }}
                        </td>
                        <td class="px-4 py-2">
                            {{ Carbon::parse($row->account()->first()->updated_at)->toDateString() }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-2 text-center uppercase">no records found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
