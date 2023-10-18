@extends('communs.base')
@section('title', 'Task #' . $data->id . ' Summary')

@section('content')
    <div class="w-full bg-white rounded-lg -mt-12 overflow-hidden">
        <div class="p-4 flex items-center justify-between gap-4">
            <h1 class="font-black text-gray-900 text-2xl">
                Task #{{ $data->id }} Summary
            </h1>
            <div class="w-max flex items-center gap-2">
                <button onclick="Print()"
                    class="w-[42px] h-[42px] flex items-center justify-center rounded-full text-white bg-green-400 outline-none hover:bg-green-300 focus:bg-green-300">
                    <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                        <path
                            d="M37.05 12.95H11v-5.7q0-.95.675-1.625T13.3 4.95h21.4q.95 0 1.65.675t.7 1.625Zm-.85 11.8q.9 0 1.475-.55.575-.55.575-1.45 0-.85-.55-1.45t-1.5-.6q-.9 0-1.45.6-.55.6-.55 1.45 0 .9.55 1.45.55.55 1.45.55Zm-20.65 14.6h16.9V32.4h-16.9v6.95Zm0 4.3q-1.85 0-3.2-1.325T11 39.1V34H5.3q-.95 0-1.625-.675T3 31.7V20.8q0-2.7 1.825-4.575T9.3 14.35h29.4q2.7 0 4.525 1.875Q45.05 18.1 45.05 20.8v10.9q0 .95-.7 1.625T42.7 34h-5.65v5.1q0 1.9-1.375 3.225Q34.3 43.65 32.45 43.65Z" />
                    </svg>
                </button>
                @if ($data->project()->first()->manager == Auth::user()->id)
                    <a href="{{ route('actions.tasks.destroy', $data->id) }}"
                        class="w-[42px] h-[42px] flex items-center justify-center rounded-full text-white bg-red-400 outline-none hover:bg-red-300 focus:bg-red-300">
                        <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                            <path
                                d="M12.65 43.05q-1.8 0-3.2-1.35-1.4-1.35-1.4-3.2V10.9H7.5q-.95 0-1.575-.65T5.3 8.65q0-1 .625-1.65.625-.65 1.575-.65h9.1q0-1 .65-1.675T18.9 4h10.2q1 0 1.675.675t.675 1.675h9q1 0 1.65.675.65.675.65 1.575 0 1.05-.65 1.675t-1.65.625h-.55v27.6q0 1.85-1.35 3.2t-3.25 1.35Zm5.2-10.25q0 .7.55 1.25t1.25.55q.75 0 1.325-.55t.575-1.25V16.6q0-.75-.6-1.325t-1.3-.575q-.75 0-1.275.575-.525.575-.525 1.325Zm8.65 0q0 .7.575 1.25t1.275.55q.75 0 1.325-.55t.575-1.25V16.6q0-.75-.575-1.325T28.35 14.7q-.75 0-1.3.575T26.5 16.6Z" />
                        </svg>
                    </a>
                    <a href="{{ route('views.profile.tasks.edit', $data->id) }}"
                        class="w-[42px] h-[42px] flex items-center justify-center rounded-full text-white bg-yellow-400 outline-none hover:bg-yellow-300 focus:bg-yellow-300">
                        <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                            <path
                                d="M10 45.25q-3 0-5.125-2.125T2.75 38q0-2.35 1.35-4.275Q5.45 31.8 7.75 31.1V16.8q-2.3-.6-3.65-2.525Q2.75 12.35 2.75 10q0-3.05 2.125-5.175T10 2.7q2.35 0 4.275 1.375Q16.2 5.45 16.9 7.7h5.2l-1.7-1.8q-.7-.7-.7-1.625t.7-1.575q.6-.65 1.55-.625.95.025 1.65.625l5.7 5.65q.6.7.6 1.675 0 .975-.6 1.575l-5.7 5.6q-.4.35-.75.6t-.675.3q-.325.05-.825-.125-.5-.175-.95-.725-.7-.65-.675-1.625.025-.975.675-1.625l1.75-1.75H16.9q-.55 1.75-1.725 2.925Q14 16.35 12.3 16.8v14.3q2.25.75 3.625 2.65T17.3 38q0 3-2.125 5.125T10 45.25ZM38 2.7q3 0 5.15 2.125Q45.3 6.95 45.3 10q0 3-2.125 5.125T38 17.25q-3 0-5.125-2.125T30.75 10q0-3 2.125-5.15Q35 2.7 38 2.7Zm-6.25 22.1 4.7 4.6 4.65 4.55-9.8 9.9q-.7.7-1.55 1.05-.85.35-1.7.35h-5.1q-1 0-1.625-.65T20.7 43v-5.1q0-.9.3-1.75t.95-1.5Zm10.8 7.7-9.3-9.1 1.95-1.9q1.3-1.35 3.225-1.325 1.925.025 3.325 1.425l2.7 2.75q1.25 1.4 1.25 3.25t-1.35 3.2Z" />
                        </svg>
                    </a>
                @endif
            </div>
        </div>
        @include('profile.task.navigation', ['id' => $data->id])
    </div>

    <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-3 items-start gap-4">
        <div class="w-full lg:col-span-2 bg-white rounded-lg ">
            <div class="w-full flex flex-col">
                <div class="w-full p-4 flex gap-4 flex-wrap">
                    <h2 x-ucfirst class="flex-1 font-black text-2xl text-gray-900">
                        {{ $data->name }}
                    </h2>
                </div>
                <span class="w-full border-t border-gray-300"></span>
                <div class="w-full flex flex-wrap justify-between gap-4 p-4">
                    <div class="w-max">
                        <label x-ucfirst class="block text-sm font-black text-gray-900 mb-1">Create date</label>
                        <span class="text-gray-900 text-md block w-full px-2">
                            {{ Carbon::parse($data->created_at)->diffForHumans() }}
                        </span>
                    </div>
                    <div class="w-max">
                        <label x-ucfirst class="block text-sm font-black text-gray-900 mb-1">Update date</label>
                        <span class="text-gray-900 text-md block w-full px-2">
                            {{ Carbon::parse($data->updated_at)->diffForHumans() }}
                        </span>
                    </div>
                    <div class="w-max">
                        <label x-ucfirst class="block text-sm font-black text-gray-900 mb-1">Due date</label>
                        <span class="text-gray-900 text-md block w-full px-2">
                            {{ Carbon::parse($data->dueDate)->diffForHumans() }}
                        </span>
                    </div>
                </div>
                <span class="w-full border-t border-gray-300"></span>
                <div class="w-full flex flex-col p-4">
                    @if (strlen($data->description))
                        <div class="w-full revert">
                            {!! $data->description !!}
                        </div>
                    @else
                        <label x-ucfirst class="block text-sm font-black text-gray-900 mb-1">Description</label>
                        <span class="text-gray-900 text-md block w-full px-2">
                            N/A
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="sticky top-4 w-full flex flex-col gap-4">
            <div class="w-full flex items-start gap-4 overflow-hidden p-4 bg-white rounded-lg">
                <div class="flex-1 flex flex-col">
                    <h2 x-ucfirst class="font-semibold text-xl text-gray-900">Priority</h2>
                    <span x-ucfirst class="text-gray-900 text-md px-2">
                        {{ $data->priority }}
                    </span>
                </div>
                <svg class="block w-[52px] h-[52px] text-yellow-300 pointer-events-none" fill="currentcolor"
                    viewBox="0 0 48 48">
                    <path
                        d="M17 31.25h-6.35q-1.45 0-2.075-1.2-.625-1.2.175-2.4L27.35.9q.4-.65 1.175-.875Q29.3-.2 30.05.05q.8.2 1.2.95.4.75.35 1.5l-2 16.15h8.05q1.45 0 2.025 1.325T39.4 22.4L19.1 46.8q-.5.6-1.275.825-.775.225-1.475-.175-.65-.3-1.05-.925T15 44.95Z" />
                </svg>
            </div>
            <div class="w-full flex items-start gap-4 overflow-hidden p-4 bg-white rounded-lg">
                <div class="flex-1 flex flex-col">
                    <h2 x-ucfirst class="font-semibold text-xl text-gray-900">Status</h2>
                    <span x-ucfirst class="text-gray-900 text-md px-2">{{ $data->status }}</span>
                </div>
                <svg class="block w-[52px] h-[52px] text-pink-300 pointer-events-none" fill="currentcolor"
                    viewBox="0 0 48 48">
                    <path
                        d="M44.4 19.1q.3 1.2.5 2.425.2 1.225.2 2.475 0 4.4-1.625 8.3Q41.85 36.2 39 39.025q-2.85 2.825-6.7 4.425-3.85 1.6-8.3 1.6-4.4 0-8.3-1.6-3.9-1.6-6.725-4.425Q6.15 36.2 4.55 32.3q-1.6-3.9-1.6-8.3 0-4.45 1.6-8.3 1.6-3.85 4.425-6.7Q11.8 6.15 15.7 4.525 19.6 2.9 24 2.9q2.8 0 5.375.8t4.875 2q.85.35 1.1 1.35.25 1-.25 1.85-.5.7-1.375.95T32.1 9.8q-1.75-1.1-3.8-1.7-2.05-.6-4.3-.6-7 0-11.75 4.725T7.5 24q0 7.05 4.75 11.775Q17 40.5 24 40.5q7.15 0 11.8-4.775T40.45 23.9q0-.9-.125-1.775Q40.2 21.25 40 20.5q-.1-1.25.4-1.975.5-.725 1.25-1.025.75-.2 1.65.225.9.425 1.1 1.375Zm-25 13-5.6-5.65q-.65-.55-.65-1.475t.7-1.625q.65-.6 1.575-.6.925 0 1.625.6l3.9 4L40.35 7.9q.65-.6 1.575-.625.925-.025 1.625.625.65.75.65 1.65 0 .9-.65 1.6l-21 20.95q-.65.7-1.625.7t-1.525-.7Z" />
                </svg>
            </div>
            <div class="w-full flex items-start gap-4 overflow-hidden p-4 bg-white rounded-lg">
                <div class="flex-1 flex flex-col">
                    <h2 x-ucfirst class="font-semibold text-xl text-gray-900">Project</h2>
                    <a x-ucfirst href="{{ route('views.projects.summary', $data->project()->first()->id) }}"
                        class="text-gray-900 text-md px-2 hover:underline">
                        {{ $data->project()->first()->name }}
                    </a>
                </div>
                <svg class="block w-[52px] h-[52px] text-purple-300 pointer-events-none" fill="currentcolor"
                    viewBox="0 0 48 48">
                    <path
                        d="M23.95 21.45q-3.45 0-5.975-2.5-2.525-2.5-2.525-6t2.5-6.075Q20.45 4.3 24 4.3q3.5 0 6.075 2.575T32.65 13q0 3.45-2.575 5.95t-6.125 2.5Zm-11.5 21.6q-3.5 0-6.025-2.5Q3.9 38.05 3.9 34.5q0-3.5 2.525-6.075T12.5 25.85q3.5 0 6.05 2.575t2.55 6.125q0 3.45-2.525 5.975-2.525 2.525-6.125 2.525Zm23.05 0q-3.5 0-6.025-2.5-2.525-2.5-2.525-6.05 0-3.5 2.5-6.075t6.1-2.575q3.5 0 6.05 2.575t2.55 6.125q0 3.45-2.55 5.975-2.55 2.525-6.1 2.525Z" />
                </svg>
            </div>
            <div class="w-full flex items-start gap-4 overflow-hidden p-4 bg-white rounded-lg">
                <div class="flex-1 flex flex-col">
                    <h2 x-ucfirst class="font-semibold text-xl text-gray-900">Employees</h2>
                    <ul class="w-full">
                        @foreach ($employees as $employee)
                            <li class="text-gray-900 text-md px-2 flex flex-wrap items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-gray-500"></span>
                                <p x-ucfirst>
                                    {{ $employee->employee()->first()->firstName }}
                                    {{ $employee->employee()->first()->lastName }}
                                </p>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <svg class="block w-[52px] h-[52px] text-teal-300 pointer-events-none" fill="currentcolor"
                    viewBox="0 0 48 48">
                    <path
                        d="M3.4 41.5q-1 0-1.65-.625-.65-.625-.65-1.625V35.7q0-2.1 1.05-3.775 1.05-1.675 3-2.525 3.75-1.6 6.775-2.35 3.025-.75 6.225-.75 3.3 0 6.3.75t6.75 2.35q1.95.8 3.025 2.475T35.3 35.7v3.6q0 .95-.625 1.575T33 41.5Zm33.95 0q.55-.25 1.025-.875.475-.625.475-1.475V35.8q0-3.25-1.625-5.4-1.625-2.15-4.275-4 3 .5 5.65 1.225 2.65.725 4.45 1.575 1.75.95 2.825 2.675Q46.95 33.6 46.95 35.95v3.35q0 .95-.65 1.575t-1.65.625ZM18.2 23.3q-3.6 0-5.775-2.175-2.175-2.175-2.175-5.775 0-3.55 2.175-5.75T18.2 7.4q3.5 0 5.75 2.2t2.25 5.75q0 3.6-2.25 5.775Q21.7 23.3 18.2 23.3Zm19.3-7.95q0 3.55-2.225 5.75t-5.725 2.2q-.65 0-1.175-.075T27.15 22.9q1.3-1.35 1.925-3.25t.625-4.3q0-2.35-.625-4.175Q28.45 9.35 27.15 7.8q.55-.2 1.175-.3.625-.1 1.225-.1 3.5 0 5.725 2.225Q37.5 11.85 37.5 15.35Z" />
                </svg>
            </div>
        </div>
    </div>
