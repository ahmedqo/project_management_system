@extends('communs.base')
@section('title', 'New Project')

@section('content')
    <div class="w-full bg-white rounded-lg -mt-12 overflow-hidden">
        <div class="p-4 flex items-center justify-between gap-4">
            <h1 class="font-black text-gray-900 text-2xl">
                New Project
            </h1>
        </div>
    </div>

    <div class="grid grid-rows-1 grid-cols-1 gap-4">
        <div class="w-full bg-white p-4 rounded-lg ">
            <form action="{{ route('actions.projects.store') }}" method="POST" class="w-full flex flex-col gap-4">
                @csrf
                <div class="w-full">
                    <label x-ucfirst for="name" class="block text-sm font-black text-gray-900 mb-1">Name</label>
                    <div class="relative">
                        <input id="name" type="text" placeholder="Name" name="name"
                            class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary" />
                    </div>
                </div>
                <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                    <div class="w-full">
                        <label x-ucfirst for="client" class="block text-sm font-black text-gray-900 mb-1">Client</label>
                        <div class="relative">
                            <select x-select id="client" placeholder="Client" name="client">
                                @foreach ($clients as $client)
                                    <option x-ucfirst value="{{ $client->id }}">
                                        {{ $client->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="w-full">
                        <label x-ucfirst for="dueDate" class="block text-sm font-black text-gray-900 mb-1">Due date</label>
                        <div class="relative">
                            <input x-date id="dueDate" type="text" placeholder="Due date" name="dueDate"
                                class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary" />
                        </div>
                    </div>
                </div>
                <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                    <div class="w-full">
                        <label x-ucfirst for="manager" class="block text-sm font-black text-gray-900 mb-1">Manager</label>
                        <div class="relative">
                            <select x-select id="manager" placeholder="Manager" name="manager">
                                @foreach ($employees as $employee)
                                    <option x-ucfirst value="{{ $employee->id }}">
                                        {{ $employee->firstName }} {{ $employee->lastName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="w-full">
                        <label x-ucfirst for="employees"
                            class="block text-sm font-black text-gray-900 mb-1">Employees</label>
                        <div class="relative">
                            <select x-select multiple id="employees" placeholder="Employees" name="employees[]">
                                @foreach ($employees as $employee)
                                    <option x-ucfirst value="{{ $employee->id }}">
                                        {{ $employee->firstName }} {{ $employee->lastName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                    <div class="w-full">
                        <label x-ucfirst for="budget" class="block text-sm font-black text-gray-900 mb-1">Budget</label>
                        <div class="relative">
                            <input id="budget" type="number" placeholder="Budget" name="budget"
                                class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary" />
                        </div>
                    </div>
                    <div class="w-full lg:flex-1">
                        <label x-ucfirst for="status" class="block text-sm font-black text-gray-900 mb-1">Status</label>
                        <div class="relative">
                            <select x-select id="status" placeholder="Status" name="status">
                                @foreach (System::stages('progress') as $status)
                                    <option x-ucfirst value="{{ $status }}">{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <label x-ucfirst for="document" class="block text-sm font-black text-gray-900 mb-1">Documents</label>
                    <div class="bg-gray-50 border border-gray-300 text-gray-900 rounded-md overflow-hidden">
                        <div class="relative w-full">
                            <input id="document" type="file"
                                class="opacity-0 block absolute top-0 left-0 w-full h-full cursor-pointer" name="document"
                                onchange="upload(this)" multiple />
                            <input readonly id="text-display" type="text" placeholder="Documents"
                                class="appearance-none bg-transparent text-gray-900 text-md rounded-md block w-full pr-10 p-2 focus:outline-1 outline-primary" />
                            <span
                                class="flex w-6 h-6 items-center justify-center absolute right-2 top-1/2 -translate-y-1/2">
                                <svg class="block w-4 h-4 text-gray-900 pointer-events-none" fill="currentcolor"
                                    viewBox="0 0 48 48">
                                    <path
                                        d="M24 31.25q-1 0-1.65-.675Q21.7 29.9 21.7 29V13.45l-4.1 4.1q-.65.6-1.575.625-.925.025-1.525-.675-.7-.65-.7-1.6 0-.95.7-1.7l7.9-7.9q.3-.25.725-.45t.875-.2q.45 0 .875.2t.725.45l7.95 8q.7.65.675 1.6-.025.95-.675 1.6-.6.65-1.55.625-.95-.025-1.65-.675l-4.1-4V29q0 .9-.625 1.575Q25 31.25 24 31.25ZM10.25 42.2q-1.8 0-3.175-1.35Q5.7 39.5 5.7 37.55V30.5q0-.95.675-1.625T8 28.2q1 0 1.625.675t.625 1.625v7.1H37.7v-7.1q0-.95.65-1.625t1.6-.675q1 0 1.65.675.65.675.65 1.625v7.1q0 1.9-1.4 3.25T37.7 42.2Z" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex flex-col"></div>
                    </div>
                </div>
                <div class="w-full">
                    <label x-ucfirst for="description"
                        class="block text-sm font-black text-gray-900 mb-1">Description</label>
                    <div class="relative">
                        <textarea x-rich id="description"" placeholder="Description" name="description"
                            class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary"></textarea>
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

@section('script')
    <script>
        if (queries().client) {
            const client = document.querySelector("#client");
            Array.from(client.options).forEach((option, i) => {
                if (option.value === queries().client) option.setAttribute('selected', '');
            });
        }

        if (queries().employee) {
            const employee = document.querySelector("#employees");
            const manager = document.querySelector("#manager");
            Array.from(employee.options).forEach((option, i) => {
                if (option.value === queries().employee) option.setAttribute('selected', '');
            });
            Array.from(manager.options).forEach((option, i) => {
                if (option.value === queries().employee) option.setAttribute('selected', '');
            });
        }
    </script>
@endsection
