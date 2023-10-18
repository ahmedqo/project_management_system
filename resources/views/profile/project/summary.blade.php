@extends('communs.base')
@section('title', 'Project #' . $data->id . ' Summary')

@section('content')
    <div class="w-full bg-white rounded-lg -mt-12 overflow-hidden">
        <div class="p-4 flex items-center justify-between gap-4">
            <h1 class="font-black text-gray-900 text-2xl">
                Project #{{ $data->id }} Summary
            </h1>
            <div class="w-max flex items-center gap-2">
                <button onclick="Print()"
                    class="w-[42px] h-[42px] flex items-center justify-center rounded-full text-white bg-green-400 outline-none hover:bg-green-300 focus:bg-green-300">
                    <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                        <path
                            d="M37.05 12.95H11v-5.7q0-.95.675-1.625T13.3 4.95h21.4q.95 0 1.65.675t.7 1.625Zm-.85 11.8q.9 0 1.475-.55.575-.55.575-1.45 0-.85-.55-1.45t-1.5-.6q-.9 0-1.45.6-.55.6-.55 1.45 0 .9.55 1.45.55.55 1.45.55Zm-20.65 14.6h16.9V32.4h-16.9v6.95Zm0 4.3q-1.85 0-3.2-1.325T11 39.1V34H5.3q-.95 0-1.625-.675T3 31.7V20.8q0-2.7 1.825-4.575T9.3 14.35h29.4q2.7 0 4.525 1.875Q45.05 18.1 45.05 20.8v10.9q0 .95-.7 1.625T42.7 34h-5.65v5.1q0 1.9-1.375 3.225Q34.3 43.65 32.45 43.65Z" />
                    </svg>
                </button>
                @if ($data->manager == Auth::user()->id)
                    <div class="w-max relative">
                        <button x-toggle="#status" x-property="pointer-events-none, opacity-0"
                            class="w-[42px] h-[42px] flex items-center justify-center rounded-full text-white bg-yellow-400 outline-none hover:bg-yellow-300 focus:bg-yellow-300">
                            <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                <path
                                    d="M10 45.25q-3 0-5.125-2.125T2.75 38q0-2.35 1.35-4.275Q5.45 31.8 7.75 31.1V16.8q-2.3-.6-3.65-2.525Q2.75 12.35 2.75 10q0-3.05 2.125-5.175T10 2.7q2.35 0 4.275 1.375Q16.2 5.45 16.9 7.7h5.2l-1.7-1.8q-.7-.7-.7-1.625t.7-1.575q.6-.65 1.55-.625.95.025 1.65.625l5.7 5.65q.6.7.6 1.675 0 .975-.6 1.575l-5.7 5.6q-.4.35-.75.6t-.675.3q-.325.05-.825-.125-.5-.175-.95-.725-.7-.65-.675-1.625.025-.975.675-1.625l1.75-1.75H16.9q-.55 1.75-1.725 2.925Q14 16.35 12.3 16.8v14.3q2.25.75 3.625 2.65T17.3 38q0 3-2.125 5.125T10 45.25ZM38 2.7q3 0 5.15 2.125Q45.3 6.95 45.3 10q0 3-2.125 5.125T38 17.25q-3 0-5.125-2.125T30.75 10q0-3 2.125-5.15Q35 2.7 38 2.7Zm-6.25 22.1 4.7 4.6 4.65 4.55-9.8 9.9q-.7.7-1.55 1.05-.85.35-1.7.35h-5.1q-1 0-1.625-.65T20.7 43v-5.1q0-.9.3-1.75t.95-1.5Zm10.8 7.7-9.3-9.1 1.95-1.9q1.3-1.35 3.225-1.325 1.925.025 3.325 1.425l2.7 2.75q1.25 1.4 1.25 3.25t-1.35 3.2Z" />
                            </svg>
                        </button>
                        <ul id="status"
                            class="w-[160px] flex flex-col bg-white rounded-lg overflow-hidden absolute right-0 top-full mt-2 transition-all duration-200 opacity-0 pointer-events-none z-20 border border-gray-200">
                            <li class="w-full">
                                <a href="{{ route('actions.profile.projects.status', ['id' => $data->id, 'status' => 'pending']) }}"
                                    class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-900 hover:bg-gray-900 hover:bg-opacity-10 focus:bg-gray-900 focus:bg-opacity-10 {{ System::activeLink('views.profile.summary') }}">
                                    <svg class="block w-4 h-4 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                        <path
                                            d="M24 23.35q-3.85 0-6.225-2.4-2.375-2.4-2.375-6.2 0-3.8 2.375-6.2Q20.15 6.15 24 6.15q3.8 0 6.225 2.375t2.425 6.225q0 3.8-2.4 6.2-2.4 2.4-6.25 2.4ZM11.45 41.5q-1.9 0-3.225-1.325Q6.9 38.85 6.9 36.95V35.7q0-2.15 1.125-3.8T11 29.4q3.4-1.6 6.6-2.35 3.2-.75 6.4-.75 3.25 0 6.4.8 3.15.8 6.55 2.3 1.9.75 3.05 2.425 1.15 1.675 1.15 3.875v1.25q0 1.9-1.35 3.225-1.35 1.325-3.25 1.325Z" />
                                    </svg>
                                    <span class="text-sm font-medium">Pending</span>
                                </a>
                            </li>
                            <li class="w-full">
                                <a href="{{ route('actions.profile.projects.status', ['id' => $data->id, 'status' => 'ready']) }}"
                                    class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-900 hover:bg-gray-900 hover:bg-opacity-10 focus:bg-gray-900 focus:bg-opacity-10 {{ System::activeLink('views.profile.summary') }}">
                                    <svg class="block w-4 h-4 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                        <path
                                            d="M24 23.35q-3.85 0-6.225-2.4-2.375-2.4-2.375-6.2 0-3.8 2.375-6.2Q20.15 6.15 24 6.15q3.8 0 6.225 2.375t2.425 6.225q0 3.8-2.4 6.2-2.4 2.4-6.25 2.4ZM11.45 41.5q-1.9 0-3.225-1.325Q6.9 38.85 6.9 36.95V35.7q0-2.15 1.125-3.8T11 29.4q3.4-1.6 6.6-2.35 3.2-.75 6.4-.75 3.25 0 6.4.8 3.15.8 6.55 2.3 1.9.75 3.05 2.425 1.15 1.675 1.15 3.875v1.25q0 1.9-1.35 3.225-1.35 1.325-3.25 1.325Z" />
                                    </svg>
                                    <span class="text-sm font-medium">Ready</span>
                                </a>
                            </li>
                            <li class="w-full">
                                <a href="{{ route('actions.profile.projects.status', ['id' => $data->id, 'status' => 'progress']) }}"
                                    class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-900 hover:bg-gray-900 hover:bg-opacity-10 focus:bg-gray-900 focus:bg-opacity-10 {{ System::activeLink('views.profile.summary') }}">
                                    <svg class="block w-4 h-4 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                        <path
                                            d="M24 23.35q-3.85 0-6.225-2.4-2.375-2.4-2.375-6.2 0-3.8 2.375-6.2Q20.15 6.15 24 6.15q3.8 0 6.225 2.375t2.425 6.225q0 3.8-2.4 6.2-2.4 2.4-6.25 2.4ZM11.45 41.5q-1.9 0-3.225-1.325Q6.9 38.85 6.9 36.95V35.7q0-2.15 1.125-3.8T11 29.4q3.4-1.6 6.6-2.35 3.2-.75 6.4-.75 3.25 0 6.4.8 3.15.8 6.55 2.3 1.9.75 3.05 2.425 1.15 1.675 1.15 3.875v1.25q0 1.9-1.35 3.225-1.35 1.325-3.25 1.325Z" />
                                    </svg>
                                    <span class="text-sm font-medium">Progress</span>
                                </a>
                            </li>
                            <li class="w-full">
                                <a href="{{ route('actions.profile.projects.status', ['id' => $data->id, 'status' => 'colosed']) }}"
                                    class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-900 hover:bg-gray-900 hover:bg-opacity-10 focus:bg-gray-900 focus:bg-opacity-10 {{ System::activeLink('views.profile.summary') }}">
                                    <svg class="block w-4 h-4 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                        <path
                                            d="M24 23.35q-3.85 0-6.225-2.4-2.375-2.4-2.375-6.2 0-3.8 2.375-6.2Q20.15 6.15 24 6.15q3.8 0 6.225 2.375t2.425 6.225q0 3.8-2.4 6.2-2.4 2.4-6.25 2.4ZM11.45 41.5q-1.9 0-3.225-1.325Q6.9 38.85 6.9 36.95V35.7q0-2.15 1.125-3.8T11 29.4q3.4-1.6 6.6-2.35 3.2-.75 6.4-.75 3.25 0 6.4.8 3.15.8 6.55 2.3 1.9.75 3.05 2.425 1.15 1.675 1.15 3.875v1.25q0 1.9-1.35 3.225-1.35 1.325-3.25 1.325Z" />
                                    </svg>
                                    <span class="text-sm font-medium">Colosed</span>
                                </a>
                            </li>
                            <li class="w-full">
                                <a href="{{ route('actions.profile.projects.status', ['id' => $data->id, 'status' => 'dold']) }}"
                                    class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-900 hover:bg-gray-900 hover:bg-opacity-10 focus:bg-gray-900 focus:bg-opacity-10 {{ System::activeLink('views.profile.summary') }}">
                                    <svg class="block w-4 h-4 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                        <path
                                            d="M24 23.35q-3.85 0-6.225-2.4-2.375-2.4-2.375-6.2 0-3.8 2.375-6.2Q20.15 6.15 24 6.15q3.8 0 6.225 2.375t2.425 6.225q0 3.8-2.4 6.2-2.4 2.4-6.25 2.4ZM11.45 41.5q-1.9 0-3.225-1.325Q6.9 38.85 6.9 36.95V35.7q0-2.15 1.125-3.8T11 29.4q3.4-1.6 6.6-2.35 3.2-.75 6.4-.75 3.25 0 6.4.8 3.15.8 6.55 2.3 1.9.75 3.05 2.425 1.15 1.675 1.15 3.875v1.25q0 1.9-1.35 3.225-1.35 1.325-3.25 1.325Z" />
                                    </svg>
                                    <span class="text-sm font-medium">Hold</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        @include('profile.project.navigation', ['id' => $data->id])
    </div>

    <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-3 items-start gap-4">
        <div class="w-full lg:col-span-2 bg-white rounded-lg">
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
                    <h2 x-ucfirst class="font-semibold text-xl text-gray-900">Progress</h2>
                    <span id="display" class="text-gray-900 text-md px-2"></span>
                </div>
                <div id="pie" class="block w-[52px] h-[52px]"></div>
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
                    <h2 x-ucfirst class="font-semibold text-xl text-gray-900">Client</h2>
                    <span x-ucfirst class="text-gray-900 text-md px-2">
                        {{ $data->client()->first()->name }}
                    </span>
                </div>
                <svg class="block w-[52px] h-[52px] text-orange-300 pointer-events-none" fill="currentcolor"
                    viewBox="0 0 48 48">
                    <path
                        d="m18.95 37.9-5.3-11.55-11.6-5.3 11.6-5.25 5.3-11.55 5.2 11.55 11.65 5.25-11.65 5.3Zm18.6 5.8-2.6-5.8-5.85-2.6 5.85-2.65 2.6-5.8 2.6 5.8L46 35.3l-5.85 2.6Z" />
                </svg>
            </div>
            <div class="w-full flex items-start gap-4 overflow-hidden p-4 bg-white rounded-lg">
                <div class="flex-1 flex flex-col">
                    <h2 x-ucfirst class="font-semibold text-xl text-gray-900">Budget</h2>
                    <span class="text-gray-900 text-md px-2">
                        {{ $data->budget }} DH
                    </span>
                </div>
                <svg class="block w-[52px] h-[52px] text-green-300 pointer-events-none" fill="currentcolor"
                    viewBox="0 0 48 48">
                    <path
                        d="M24.15 42.45q-.75 0-1.225-.45-.475-.45-.475-1.25v-2.6q-2.6-.4-4.325-1.775T15.4 32.95q-.4-.65.025-1.45.425-.8 1.225-1.2.65-.15 1.375.075.725.225 1.275 1.025.85 1.55 2.2 2.25t2.95.7q2.25 0 3.625-1.05t1.375-2.8q0-2-1.4-3.175-1.4-1.175-5.25-2.375-3.45-1-5.25-3.05-1.8-2.05-1.8-5.05 0-2.6 1.625-4.575T22.45 9.8V7.2q0-.75.475-1.2.475-.45 1.225-.45.7 0 1.2.45t.5 1.2v2.6q1.7.35 3.25 1.175 1.55.825 2.55 2.275.4.65.125 1.425T30.65 15.8q-.6.25-1.35.025-.75-.225-1.45-.875T26.2 13.9q-.95-.4-2.1-.4-2.15 0-3.25.85t-1.1 2.4q0 1.55 1.225 2.675Q22.2 20.55 26.4 21.8q3.5 1.2 5.225 3.225Q33.35 27.05 33.45 30.3q0 3.25-1.925 5.3t-5.675 2.6v2.55q0 .8-.5 1.25-.5.45-1.2.45Z">
                    </path>
                </svg>
            </div>
            <div class="w-full flex items-start gap-4 overflow-hidden p-4 bg-white rounded-lg">
                <div class="flex-1 flex flex-col">
                    <h2 x-ucfirst class="font-semibold text-xl text-gray-900">Manager</h2>
                    <span x-ucfirst class="text-gray-900 text-md px-2">
                        {{ $data->manager()->first()->firstName }}
                        {{ $data->manager()->first()->lastName }}
                    </span>
                </div>
                <svg class="block w-[52px] h-[52px] text-indigo-300 pointer-events-none" fill="currentcolor"
                    viewBox="0 0 48 48">
                    <path
                        d="M20 27.4q-2.75 0-4.7-1.95-1.95-1.95-1.95-4.75 0-1.05.35-2.075.35-1.025 1-1.875-.2-.4-.275-.95-.075-.55-.075-1.1 0-1.95 1.075-3.625T18.3 8.65q1.05-1.2 2.5-1.9t3.2-.7q1.75 0 3.2.7 1.45.7 2.55 1.9 1.75.75 2.85 2.425 1.1 1.675 1.1 3.625 0 .55-.1 1.1t-.25.95q.65.85 1 1.875t.35 2.075q0 2.8-1.975 4.75Q30.75 27.4 28 27.4Zm-8.55 18.1q-1.9 0-3.225-1.325Q6.9 42.85 6.9 40.95V39.7q0-2.15 1.125-3.825Q9.15 34.2 11 33.4q3.4-1.6 6.6-2.35 3.2-.75 6.4-.75 3.25 0 6.4.8 3.15.8 6.55 2.3 1.9.75 3.05 2.425 1.15 1.675 1.15 3.875v1.25q0 1.9-1.35 3.225-1.35 1.325-3.25 1.325Z" />
                </svg>
            </div>
            <div class="w-full flex items-start gap-4 overflow-hidden p-4 bg-white rounded-lg">
                <div class="flex-1 flex flex-col">
                    <h2 x-ucfirst class="font-semibold text-xl text-gray-900">Team</h2>
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
        Project #{{ $data->id }} Summary
    </h1>
    <div class="grid grid-rows-1 grid-cols-2 items-start gap-4">
        <div class="w-full flex items-start gap-4 overflow-hidden p-4 border border-gray-300 rounded-lg">
            <div class="flex-1 flex flex-col">
                <h2 x-ucfirst class="font-semibold text-xl text-gray-900">Progress</h2>
                <span class="text-gray-900 text-md px-2">[text-in-percent]</span>
            </div>
            <div class="block w-[52px] h-[52px]">[pie-in-chart]</div>
        </div>
        <div class="w-full flex items-start gap-4 overflow-hidden p-4 border border-gray-300 rounded-lg">
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
        <div class="w-full flex items-start gap-4 overflow-hidden p-4 border border-gray-300 rounded-lg">
            <div class="flex-1 flex flex-col">
                <h2 x-ucfirst class="font-semibold text-xl text-gray-900">Client</h2>
                <span x-ucfirst class="text-gray-900 text-md px-2">
                    {{ $data->client()->first()->name }}
                </span>
            </div>
            <svg class="block w-[52px] h-[52px] text-orange-300 pointer-events-none" fill="currentcolor"
                viewBox="0 0 48 48">
                <path
                    d="m18.95 37.9-5.3-11.55-11.6-5.3 11.6-5.25 5.3-11.55 5.2 11.55 11.65 5.25-11.65 5.3Zm18.6 5.8-2.6-5.8-5.85-2.6 5.85-2.65 2.6-5.8 2.6 5.8L46 35.3l-5.85 2.6Z" />
            </svg>
        </div>
        <div class="w-full flex items-start gap-4 overflow-hidden p-4 border border-gray-300 rounded-lg">
            <div class="flex-1 flex flex-col">
                <h2 x-ucfirst class="font-semibold text-xl text-gray-900">Budget</h2>
                <span class="text-gray-900 text-md px-2">
                    {{ $data->budget }} DH
                </span>
            </div>
            <svg class="block w-[52px] h-[52px] text-green-300 pointer-events-none" fill="currentcolor"
                viewBox="0 0 48 48">
                <path
                    d="M24.15 42.45q-.75 0-1.225-.45-.475-.45-.475-1.25v-2.6q-2.6-.4-4.325-1.775T15.4 32.95q-.4-.65.025-1.45.425-.8 1.225-1.2.65-.15 1.375.075.725.225 1.275 1.025.85 1.55 2.2 2.25t2.95.7q2.25 0 3.625-1.05t1.375-2.8q0-2-1.4-3.175-1.4-1.175-5.25-2.375-3.45-1-5.25-3.05-1.8-2.05-1.8-5.05 0-2.6 1.625-4.575T22.45 9.8V7.2q0-.75.475-1.2.475-.45 1.225-.45.7 0 1.2.45t.5 1.2v2.6q1.7.35 3.25 1.175 1.55.825 2.55 2.275.4.65.125 1.425T30.65 15.8q-.6.25-1.35.025-.75-.225-1.45-.875T26.2 13.9q-.95-.4-2.1-.4-2.15 0-3.25.85t-1.1 2.4q0 1.55 1.225 2.675Q22.2 20.55 26.4 21.8q3.5 1.2 5.225 3.225Q33.35 27.05 33.45 30.3q0 3.25-1.925 5.3t-5.675 2.6v2.55q0 .8-.5 1.25-.5.45-1.2.45Z">
                </path>
            </svg>
        </div>
        <div class="w-full flex items-start gap-4 overflow-hidden p-4 border border-gray-300 rounded-lg">
            <div class="flex-1 flex flex-col">
                <h2 x-ucfirst class="font-semibold text-xl text-gray-900">Manager</h2>
                <span x-ucfirst class="text-gray-900 text-md px-2">
                    {{ $data->manager()->first()->firstName }}
                    {{ $data->manager()->first()->lastName }}
                </span>
            </div>
            <svg class="block w-[52px] h-[52px] text-indigo-300 pointer-events-none" fill="currentcolor"
                viewBox="0 0 48 48">
                <path
                    d="M20 27.4q-2.75 0-4.7-1.95-1.95-1.95-1.95-4.75 0-1.05.35-2.075.35-1.025 1-1.875-.2-.4-.275-.95-.075-.55-.075-1.1 0-1.95 1.075-3.625T18.3 8.65q1.05-1.2 2.5-1.9t3.2-.7q1.75 0 3.2.7 1.45.7 2.55 1.9 1.75.75 2.85 2.425 1.1 1.675 1.1 3.625 0 .55-.1 1.1t-.25.95q.65.85 1 1.875t.35 2.075q0 2.8-1.975 4.75Q30.75 27.4 28 27.4Zm-8.55 18.1q-1.9 0-3.225-1.325Q6.9 42.85 6.9 40.95V39.7q0-2.15 1.125-3.825Q9.15 34.2 11 33.4q3.4-1.6 6.6-2.35 3.2-.75 6.4-.75 3.25 0 6.4.8 3.15.8 6.55 2.3 1.9.75 3.05 2.425 1.15 1.675 1.15 3.875v1.25q0 1.9-1.35 3.225-1.35 1.325-3.25 1.325Z" />
            </svg>
        </div>
        <div class="w-full flex items-start gap-4 overflow-hidden p-4 border border-gray-300 rounded-lg">
            <div class="flex-1 flex flex-col">
                <h2 x-ucfirst class="font-semibold text-xl text-gray-900">Team</h2>
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
        <div class="w-full col-span-2">
            <div class="w-full flex flex-col">
                <div class="w-full p-4 flex gap-4 flex-wrap">
                    <h2 x-ucfirst class="flex-1 font-black text-2xl text-gray-900">
                        {{ $data->name }}
                    </h2>
                </div>
                <div class="w-full flex flex-wrap justify-between gap-4 p-4 border border-gray-300 rounded-lg">
                    <div class="w-max">
                        <label x-ucfirst class="block text-sm font-black text-gray-900 mb-1">Create date</label>
                        <span class="text-gray-900 text-md block w-full px-2">
                            {{ Carbon::parse($data->created_at)->toDateString() }}
                        </span>
                    </div>
                    <div class="w-max">
                        <label x-ucfirst class="block text-sm font-black text-gray-900 mb-1">Update date</label>
                        <span class="text-gray-900 text-md block w-full px-2">
                            {{ Carbon::parse($data->updated_at)->toDateString() }}
                        </span>
                    </div>
                    <div class="w-max">
                        <label x-ucfirst class="block text-sm font-black text-gray-900 mb-1">Due date</label>
                        <span class="text-gray-900 text-md block w-full px-2">
                            {{ Carbon::parse($data->dueDate)->toDateString() }}
                        </span>
                    </div>
                </div>
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

@section('script')
    <script>
        Program.pie(pie, {
            values: {!! json_encode($progress) !!},
            colors: [theme.primary, "#f3f4f6"],
            callback: ($) => {
                display.innerHTML = $.percentageString(Object.values($.values)[0]);
                setTimeout(() => {
                    html = html.replace('[text-in-percent]', $.percentageString(Object.values($.values)[
                        0]));
                    html = html.replace('[pie-in-chart]', $.svg.outerHTML);
                }, 500);
            },
        });
    </script>
@endsection