@endsection

@section('print')
    <h1 class="text-gray-900 font-black text-2xl text-center mb-16">
        Task #{{ $data->id }} Summary
    </h1>
    <div class="grid grid-rows-1 grid-cols-2 items-start gap-4">
        <div class="w-full flex items-start gap-4 overflow-hidden p-4 border border-gray-300 rounded-lg">
            <div class="flex-1 flex flex-col">
                <h2 x-ucfirst class="font-semibold text-md text-gray-900">Project</h2>
                <a x-ucfirst href="{{ route('views.projects.summary', $data->project()->first()->id) }}"
                    class="text-gray-900 text-md px-2 hover:underline">
                    {{ $data->project()->first()->name }}
                </a>
            </div>
            <svg class="block w-[52px] h-[52px] text-purple-300 pointer-events-none" fill="currentcolor"
                viewBox="0 0 48 48">
                <path
                    d="M23.95 21.45q-3.45 0-5.975-2.5-2.525-2.5-2.525-6t2.5-6.075Q20.45 4.3 24 4.3q3.5 0 6.075 2.575T32.65 13q0 3.45-2.575 5.95t-6.125 2.5Zm-11.5 21.6q-3.5 0-6.025-2.5Q3.9 38.05 3.9 34.5q0-3.5 2.525-6.075T12.5 25.85q3.5 0 6.05 2.575t2.55 6.125q0 3.45-2.525 5.975-2.525 2.525-6.125 2.525Zm23.05 0q-3.5 0-6.025-2.5-2.525-2.5-2.525-6.05 0-3.5 2.5-6.075t6.1-2.575q3.5 0 6.05 2.575t2.55 6.125q0 3.45-2.55 5.975-2.55 2.525-6.1 2.525Z" />
            </svg>
        </div>
        <div class="w-full flex items-start gap-4 overflow-hidden p-4 border border-gray-300 rounded-lg">
            <div class="flex-1 flex flex-col">
                <h2 x-ucfirst class="font-semibold text-md text-gray-900">Priority</h2>
                <span x-ucfirst class="text-gray-900 text-md px-2">
                    {{ $data->priority }}
                </span>
            </div>
            <svg class="block w-[52px] h-[52px] text-yellow-300 pointer-events-none" fill="currentcolor"
                viewBox="0 0 48 48">
                <path
                    d="M17 31.25h-6.35q-1.45 0-2.075-1.2-.625-1.2.175-2.4L27.35.9q.4-.65 1.175-.875Q29.3-.2 30.05.05q.8.2 1.2.95.4.75.35 1.5l-2 16.15h8.05q1.45 0 2.025 1.325T39.4 22.4L19.1 46.8q-.5.6-1.275.825-.775.225-1.475-.175-.65-.3-1.05-.925T15 44.95Z" />
            </svg>
        </div>
        <div class="w-full flex items-start gap-4 overflow-hidden p-4 border border-gray-300 rounded-lg">
            <div class="flex-1 flex flex-col">
                <h2 x-ucfirst class="font-semibold text-md text-gray-900">Status</h2>
                <span x-ucfirst class="text-gray-900 text-md px-2">{{ $data->status }}</span>
            </div>
            <svg class="block w-[52px] h-[52px] text-pink-300 pointer-events-none" fill="currentcolor"
                viewBox="0 0 48 48">
                <path
                    d="M44.4 19.1q.3 1.2.5 2.425.2 1.225.2 2.475 0 4.4-1.625 8.3Q41.85 36.2 39 39.025q-2.85 2.825-6.7 4.425-3.85 1.6-8.3 1.6-4.4 0-8.3-1.6-3.9-1.6-6.725-4.425Q6.15 36.2 4.55 32.3q-1.6-3.9-1.6-8.3 0-4.45 1.6-8.3 1.6-3.85 4.425-6.7Q11.8 6.15 15.7 4.525 19.6 2.9 24 2.9q2.8 0 5.375.8t4.875 2q.85.35 1.1 1.35.25 1-.25 1.85-.5.7-1.375.95T32.1 9.8q-1.75-1.1-3.8-1.7-2.05-.6-4.3-.6-7 0-11.75 4.725T7.5 24q0 7.05 4.75 11.775Q17 40.5 24 40.5q7.15 0 11.8-4.775T40.45 23.9q0-.9-.125-1.775Q40.2 21.25 40 20.5q-.1-1.25.4-1.975.5-.725 1.25-1.025.75-.2 1.65.225.9.425 1.1 1.375Zm-25 13-5.6-5.65q-.65-.55-.65-1.475t.7-1.625q.65-.6 1.575-.6.925 0 1.625.6l3.9 4L40.35 7.9q.65-.6 1.575-.625.925-.025 1.625.625.65.75.65 1.65 0 .9-.65 1.6l-21 20.95q-.65.7-1.625.7t-1.525-.7Z" />
            </svg>
        </div>
        <div class="w-full flex items-start gap-4 overflow-hidden p-4 border border-gray-300 rounded-lg">
            <div class="flex-1 flex flex-col">
                <h2 x-ucfirst class="font-semibold text-md text-gray-900">Employees</h2>
                <ul class="w-full">
                    @foreach ($employees as $employee)
                        <li class="text-gray-900 text-md px-2 flex flex-wrap items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-gray-500"></span>
                            <p x-ucfirst>
                                {{ $employee->employee()->first()->firstName }}
                                {{ $employee->employee()->first()->lastName }}
                            </p>
                        </li>
                    @endforeach
                </ul>
            </div>
            <svg class="block w-[52px] h-[52px] text-teal-300 pointer-events-none" fill="currentcolor"
                viewBox="0 0 48 dth="48">
                <path
                    d="M3.4 41.5q-1 0-1.65-.625-.65-.625-.65-1.625V35.7q0-2.1 1.05-3.775 1.05-1.675 3-2.525 3.75-1.6 6.775-2.35 3.025-.75 6.225-.75 3.3 0 6.3.75t6.75 2.35q1.95.8 3.025 2.475T35.3 35.7v3.6q0 .95-.625 1.575T33 41.5Zm33.95 0q.55-.25 1.025-.875.475-.625.475-1.475V35.8q0-3.25-1.625-5.4-1.625-2.15-4.275-4 3 .5 5.65 1.225 2.65.725 4.45 1.575 1.75.95 2.825 2.675Q46.95 33.6 46.95 35.95v3.35q0 .95-.65 1.575t-1.65.625ZM18.2 23.3q-3.6 0-5.775-2.175-2.175-2.175-2.175-5.775 0-3.55 2.175-5.75T18.2 7.4q3.5 0 5.75 2.2t2.25 5.75q0 3.6-2.25 5.775Q21.7 23.3 18.2 23.3Zm19.3-7.95q0 3.55-2.225 5.75t-5.725 2.2q-.65 0-1.175-.075T27.15 22.9q1.3-1.35 1.925-3.25t.625-4.3q0-2.35-.625-4.175Q28.45 9.35 27.15 7.8q.55-.2 1.175-.3.625-.1 1.225-.1 3.5 0 5.725 2.225Q37.5 11.85 37.5 15.35Z" />
        </div>
        <div class="w-full col-span-2">
            <div class="w-full flex flex-col">
                <div class="w-full p-4 flex gap-4 flex-wrap">
                    <h2 x-ucfirst class="flex-1 font-black text-2xl text-gray-900">
                        {{ $data->name }}
                    </h2>
                </div>
                <span class="w-full border-t border-gray-300"></span>
                <div class="w-full flex flex-wrap justify-between gap-4 p-4">
                    <div class="w-max">
                        <label x-ucfirst class="block text-sm font-black text-gray-900 mb-1">Create date</label>
                        <span class="text-gray-900 text-md block w-full px-2">
                            {{ Carbon::parse($data->created_at)->diffForHumans() }}
                        </span>
                    </div>
                    <div class="w-max">
                        <label x-ucfirst class="block text-sm font-black text-gray-900 mb-1">Update date</label>
                        <span class="text-gray-900 text-md block w-full px-2">
                            {{ Carbon::parse($data->updated_at)->diffForHumans() }}
                        </span>
                    </div>
                    <div class="w-max">
                        <label x-ucfirst class="block text-sm font-black text-gray-900 mb-1">Due date</label>
                        <span class="text-gray-900 text-md block w-full px-2">
                            {{ Carbon::parse($data->dueDate)->diffForHumans() }}
                        </span>
                    </div>
                </div>
                <span class="w-full border-t border-gray-300"></span>
                <div class="w-full flex flex-col p-4">
                    @if (strlen($data->description))
                        <div class="w-full revert">
                            {!! $data->description !!}
                        </div>
                    @else
                        <label x-ucfirst class="block text-sm font-black text-gray-900 mb-1">Description</label>
                        <span class="text-gray-900 text-md block w-full px-2">
                            N/A
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
