@php
    $notifications = App\Models\Notification::where('employee', Auth::user()->id)
        ->orderBy('id', 'DESC')
        ->limit(6)
        ->get();
    
    $messages = false;
    $conversations = App\Models\Participant::with('conversation')
        ->where('employee', Auth::user()->id)
        ->get();
    foreach ($conversations as $conversation) {
        if (
            App\Models\Message::where('conversation', $conversation->conversation)
                ->where('employee', '!=', Auth::user()->id)
                ->where('isRead', 0)
                ->count() > 0
        ) {
            $messages = true;
        }
    }
@endphp

<header class="w-full bg-primary shadow-sm pb-8">
    <nav class="w-full container mx-auto flex items-center gap-2 p-4">
        <button x-toggle="#menu" x-property="left-0, -left-full, pointer-events-none, lg:w-[260px], lg:w-0"
            class="w-[42px] h-[42px] flex items-center justify-center rounded-full text-white outline-none hover:bg-gray-900 hover:bg-opacity-10 focus:bg-gray-900 focus:bg-opacity-10">
            <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                <path
                    d="M21.05 43V30.75h4v4.2h17.7v4h-17.7V43Zm-15.8-4.05v-4h13.3v4Zm9.3-8.9v-4.1h-9.3V22h9.3v-4.15h4v12.2Zm6.5-4.1V22h21.7v3.95Zm8.4-8.75V4.95h4v4.1h9.3v4h-9.3v4.15Zm-24.2-4.15v-4h21.7v4Z" />
            </svg>
        </button>
        <div class="w-max flex items-center gap-2 ml-auto">
            <div class="w-max relative">
                <button onclick="read(this)" x-toggle="#notification" x-property="pointer-events-none, opacity-0"
                    class="relative w-[42px] h-[42px] flex items-center justify-center rounded-full text-white outline-none hover:bg-gray-900 hover:bg-opacity-10 focus:bg-gray-900 focus:bg-opacity-10">
                    <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                        <path
                            d="M8.3 39.1q-1.05 0-1.7-.675-.65-.675-.65-1.625 0-1.05.65-1.675t1.7-.625h2.3V20.4q0-4.5 2.675-8.225Q15.95 8.45 20.45 7.35v-1.2q0-1.5 1.025-2.475Q22.5 2.7 24 2.7t2.525.975q1.025.975 1.025 2.475v1.2q4.55 1.05 7.275 4.775Q37.55 15.85 37.55 20.4v14.1h2.25q.95 0 1.625.625t.675 1.625q0 1.05-.675 1.7-.675.65-1.625.65Zm15.75 6q-1.8 0-3.1-1.275t-1.3-3.075h8.75q0 1.85-1.275 3.1T24.05 45.1Z" />
                    </svg>
                    @if ($notifications->where('isRead', 0)->count())
                        <span class="w-3 h-3 animate-pulse rounded-full bg-blue-500 absolute top-2 right-2"></span>
                    @endif
                </button>
                <ul id="notification"
                    class="w-[360px] flex flex-col bg-white rounded-lg overflow-hidden absolute right-0 top-full mt-2 transition-all duration-200 opacity-0 pointer-events-none z-20 border border-gray-200">
                    @forelse($notifications as $row)
                        <li x-notification-item="{{ $row->isRead }}"
                            class="w-full flex gap-1 flex-col border-b border-gray-900 border-opacity-10 p-4 py-2 outline-none text-gray-900 hover:bg-gray-900 hover:bg-opacity-10 focus:bg-gray-900 focus:bg-opacity-10">
                            <div class="text-md w-full">
                                {{ ucfirst($row->body) }}
                            </div>
                            <span class="text-xs font-black w-max ml-auto text-gray-400">
                                {{ Carbon::parse($row->created_at)->diffForHumans() }}
                            </span>
                        </li>
                    @empty
                        <li
                            class="w-full flex flex-col p-4 border-b border-gray-900 border-opacity-10 outline-none text-gray-900">
                            <div class="text-xs uppercase font-black w-full ml-auto text-gray-400 text-center">
                                no records found
                            </div>
                        </li>
                    @endforelse
                    <li
                        class="w-full flex flex-col p-2 outline-none text-gray-900 hover:bg-gray-900 hover:bg-opacity-10 focus:bg-gray-900 focus:bg-opacity-10">
                        <a href="{{ route('views.notifications.index') }}"
                            class="text-xs uppercase font-black w-full ml-auto text-dark text-center hover:underline">
                            view all
                        </a>
                    </li>
                </ul>
            </div>
            <a href="{{ route('views.conversations.index') }}"
                class="w-[42px] h-[42px] flex items-center justify-center rounded-full text-white outline-none hover:bg-gray-900 hover:bg-opacity-10 focus:bg-gray-900 focus:bg-opacity-10 relative">
                <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                    <path
                        d="M7.5 41.1q-1.85 0-3.2-1.375T2.95 36.55v-25.1q0-1.8 1.35-3.2 1.35-1.4 3.2-1.4h33q1.85 0 3.225 1.4t1.375 3.2v25.1q0 1.8-1.375 3.175Q42.35 41.1 40.5 41.1ZM24 25.85q.3 0 .575-.075.275-.075.675-.325l14.6-9.75q.25-.15.45-.475.2-.325.2-.825 0-.75-.8-1.325t-1.55.025L24 22.35 9.95 13.1q-.8-.5-1.625-.05T7.5 14.4q0 .45.225.775t.475.525l14.55 9.75q.4.25.675.325.275.075.575.075Z" />
                </svg>
                @if ($messages)
                    <span class="w-3 h-3 animate-pulse rounded-full bg-blue-500 absolute top-2 right-2"></span>
                @endif
            </a>
            <div class="w-max relative">
                <button x-toggle="#dropdown" x-property="pointer-events-none, opacity-0"
                    class="flex items-center justify-center w-[42px] h-[42px] rounded-full focus:outline-1 focus:outline-1-2 outline-primary overflow-hidden"
                    style="background: {{ Auth::user()->bg }};">
                    @if (Auth::user()->photo)
                        <img class="block w-full h-full object-cover"
                            src="{{ asset('storage/profile/' . Auth::user()->photo) }}" />
                    @else
                        <span
                            class="text-xs font-black text-white">{{ strtoupper(Auth::user()->firstName[0]) }}{{ strtoupper(Auth::user()->lastName[0]) }}</span>
                    @endif
                </button>
                <ul id="dropdown"
                    class="w-[160px] flex flex-col bg-white rounded-lg overflow-hidden absolute right-0 top-full mt-2 transition-all duration-200 opacity-0 pointer-events-none z-20 border border-gray-200">
                    <li class="w-full">
                        <a href="{{ route('views.profile.summary') }}"
                            class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-900 hover:bg-gray-900 hover:bg-opacity-10 focus:bg-gray-900 focus:bg-opacity-10 {{ System::activeLink('views.profile.summary') }}">
                            <svg class="block w-4 h-4 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                <path
                                    d="M24 23.35q-3.85 0-6.225-2.4-2.375-2.4-2.375-6.2 0-3.8 2.375-6.2Q20.15 6.15 24 6.15q3.8 0 6.225 2.375t2.425 6.225q0 3.8-2.4 6.2-2.4 2.4-6.25 2.4ZM11.45 41.5q-1.9 0-3.225-1.325Q6.9 38.85 6.9 36.95V35.7q0-2.15 1.125-3.8T11 29.4q3.4-1.6 6.6-2.35 3.2-.75 6.4-.75 3.25 0 6.4.8 3.15.8 6.55 2.3 1.9.75 3.05 2.425 1.15 1.675 1.15 3.875v1.25q0 1.9-1.35 3.225-1.35 1.325-3.25 1.325Z" />
                            </svg>
                            <span class="text-sm font-medium">Profile</span>
                        </a>
                    </li>
                    <li class="w-full">
                        <a href="{{ route('views.profile.password') }}"
                            class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-900 hover:bg-gray-900 hover:bg-opacity-10 focus:bg-gray-900 focus:bg-opacity-10 {{ System::activeLink('views.profile.password') }}">
                            <svg class="block w-4 h-4 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                <path
                                    d="M27.55 45.05h-7.1q-.9 0-1.575-.5-.675-.5-.725-1.45l-.75-4.7q-.7-.2-1.55-.7-.85-.5-1.4-.95l-4.3 2.05q-.75.4-1.625.1-.875-.3-1.325-1.15L3.65 31.4q-.55-.75-.3-1.6.25-.85.9-1.35l4-2.95q-.05-.25-.05-.725v-1.5q0-.425.05-.775l-4-2.95q-.65-.55-.9-1.375t.25-1.625l3.6-6.35q.5-.75 1.35-1.025.85-.275 1.6.075l4.4 2q.5-.35 1.35-.85.85-.5 1.5-.7l.75-4.85q.05-.9.75-1.425t1.55-.525h7.1q.85 0 1.55.525.7.525.8 1.425l.7 4.8q.75.2 1.575.7.825.5 1.375.9l4.3-2.05q.75-.35 1.625-.05T40.8 10.2l3.65 6.3q.5.8.25 1.65-.25.85-.9 1.4l-4.1 2.8q.05.4.125.85.075.45.075.8 0 .35-.075.775-.075.425-.125.775l4.1 2.85q.65.6.875 1.425.225.825-.225 1.625L40.8 37.8q-.5.85-1.35 1.125-.85.275-1.6-.125l-4.3-2.05q-.55.45-1.425.975-.875.525-1.475.675l-.75 4.7q-.1.95-.8 1.45-.7.5-1.55.5Zm-3.6-14.7q2.65 0 4.5-1.85T30.3 24q0-2.6-1.85-4.475-1.85-1.875-4.5-1.875-2.7 0-4.525 1.875Q17.6 21.4 17.6 24q0 2.65 1.825 4.5t4.525 1.85Z" />
                            </svg>
                            <span class="text-sm font-medium">Password</span>
                        </a>
                    </li>
                    <li class="w-full">
                        <a href="{{ route('actions.profile.logout') }}"
                            class="w-full flex gap-2 items-center px-4 py-2 outline-none text-gray-900 hover:bg-gray-900 hover:bg-opacity-10 focus:bg-gray-900 focus:bg-opacity-10 {{ System::activeLink('actions.profile.logout') }}">
                            <svg class="block w-4 h-4 pointer-events-none" fill="currentcolor" viewBox="0 0 48 48">
                                <path
                                    d="M31.75 32.7q-.65-.75-.675-1.65-.025-.9.675-1.6l3.2-3.15h-14.5q-1 0-1.625-.675T18.2 24q0-1 .625-1.625t1.625-.625h14.4l-3.3-3.35q-.65-.6-.625-1.5.025-.9.725-1.6.6-.6 1.6-.575 1 .025 1.7.625l7.05 7.1q.25.3.45.75t.2.85q0 .45-.2.875T42 25.6l-7.05 7.15q-.65.65-1.55.6-.9-.05-1.65-.65ZM9.05 43.15q-1.9 0-3.25-1.35t-1.35-3.2V9.4q0-1.85 1.35-3.225T9.05 4.8H21.6q1 0 1.65.7.65.7.65 1.65 0 1-.65 1.625T21.6 9.4H9.05v29.2H21.6q1 0 1.65.625.65.625.65 1.625t-.65 1.65q-.65.65-1.65.65Z" />
                            </svg>
                            <span class="text-sm font-medium">Log out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
