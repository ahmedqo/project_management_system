@extends('communs.base')
@section('title', 'Reviews List')

@section('content')
    <div class="w-full bg-white rounded-lg -mt-12 overflow-hidden">
        <div class="p-4 flex items-center justify-between gap-4">
            <h1 class="font-black text-gray-900 text-2xl">
                Reviews List
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

    <div class="w-full bg-white p-4 rounded-lg ">
        <table x-table x-hide="2" x-name="reviews">
            <thead>
                <tr>
                    <td>
                        date
                    </td>
                    <td>
                        note
                    </td>
                    <td>
                        <div class="min-w-max w-full h-full flex items-center justify-center">
                            actions
                        </div>
                    </td>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        <td>
                            {{ Carbon::parse($row->date)->diffForHumans() }}
                        </td>
                        <td>
                            {{ System::note($row) / 5 }} / 4
                        </td>
                        <td>
                            <div class="w-full h-full flex items-center justify-center gap-2">
                                <a href="{{ route('views.profile.reviews.summary', $row->id) }}"
                                    class="w-5 h-5 flex items-center justify-center rounded-full text-green-400 outline-none hover:text-green-300 focus:text-green-300">
                                    <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                        <path
                                            d="M9.6 42.95q-1.9 0-3.225-1.325Q5.05 40.3 5.05 38.4V9.6q0-1.9 1.325-3.225Q7.7 5.05 9.6 5.05h28.8q1.9 0 3.225 1.325Q42.95 7.7 42.95 9.6v28.8q0 1.9-1.325 3.225Q40.3 42.95 38.4 42.95Zm-.55-4h29.9V13H9.05v25.95ZM24 33.65q-4 0-7.125-2.15T12.35 26q1.4-3.4 4.525-5.55Q20 18.3 24 18.3t7.125 2.15Q34.25 22.6 35.65 26q-1.4 3.4-4.525 5.525Q28 33.65 24 33.65Zm0-2.35q2.9 0 5.325-1.425Q31.75 28.45 33.1 26q-1.35-2.45-3.775-3.9Q26.9 20.65 24 20.65q-2.9 0-5.325 1.45-2.425 1.45-3.725 3.9 1.3 2.45 3.725 3.875Q21.1 31.3 24 31.3Zm0-2.85q-1 0-1.725-.725Q21.55 27 21.55 26q0-1.05.725-1.75t1.725-.7q1.05 0 1.75.725t.7 1.725q0 1-.725 1.725Q25 28.45 24 28.45Z" />
                                    </svg>
                                </a>
                            </div>
                        </td>
                    <tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('print')
    <h1 class="text-gray-900 font-black text-2xl text-center mb-16">Reviews List</h1>
    <div class="rounded-md overflow-hidden  border border-gray-300">
        <table class="w-full text-md text-gray-900">
            <thead class="bg-primary text-xs font-black text-white uppercase">
                <tr class="uppercase">
                    <td class="px-4 py-2 border-r border-gray-300 text-center">date</td>
                    <td class="px-4 py-2 text-center">note</td>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $row)
                    <tr>
                        <td class="px-4 py-2 text-center border-r border-gray-300">
                            {{ Carbon::parse($row->date)->toDateString() }}
                        </td>
                        <td class="px-4 py-2 text-center">
                            {{ System::note($row) / 5 }} / 4
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-4 py-2 text-center uppercase">no records found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
