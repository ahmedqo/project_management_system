@extends('communs.base')
@section('title', 'Tasks List')

@section('content')
    <div class="w-full bg-white rounded-lg -mt-12 overflow-hidden">
        <div class="p-4 flex items-center justify-between gap-4">
            <h1 class="font-black text-gray-900 text-2xl">
                Tasks List
            </h1>
            <div class="w-max flex items-center gap-2">
                <button onclick="Print()"
                    class="w-[42px] h-[42px] flex items-center justify-center rounded-full text-white bg-green-400 outline-none hover:bg-green-300 focus:bg-green-300">
                    <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                        <path
                            d="M37.05 12.95H11v-5.7q0-.95.675-1.625T13.3 4.95h21.4q.95 0 1.65.675t.7 1.625Zm-.85 11.8q.9 0 1.475-.55.575-.55.575-1.45 0-.85-.55-1.45t-1.5-.6q-.9 0-1.45.6-.55.6-.55 1.45 0 .9.55 1.45.55.55 1.45.55Zm-20.65 14.6h16.9V32.4h-16.9v6.95Zm0 4.3q-1.85 0-3.2-1.325T11 39.1V34H5.3q-.95 0-1.625-.675T3 31.7V20.8q0-2.7 1.825-4.575T9.3 14.35h29.4q2.7 0 4.525 1.875Q45.05 18.1 45.05 20.8v10.9q0 .95-.7 1.625T42.7 34h-5.65v5.1q0 1.9-1.375 3.225Q34.3 43.65 32.45 43.65Z" />
                    </svg>
                </button>
                <a href="{{ route('views.tasks.create') }}"
                    class="w-[42px] h-[42px] flex items-center justify-center rounded-full text-white bg-primary outline-none hover:bg-light focus:bg-light">
                    <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                        <path
                            d="M24 38.75q-.95 0-1.6-.625-.65-.625-.65-1.675V26.3H11.5q-.9 0-1.575-.675Q9.25 24.95 9.25 24q0-1 .675-1.625t1.575-.625h10.25V11.5q0-1 .675-1.625T24 9.25q.95 0 1.625.625T26.3 11.5v10.25h10.2q.95 0 1.625.625T38.8 24q0 1-.675 1.65-.675.65-1.625.65H26.3v10.15q0 1.05-.675 1.675T24 38.75Z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <div class="w-full overflow-auto">
        <div class="w-full grid grid-cols-1 grid-rows-1 lg:grid-cols-5 items-start gap-4">
            <div class="w-full">
                <h2 x-ucfirst class="text-gray-900 font-black text-md text-center mb-2">
                    Pending
                </h2>
                <ul x-wrap="pending" class="bg-white p-2 rounded-lg w-full min-h-[50px] flex flex-col gap-2">
                    @foreach ($pending as $row)
                        <li x-item="{{ $row->id }}" draggable="true"
                            class="w-full flex flex-col gap-1 {{ System::priorityColor($row->priority) }} p-2 rounded-md overflow-auto">
                            <a href="{{ route('views.tasks.summary', $row->id) }}"
                                class="block w-max text-gray-900 font-bold text-sm hover:underline">
                                #{{ $row->id }} {{ $row->name }}
                            </a>
                            <div class="flex flex-col">
                                <div class="w-full flex items-center gap-2">
                                    <label class="block text-xs font-semibold text-gray-900">Duration:</label>
                                    <span class="text-gray-900 text-xs block">
                                        {{ $row->duration < 1 ? $row->duration * 60 : $row->duration }}
                                        {{ $row->duration < 1 ? 'minutes' : 'hours' }}
                                    </span>
                                </div>
                                <div class="w-full flex items-center gap-2">
                                    <label class="block text-xs font-semibold text-gray-900">Due date:</label>
                                    <span class="text-gray-900 text-xs block">
                                        {{ $row->dueDate }}
                                    </span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="w-full">
                <h2 x-ucfirst class="text-gray-900 font-black text-md text-center mb-2">
                    Ready
                </h2>
                <ul x-wrap="ready" class="bg-white p-2 rounded-lg w-full min-h-[50px] flex flex-col gap-2">
                    @foreach ($ready as $row)
                        <li x-item="{{ $row->id }}" draggable="true"
                            class="w-full flex flex-col gap-1 {{ System::priorityColor($row->priority) }} p-2 rounded-md overflow-auto">
                            <a href="{{ route('views.tasks.summary', $row->id) }}"
                                class="block w-max text-gray-900 font-bold text-sm hover:underline">
                                #{{ $row->id }} {{ $row->name }}
                            </a>
                            <div class="flex flex-col">
                                <div class="w-full flex items-center gap-2">
                                    <label class="block text-xs font-semibold text-gray-900">Duration:</label>
                                    <span class="text-gray-900 text-xs block">
                                        {{ $row->duration < 1 ? $row->duration * 60 : $row->duration }}
                                        {{ $row->duration < 1 ? 'minutes' : 'hours' }}
                                    </span>
                                </div>
                                <div class="w-full flex items-center gap-2">
                                    <label class="block text-xs font-semibold text-gray-900">Due date:</label>
                                    <span class="text-gray-900 text-xs block">
                                        {{ $row->dueDate }}
                                    </span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="w-full">
                <h2 x-ucfirst class="text-gray-900 font-black text-md text-center mb-2">
                    Progress
                </h2>
                <ul x-wrap="progress" class="bg-white p-2 rounded-lg w-full min-h-[50px] flex flex-col gap-2">
                    @foreach ($progress as $row)
                        <li x-item="{{ $row->id }}" draggable="true"
                            class="w-full flex flex-col gap-1 {{ System::priorityColor($row->priority) }} p-2 rounded-md overflow-auto">
                            <a href="{{ route('views.tasks.summary', $row->id) }}"
                                class="block w-max text-gray-900 font-bold text-sm hover:underline">
                                #{{ $row->id }} {{ $row->name }}
                            </a>
                            <div class="flex flex-col">
                                <div class="w-full flex items-center gap-2">
                                    <label class="block text-xs font-semibold text-gray-900">Duration:</label>
                                    <span class="text-gray-900 text-xs block">
                                        {{ $row->duration < 1 ? $row->duration * 60 : $row->duration }}
                                        {{ $row->duration < 1 ? 'minutes' : 'hours' }}
                                    </span>
                                </div>
                                <div class="w-full flex items-center gap-2">
                                    <label class="block text-xs font-semibold text-gray-900">Due date:</label>
                                    <span class="text-gray-900 text-xs block">
                                        {{ $row->dueDate }}
                                    </span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="w-full">
                <h2 x-ucfirst class="text-gray-900 font-black text-md text-center mb-2">
                    Closed
                </h2>
                <ul x-wrap="closed" class="bg-white p-2 rounded-lg w-full min-h-[50px] flex flex-col gap-2">
                    @foreach ($closed as $row)
                        <li x-item="{{ $row->id }}" draggable="true"
                            class="w-full flex flex-col gap-1 {{ System::priorityColor($row->priority) }} p-2 rounded-md overflow-auto">
                            <a href="{{ route('views.tasks.summary', $row->id) }}"
                                class="block w-max text-gray-900 font-bold text-sm hover:underline">
                                #{{ $row->id }} {{ $row->name }}
                            </a>
                            <div class="flex flex-col">
                                <div class="w-full flex items-center gap-2">
                                    <label class="block text-xs font-semibold text-gray-900">Duration:</label>
                                    <span class="text-gray-900 text-xs block">
                                        {{ $row->duration < 1 ? $row->duration * 60 : $row->duration }}
                                        {{ $row->duration < 1 ? 'minutes' : 'hours' }}
                                    </span>
                                </div>
                                <div class="w-full flex items-center gap-2">
                                    <label class="block text-xs font-semibold text-gray-900">Due date:</label>
                                    <span class="text-gray-900 text-xs block">
                                        {{ $row->dueDate }}
                                    </span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="w-full">
                <h2 x-ucfirst class="text-gray-900 font-black text-md text-center mb-2">
                    Hold
                </h2>
                <ul x-wrap="hold" class="bg-white p-2 rounded-lg w-full min-h-[50px] flex flex-col gap-2">
                    @foreach ($hold as $row)
                        <li x-item="{{ $row->id }}" draggable="true"
                            class="w-full flex flex-col gap-1 {{ System::priorityColor($row->priority) }} p-2 rounded-md overflow-auto">
                            <a href="{{ route('views.tasks.summary', $row->id) }}"
                                class="block w-max text-gray-900 font-bold text-sm hover:underline">
                                #{{ $row->id }} {{ $row->name }}
                            </a>
                            <div class="flex flex-col">
                                <div class="w-full flex items-center gap-2">
                                    <label class="block text-xs font-semibold text-gray-900">Duration:</label>
                                    <span class="text-gray-900 text-xs block">
                                        {{ $row->duration < 1 ? $row->duration * 60 : $row->duration }}
                                        {{ $row->duration < 1 ? 'minutes' : 'hours' }}
                                    </span>
                                </div>
                                <div class="w-full flex items-center gap-2">
                                    <label class="block text-xs font-semibold text-gray-900">Due date:</label>
                                    <span class="text-gray-900 text-xs block">
                                        {{ $row->dueDate }}
                                    </span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    @include('task-banner')
