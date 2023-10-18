@extends('communs.base')
@section('title', 'Task #' . $data->id . ' Notes')

@section('content')
    <div class="w-full bg-white rounded-lg -mt-12 overflow-hidden">
        <div class="p-4 flex items-center justify-between gap-4">
            <h1 class="font-black text-gray-900 text-2xl">
                Task #{{ $data->id }} Notes
            </h1>
        </div>
        @include('task.navigation', ['id' => $data->id])
    </div>

    <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-3 items-start gap-4">
        <div class="w-full bg-white p-4 rounded-lg lg:col-span-2">
            <ul class="w-full flex flex-col gap-4">
                @forelse($notes as $row)
                    <li class="flex flex-col rounded-md items-end bg-gray-50 border border-gray-300">
                        <div class="w-full p-1 flex justify-between items-center font-bold text-sm text-gray-900">
                            <span x-ucfirst>
                                {{ $row->employee()->first()->firstName }}
                                {{ $row->employee()->first()->lastName }}
                            </span>
                            @if (Auth::user()->id == $row->employee()->first()->id)
                                <a href="{{ route('actions.tasks.notes.destroy', ['task' => $data->id, 'id' => $row->id]) }}"
                                    class="w-5 h-5 rounded-full text-sm font-black text-gray-50 bg-red-400 flex items-center justify-center outline-none hover:bg-gray-900 hover:text-gray-900 hover:bg-opacity-10 focus:bg-gray-900 focus:bg-opacity-10 focus:text-gray-900">
                                    <svg class="block w-3 h-3 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                        <path
                                            d="M12.65 43.05q-1.8 0-3.2-1.35-1.4-1.35-1.4-3.2V10.9H7.5q-.95 0-1.575-.65T5.3 8.65q0-1 .625-1.65.625-.65 1.575-.65h9.1q0-1 .65-1.675T18.9 4h10.2q1 0 1.675.675t.675 1.675h9q1 0 1.65.675.65.675.65 1.575 0 1.05-.65 1.675t-1.65.625h-.55v27.6q0 1.85-1.35 3.2t-3.25 1.35Zm5.2-10.25q0 .7.55 1.25t1.25.55q.75 0 1.325-.55t.575-1.25V16.6q0-.75-.6-1.325t-1.3-.575q-.75 0-1.275.575-.525.575-.525 1.325Zm8.65 0q0 .7.575 1.25t1.275.55q.75 0 1.325-.55t.575-1.25V16.6q0-.75-.575-1.325T28.35 14.7q-.75 0-1.3.575T26.5 16.6Z" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                        <span class="border-b border-gray-300 w-full"></span>
                        <p x-ucfirst class="w-full p-2 text-gray-900 text-md">
                            {{ $row->note }}
                        </p>
                        <span class="border-b border-gray-300 w-full"></span>
                        <span class="text-gray-700 p-1 text-xs font-black">
                            {{ Carbon::parse($row->created_at)->diffForHumans() }}
                        </span>
                    </li>
                @empty
                    <li class="flex flex-col gap-2 p-4 rounded-md items-end bg-gray-50 border border-gray-300">
                        <p x-ucfirst class="w-full text-gray-900 text-lg text-center uppercase">
                            no recoreds found
                        </p>
                    </li>
                @endforelse
            </ul>
        </div>
        <div class="sticky top-4 w-full bg-white p-4 rounded-lg ">
            <form action="{{ route('actions.tasks.notes.store', $data->id) }}" method="POST"
                class="w-full flex flex-col gap-4">
                @csrf
                <div class="w-full">
                    <label x-ucfirst for="note" class="block text-sm font-black text-gray-900 mb-1">Note</label>
                    <div class="relative">
                        <textarea id="note"" placeholder="Note" name="note"
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
