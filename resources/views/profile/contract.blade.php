@extends('communs.base')
@section('title', 'Contracts List')

@section('content')
    <div class="w-full bg-white rounded-lg -mt-12 overflow-hidden">
        <div class="p-4 flex items-center justify-between gap-4">
            <h1 class="font-black text-gray-900 text-2xl">
                Contracts List
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
        <table x-table x-name="contracts">
            <thead>
                <tr>
                    <td>
                        Type
                    </td>
                    <td>
                        Salary
                    </td>
                    <td>
                        Compensation
                    </td>
                    <td>
                        probation
                    </td>
                    <td>
                        Start date
                    </td>
                    <td>
                        End date
                    </td>
                </tr>
            </thead>
            <tbody>
                @foreach ($contracts as $row)
                    <tr>
                        <td x-ucfirst>
                            {{ $row->type }}
                        </td>
                        <td>
                            {{ $row->salary }} DH
                        </td>
                        <td x-ucfirst>
                            {{ $row->compensation }}
                        </td>
                        <td>
                            {{ $row->probation }} days
                        </td>
                        <td>
                            {{ Carbon::parse($row->startDate)->diffForHumans() }}
                        </td>
                        <td>
                            {{ Carbon::parse($row->endDate)->diffForHumans() }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('print')
    <h1 class="text-gray-900 font-black text-2xl text-center mb-16">Contracts List</h1>
    <div class="rounded-md overflow-hidden  border border-gray-300">
        <table class="w-full text-md text-gray-900">
            <thead class="bg-primary text-xs font-black text-white uppercase">
                <tr class="uppercase">
                    <td class="px-4 py-2">type</td>
                    <td class="px-4 py-2">salary</td>
                    <td class="px-4 py-2">compensation</td>
                    <td class="px-4 py-2">probation</td>
                    <td class="px-4 py-2">start date</td>
                    <td class="px-4 py-2">end date</td>
                </tr>
            </thead>
            <tbody>
                @forelse($contracts as $row)
                    <tr>
                        <td x-ucfirst class="px-4 py-2">
                            {{ $row->type }}
                        </td>
                        <td class="px-4 py-2">
                            {{ $row->salary }} DH
                        </td>
                        <td x-ucfirst class="px-4 py-2">
                            {{ $row->compensation }}
                        </td>
                        <td class="px-4 py-2">
                            {{ $row->probation }} days
                        </td>
                        <td class="px-4 py-2">
                            {{ $row->startDate }}
                        </td>
                        <td class="px-4 py-2">
                            {{ $row->endDate }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-2 text-center uppercase">no records found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
