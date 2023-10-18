<div class="w-full overflow-y-auto no-scrollbar">
    <div class="flex w-max flex-wrap">
        <a href="{{ route('views.profile.tasks.summary', $id) }}"
            class="appearance-none w-max text-md flex items-center justify-center font-semibold p-2 px-4 text-gray-900 outline-none  hover:border-primary focus:border-primary border-b-4 {{ System::activeTab('views.profile.tasks.summary') }}">
            <span>Summary</span>
        </a>
        <a href="{{ route('views.profile.tasks.notes.index', $id) }}"
            class="appearance-none w-max text-md flex items-center justify-center font-semibold p-2 px-4 text-gray-900 outline-none  hover:border-primary focus:border-primary border-b-4 {{ System::activeTab('views.profile.tasks.notes.index') }}">
            <span>Notes</span>
        </a>
        <a href="{{ route('test') }}"
            class="appearance-none w-max text-md flex items-center justify-center font-semibold p-2 px-4 text-gray-900 outline-none  hover:border-primary focus:border-primary border-b-4 {{ System::activeTab('test') }}">
            <span>Documents</span>
        </a>
    </div>
</div>
