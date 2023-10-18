@extends('communs.base')
@section('title', 'Conversation #' . $data->id)

@section('content')
    <div class="w-full bg-white rounded-lg -mt-12 overflow-hidden">
        <div class="p-4 flex items-center justify-between gap-4">
            <div class="flex items-center gap-1">
                <h1 x-ucfirst class="font-black text-gray-900 text-2xl">
                    {{ $data->subject }}
                </h1>
            </div>
        </div>
    </div>

    <div class="grid grid-rows-1 grid-cols-1 items-start gap-4">
        <div class="w-full bg-white p-4 rounded-lg flex flex-col gap-4">
            <ul display class="w-full flex flex-col gap-4">
                @foreach ($messages as $row)
                    <li
                        class="flex w-max lg:max-w-[50%] gap-1 items-start {{ $row->employee == Auth::user()->id ? 'ml-auto' : '' }}">
                        <div class="flex items-center justify-center w-[38px] h-[38px] rounded-full focus:outline-1 focus:outline-1-2 outline-primary  overflow-hidden {{ $row->employee == Auth::user()->id ? 'order-2' : '' }}"
                            style="background: {{ $row->employee == Auth::user()->id ? Auth::user()->bg : $recipient->bg }};">
                            @if (
                                ($row->employee == Auth::user()->id && Auth::user()->photo) ||
                                    ($row->employee == $recipient->id && $recipient->photo))
                                <img class="block w-full h-full object-cover"
                                    src="{{ asset('storage/profile/' . ($row->employee == Auth::user()->id ? Auth::user()->photo : $recipient->photo)) }}" />
                            @else
                                <span class="text-xs font-black text-white">
                                    {{ $row->employee == Auth::user()->id ? strtoupper(Auth::user()->firstName[0]) . strtoupper(Auth::user()->lastName[0]) : strtoupper($recipient->firstName[0]) . strtoupper($recipient->lastName[0]) }}
                                </span>
                            @endif
                        </div>
                        <div class="flex flex-col">
                            <div
                                class="w-full p-2 flex justify-between items-center text-sm text-gray-900 rounded-md border border-gray-300 {{ $row->employee == Auth::user()->id ? 'bg-blue-50' : 'bg-gray-50' }}">
                                {!! nl2br($row->content) !!}
                            </div>
                            <span
                                class="block w-max text-gray-700 pt-1 text-xs font-black {{ $row->employee == Auth::user()->id ? 'ml-auto' : '' }}">
                                {{ Carbon::parse($row->created_at)->diffForHumans() }}
                            </span>
                        </div>
                    </li>
                @endforeach
            </ul>
            <form onsubmit="post(event)" action="{{ route('actions.conversations.send', $data->id) }}" method="POST"
                class="w-full flex flex-col gap-4">
                @csrf
                <div class="w-full">
                    <div class="bg-gray-50 border border-gray-300 text-gray-900 rounded-md overflow-hidden">
                        <textarea id="content"" placeholder="Content" name="content"
                            class="appearance-none bg-gray-50 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary"></textarea>
                        <div class="relative w-full border-t border-gray-300">
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
                    <button type="submit"
                        class="appearance-none lg:w-max ml-auto text-md flex items-center justify-center rounded-md font-semibold w-full p-2 px-4 text-white outline-none bg-primary hover:bg-light focus:bg-light">
                        <span x-ucfirst>Send</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const cn = document.querySelector('[display]');
        var messages = {!! json_encode($messages) !!};

        function compare(array, toCompare) {
            if (array.length !== toCompare.length) {
                return true;
            }
            for (let i = 0; i < array.length; i++) {
                const obj1 = array[i].content;
                const obj2 = toCompare[i].content;
                if (obj1 !== obj2) {
                    return true;
                }
            }
            return false;
        }

        function populate(data) {
            const id = {{ Auth::user()->id }};
            cn.innerHTML = "";
            data.forEach(row => {
                cn.innerHTML += `
                    <li class="flex w-max lg:max-w-[50%] gap-1 items-start ${ row.employee == id ? 'ml-auto' : '' }">
                        <div class="flex items-center justify-center w-[38px] h-[38px] rounded-full focus:outline-1 focus:outline-1-2 outline-primary overflow-hidden ${ row.employee == id ? 'order-2' : '' }" style="background: ${row.user.bg};">
                            ${row.user.photo ? ` <img class="block w-full h-full object-cover" src="${location.origin + "/storage/profile/" + row.user.photo}" />` : 
                                `<span class="text-xs font-black text-white">
                                                                    ${row.user.firstName[0].toUpperCase()}${row.user.lastName[0].toUpperCase()}
                                                                </span>`}
                        </div>
                        <div class="flex flex-col">
                            <div class="w-full p-2 flex justify-between items-center text-sm text-gray-900 rounded-md border border-gray-300 ${ row.employee == id ? 'bg-blue-50' : 'bg-gray-50' }">
                                ${row.text}
                            </div>
                            <span class="block w-max text-gray-700 pt-1 text-xs font-black ${ row.employee == id ? 'ml-auto' : '' }">
                                ${row.date}
                            </span>
                        </div>
                    </li>
                `;
            });
            window.scrollTo(0, document.body.scrollHeight);
        }

        async function getData(test = true) {
            const _ = await fetch("{{ route('actions.conversations.data', $data->id) }}");
            const data = await _.json();
            if (!test) {
                messages = data;
                populate(data);
            }
            if (test && compare(data, messages)) {
                messages = data;
                populate(data);
            }
        }

        function run() {
            setTimeout(() => {
                getData();
                requestAnimationFrame(run);
            }, 1000);
        }

        function _run() {
            setTimeout(() => {
                getData(false);
                requestAnimationFrame(_run);
            }, 300000);
        }

        function post(e) {
            var name = "{{ strtoupper(Auth::user()->firstName[0]) . strtoupper(Auth::user()->lastName[0]) }}";
            var holder = `@if (Auth::user()->photo)
                                <img class="block w-full h-full object-cover" src="{{ asset('storage/profile/' . Auth::user()->photo) }}" />
                            @else
                                <span class="text-xs font-black text-white">
                                    ${name}
                                </span>
                            @endif
                        `;
            e.preventDefault();
            if (e.target['content'].value.trim().length) {
                const form = new FormData(e.target);
                fetch("{{ route('actions.conversations.send', $data->id) }}", {
                    method: 'POST',
                    body: form
                });
                cn.innerHTML += `
                    <li class="flex w-max lg:max-w-[50%] gap-1 items-start ml-auto">
                        <div class="flex items-center justify-center w-[38px] h-[38px] rounded-full focus:outline-1 focus:outline-1-2 outline-primary order-2  overflow-hidden" style="background: {{ Auth::user()->bg }};">
                            ${holder}
                        </div>
                        <div class="flex flex-col">
                            <div class="w-full p-2 flex justify-between items-center text-sm text-gray-900 rounded-md border border-gray-300 bg-blue-50">
                                ${e.target['content'].value.trim().replace(/\n\r/g, '<br />')}
                            </div>
                            <span class="block w-max text-gray-700 pt-1 text-xs font-black ml-auto">
                                1 seconds ago
                            </span>
                        </div>
                    </li>
                `;
                e.target['content'].value = "";
                window.scrollTo(0, document.body.scrollHeight);
            }
        }

        requestAnimationFrame(run);
        requestAnimationFrame(_run);
    </script>
@endsection