@endsection

@section('print')
    <h1 class="text-gray-900 font-black text-2xl text-center mb-16">Tasks List</h1>
    <div class="rounded-md overflow-hidden border border-gray-300">
        <table class="w-full text-md text-gray-900">
            <thead class="bg-primary text-xs font-black text-white uppercase">
                <tr class="uppercase">
                    <td class="px-4 py-2">#</td>
                    <td class="px-4 py-2">Name</td>
                    <td class="px-4 py-2">Priority</td>
                    <td class="px-4 py-2">Due date</td>
                    <td class="px-4 py-2">Duration</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="5" class="px-4 py-2 border-y border-gray-300">
                        <h3 x-ucfirst class="font-black">Pending</h3>
                    </td>
                </tr>
                @forelse($pending as $row)
                    <tr>
                        <td class="px-4 py-2">
                            {{ $row->id }}
                        </td>
                        <td x-ucfirst class="px-4 py-2">{{ $row->name }}</td>
                        <td x-ucfirst class="px-4 py-2">
                            {{ $row->priority }}
                        </td>
                        <td class="px-4 py-2">{{ $row->dueDate }}</td>
                        <td class="px-4 py-2">
                            {{ $row->duration < 1 ? $row->duration * 60 : $row->duration }}
                            {{ $row->duration < 1 ? 'minutes' : 'hours' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-2 text-center uppercase">no records found</td>
                    </tr>
                @endforelse
            </tbody>
            <tbody>
                <tr>
                    <td colspan="5" class="px-4 py-2 border-y border-gray-300">
                        <h3 x-ucfirst class="font-black">Ready</h3>
                    </td>
                </tr>
                @forelse($ready as $row)
                    <tr>
                        <td class="px-4 py-2">
                            {{ $row->id }}
                        </td>
                        <td x-ucfirst class="px-4 py-2">{{ $row->name }}</td>
                        <td x-ucfirst class="px-4 py-2">
                            {{ $row->priority }}
                        </td>
                        <td class="px-4 py-2">{{ $row->dueDate }}</td>
                        <td class="px-4 py-2">
                            {{ $row->duration < 1 ? $row->duration * 60 : $row->duration }}
                            {{ $row->duration < 1 ? 'minutes' : 'hours' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-2 text-center uppercase">no records found</td>
                    </tr>
                @endforelse
            </tbody>
            <tbody>
                <tr>
                    <td colspan="5" class="px-4 py-2 border-y border-gray-300">
                        <h3 x-ucfirst class="font-black">Progress</h3>
                    </td>
                </tr>
                @forelse($progress as $row)
                    <tr>
                        <td class="px-4 py-2">
                            {{ $row->id }}
                        </td>
                        <td x-ucfirst class="px-4 py-2">{{ $row->name }}</td>
                        <td x-ucfirst class="px-4 py-2">
                            {{ $row->priority }}
                        </td>
                        <td class="px-4 py-2">{{ $row->dueDate }}</td>
                        <td class="px-4 py-2">
                            {{ $row->duration < 1 ? $row->duration * 60 : $row->duration }}
                            {{ $row->duration < 1 ? 'minutes' : 'hours' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-2 text-center uppercase">no records found</td>
                    </tr>
                @endforelse
            </tbody>
            <tbody>
                <tr>
                    <td colspan="5" class="px-4 py-2 border-y border-gray-300">
                        <h3 x-ucfirst class="font-black">Closed</h3>
                    </td>
                </tr>
                @forelse($closed as $row)
                    <tr>
                        <td class="px-4 py-2">
                            {{ $row->id }}
                        </td>
                        <td x-ucfirst class="px-4 py-2">{{ $row->name }}</td>
                        <td x-ucfirst class="px-4 py-2">
                            {{ $row->priority }}
                        </td>
                        <td class="px-4 py-2">{{ $row->dueDate }}</td>
                        <td class="px-4 py-2">
                            {{ $row->duration < 1 ? $row->duration * 60 : $row->duration }}
                            {{ $row->duration < 1 ? 'minutes' : 'hours' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-2 text-center uppercase">no records found</td>
                    </tr>
                @endforelse
            </tbody>
            <tbody>
                <tr>
                    <td colspan="5" class="px-4 py-2 border-y border-gray-300">
                        <h3 x-ucfirst class="font-black">hold</h3>
                    </td>
                </tr>
                @forelse($hold as $row)
                    <tr>
                        <td class="px-4 py-2">
                            {{ $row->id }}
                        </td>
                        <td x-ucfirst class="px-4 py-2">{{ $row->name }}</td>
                        <td x-ucfirst class="px-4 py-2">
                            {{ $row->priority }}
                        </td>
                        <td class="px-4 py-2">{{ $row->dueDate }}</td>
                        <td class="px-4 py-2">
                            {{ $row->duration < 1 ? $row->duration * 60 : $row->duration }}
                            {{ $row->duration < 1 ? 'minutes' : 'hours' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-2 text-center uppercase">no records found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script>
        kanban(async function(id, status) {
            const form = new FormData();
            form.append('status', status);
            const req = await fetch(`/tasks/${id}/status`, {
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                method: "POST",
                body: form
            });
            const res = await req.json();
        });
    </script>
@endsection
