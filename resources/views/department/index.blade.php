@extends('communs.base')
@section('title', 'Departments List')

@section('content')
    <div class="w-full bg-white rounded-lg -mt-12 overflow-hidden">
        <div class="p-4 flex items-center justify-between gap-4">
            <h1 class="font-black text-gray-900 text-2xl">
                Departments List
            </h1>
            <div class="w-max flex items-center gap-2">
                <button onclick="Print()"
                    class="w-[42px] h-[42px] flex items-center justify-center rounded-full text-white bg-green-400 outline-none hover:bg-green-300 focus:bg-green-300">
                    <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                        <path
                            d="M37.05 12.95H11v-5.7q0-.95.675-1.625T13.3 4.95h21.4q.95 0 1.65.675t.7 1.625Zm-.85 11.8q.9 0 1.475-.55.575-.55.575-1.45 0-.85-.55-1.45t-1.5-.6q-.9 0-1.45.6-.55.6-.55 1.45 0 .9.55 1.45.55.55 1.45.55Zm-20.65 14.6h16.9V32.4h-16.9v6.95Zm0 4.3q-1.85 0-3.2-1.325T11 39.1V34H5.3q-.95 0-1.625-.675T3 31.7V20.8q0-2.7 1.825-4.575T9.3 14.35h29.4q2.7 0 4.525 1.875Q45.05 18.1 45.05 20.8v10.9q0 .95-.7 1.625T42.7 34h-5.65v5.1q0 1.9-1.375 3.225Q34.3 43.65 32.45 43.65Z" />
                    </svg>
                </button>
                <a href="{{ route('views.departments.create') }}"
                    class="w-[42px] h-[42px] flex items-center justify-center rounded-full text-white bg-primary outline-none hover:bg-light focus:bg-light">
                    <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                        <path
                            d="M24 38.75q-.95 0-1.6-.625-.65-.625-.65-1.675V26.3H11.5q-.9 0-1.575-.675Q9.25 24.95 9.25 24q0-1 .675-1.625t1.575-.625h10.25V11.5q0-1 .675-1.625T24 9.25q.95 0 1.625.625T26.3 11.5v10.25h10.2q.95 0 1.625.625T38.8 24q0 1-.675 1.65-.675.65-1.625.65H26.3v10.15q0 1.05-.675 1.675T24 38.75Z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <div class="w-full bg-white p-4 rounded-lg ">
        <table x-table x-hide="3" x-name="departments">
            <thead>
                <tr>
                    <td>
                        name
                    </td>
                    <td>
                        loaction
                    </td>
                    <td>
                        create date
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
                        <td x-ucfirst>
                            {{ $row->name }}
                        </td>
                        <td x-ucfirst>
                            {{ $row->location }}
                        </td>
                        <td>
                            {{ Carbon::parse($row->created_at)->diffForHumans() }}
                        </td>
                        <td>
                            <div class="w-full h-full flex items-center justify-center gap-2">
                                <a href="{{ route('views.departments.edit', $row->id) }}"
                                    class="w-5 h-5 flex items-center justify-center rounded-full text-yellow-400 outline-none hover:text-yellow-300 focus:text-yellow-300">
                                    <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                        <path
                                            d="M10 45.25q-3 0-5.125-2.125T2.75 38q0-2.35 1.35-4.275Q5.45 31.8 7.75 31.1V16.8q-2.3-.6-3.65-2.525Q2.75 12.35 2.75 10q0-3.05 2.125-5.175T10 2.7q2.35 0 4.275 1.375Q16.2 5.45 16.9 7.7h5.2l-1.7-1.8q-.7-.7-.7-1.625t.7-1.575q.6-.65 1.55-.625.95.025 1.65.625l5.7 5.65q.6.7.6 1.675 0 .975-.6 1.575l-5.7 5.6q-.4.35-.75.6t-.675.3q-.325.05-.825-.125-.5-.175-.95-.725-.7-.65-.675-1.625.025-.975.675-1.625l1.75-1.75H16.9q-.55 1.75-1.725 2.925Q14 16.35 12.3 16.8v14.3q2.25.75 3.625 2.65T17.3 38q0 3-2.125 5.125T10 45.25ZM38 2.7q3 0 5.15 2.125Q45.3 6.95 45.3 10q0 3-2.125 5.125T38 17.25q-3 0-5.125-2.125T30.75 10q0-3 2.125-5.15Q35 2.7 38 2.7Zm-6.25 22.1 4.7 4.6 4.65 4.55-9.8 9.9q-.7.7-1.55 1.05-.85.35-1.7.35h-5.1q-1 0-1.625-.65T20.7 43v-5.1q0-.9.3-1.75t.95-1.5Zm10.8 7.7-9.3-9.1 1.95-1.9q1.3-1.35 3.225-1.325 1.925.025 3.325 1.425l2.7 2.75q1.25 1.4 1.25 3.25t-1.35 3.2Z" />
                                    </svg>
                                </a>
                                <a href="{{ route('actions.departments.destroy', $row->id) }}"
                                    class="w-5 h-5 flex items-center justify-center rounded-full text-red-400 outline-none hover:text-red-300 focus:text-red-300">
                                    <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                        <path
                                            d="M12.65 43.05q-1.8 0-3.2-1.35-1.4-1.35-1.4-3.2V10.9H7.5q-.95 0-1.575-.65T5.3 8.65q0-1 .625-1.65.625-.65 1.575-.65h9.1q0-1 .65-1.675T18.9 4h10.2q1 0 1.675.675t.675 1.675h9q1 0 1.65.675.65.675.65 1.575 0 1.05-.65 1.675t-1.65.625h-.55v27.6q0 1.85-1.35 3.2t-3.25 1.35Zm5.2-10.25q0 .7.55 1.25t1.25.55q.75 0 1.325-.55t.575-1.25V16.6q0-.75-.6-1.325t-1.3-.575q-.75 0-1.275.575-.525.575-.525 1.325Zm8.65 0q0 .7.575 1.25t1.275.55q.75 0 1.325-.55t.575-1.25V16.6q0-.75-.575-1.325T28.35 14.7q-.75 0-1.3.575T26.5 16.6Z" />
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('print')
    <h1 class="text-gray-900 font-black text-2xl text-center mb-16">Departments List</h1>
    <div class="rounded-md overflow-hidden  border border-gray-300">
        <table class="w-full text-md text-gray-900">
            <thead class="bg-primary text-xs font-black text-white uppercase">
                <tr class="uppercase">
                    <td class="px-4 py-2">name</td>
                    <td class="px-4 py-2">location</td>
                    <td class="px-4 py-2">create date</td>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $row)
                    <tr>
                        <td x-ucfirst class="px-4 py-2">
                            {{ $row->name }}
                        </td>
                        <td x-ucfirst class="px-4 py-2">
                            {{ $row->location }}
                        </td>
                        <td class="px-4 py-2">
                            {{ Carbon::parse($row->created_at)->toDateString() }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-2 text-center uppercase">no records found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
