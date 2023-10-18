@extends('communs.base')
@section('title', 'Edit Client #' . $data->id)

@section('content')
    <div class="w-full bg-white rounded-lg -mt-12 overflow-hidden">
        <div class="p-4 flex items-center justify-between gap-4">
            <h1 class="font-black text-gray-900 text-2xl">
                Edit CLient #{{ $data->id }}
            </h1>
        </div>
    </div>

    <div class="grid grid-rows-1 grid-cols-1 gap-4">
        <div class="w-full bg-white p-4 rounded-lg ">
            <form action="{{ route('actions.clients.update', $data->id) }}" method="POST" class="w-full flex flex-col gap-4">
                @csrf
                <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-3 gap-4">
                    <div class="w-full">
                        <label x-ucfirst for="name" class="block text-sm font-black text-gray-900 mb-1">Name</label>
                        <div class="relative">
                            <input id="name" type="text" placeholder="Name" name="name"
                                value="{{ $data->name }}"
                                class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary" />
                        </div>
                    </div>
                    <div class="w-full">
                        <label x-ucfirst for="type" class="block text-sm font-black text-gray-900 mb-1">Type</label>
                        <div class="relative">
                            <input id="type" type="text" placeholder="Type" name="type"
                                value="{{ $data->type }}"
                                class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary" />
                        </div>
                    </div>
                    <div class="w-full">
                        <label x-ucfirst for="email" class="block text-sm font-black text-gray-900 mb-1">Email</label>
                        <div class="relative">
                            <input id="email" type="email" placeholder="Email" name="email"
                                value="{{ $data->email }}"
                                class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary" />
                        </div>
                    </div>
                </div>
                <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-3 gap-4">
                    <div class="w-full">
                        <label x-ucfirst for="fixPhone" class="block text-sm font-black text-gray-900 mb-1">Fix
                            phone</label>
                        <div class="relative">
                            <input id="fixPhone" type="tel" placeholder="Fix phone" name="fixPhone"
                                value="{{ $data->fixPhone }}"
                                class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary" />
                        </div>
                    </div>
                    <div class="w-full">
                        <label x-ucfirst for="cellPhone" class="block text-sm font-black text-gray-900 mb-1">Cell
                            phone</label>
                        <div class="relative">
                            <input id="cellPhone" type="tel" placeholder="Cell phone" name="cellPhone"
                                value="{{ $data->cellPhone }}"
                                class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary" />
                        </div>
                    </div>
                    <div class="w-full">
                        <label x-ucfirst for="faxPhone" class="block text-sm font-black text-gray-900 mb-1">Fax
                            phone</label>
                        <div class="relative">
                            <input id="faxPhone" type="tel" placeholder="Fax phone" name="faxPhone"
                                value="{{ $data->faxPhone }}"
                                class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary" />
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <label x-ucfirst for="address" class="block text-sm font-black text-gray-900 mb-1">Address</label>
                    <div class="relative">
                        <textarea id="address" type="text" placeholder="Address" name="address"
                            class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary">{{ $data->address }}</textarea>
                    </div>
                </div>
                <div class="w-full">
                    <label x-ucfirst for="document" class="block text-sm font-black text-gray-900 mb-1">Documents</label>
                    <div class="bg-gray-50 border border-gray-300 text-gray-900 rounded-md overflow-hidden">
                        <div class="relative w-full">
                            <input id="document" type="file"
                                class="opacity-0 block absolute top-0 left-0 w-full h-full cursor-pointer" name="document[]"
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
                        <div class="flex flex-col">
                            @foreach ($docs as $doc)
                                <div class="flex flex-wrap gap-2 items-center justify-between p-2 border-t border-gray-300">
                                    <span class="relative">
                                        <input data-file type="checkbox" onchange="remove(event)"
                                            class="w-5 h-5 accent-primary cursor-pointer peer opacity-0 absolute inset-0" />
                                        <svg class="block w-5 h-5 pointer-events-none text-red-400" fill="currentcolor"
                                            viewBox="0 0 48 48">
                                            <path
                                                d="M12.65 43.05q-1.8 0-3.2-1.35-1.4-1.35-1.4-3.2V10.9H7.5q-.95 0-1.575-.65T5.3 8.65q0-1 .625-1.65.625-.65 1.575-.65h9.1q0-1 .65-1.675T18.9 4h10.2q1 0 1.675.675t.675 1.675h9q1 0 1.65.675.65.675.65 1.575 0 1.05-.65 1.675t-1.65.625h-.55v27.6q0 1.85-1.35 3.2t-3.25 1.35Zm5.2-10.25q0 .7.55 1.25t1.25.55q.75 0 1.325-.55t.575-1.25V16.6q0-.75-.6-1.325t-1.3-.575q-.75 0-1.275.575-.525.575-.525 1.325Zm8.65 0q0 .7.575 1.25t1.275.55q.75 0 1.325-.55t.575-1.25V16.6q0-.75-.575-1.325T28.35 14.7q-.75 0-1.3.575T26.5 16.6Z" />
                                        </svg>
                                    </span>
                                    <a class="block flex-1 text-md truncate text-ellipsis overflow-hidden peer peer-checked:line-through hover:underline"
                                        download="{{ $doc->name }}" href="{{ $doc->doc }}"
                                        title="({{ $doc->type }}) {{ $doc->size }}kb">
                                        {{ $doc->name }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <label x-ucfirst for="description"
                        class="block text-sm font-black text-gray-900 mb-1">Description</label>
                    <div class="relative">
                        <textarea x-rich id="description"" placeholder="Description" name="description"
                            class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary">{{ $data->description }}</textarea>
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
