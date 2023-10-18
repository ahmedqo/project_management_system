<div class="w-full overflow-y-auto">
    <div class="flex w-max flex-wrap">
        <a href="{{ route('views.clients.summary', $id) }}"
            class="appearance-none w-max text-md flex items-center justify-center font-semibold p-2 px-4 text-gray-900 outline-none  hover:border-primary focus:border-primary border-b-4 {{ System::activeTab('views.clients.summary') }}">
            <span>Summary</span>
        </a>
        <a href="{{ route('views.clients.contacts', $id) }}"
            class="appearance-none w-max text-md flex items-center justify-center font-semibold p-2 px-4 text-gray-900 outline-none  hover:border-primary focus:border-primary border-b-4 {{ System::activeTab('views.clients.contacts') }}">
            <span>Contacts</span>
        </a>
        <a href="{{ route('views.clients.projects', $id) }}"
            class="appearance-none w-max text-md flex items-center justify-center font-semibold p-2 px-4 text-gray-900 outline-none  hover:border-primary focus:border-primary border-b-4 {{ System::activeTab('views.clients.projects') }}">
            <span>Projects</span>
        </a>
        <a href="{{ route('views.clients.accounts', $id) }}"
            class="appearance-none w-max text-md flex items-center justify-center font-semibold p-2 px-4 text-gray-900 outline-none  hover:border-primary focus:border-primary border-b-4 {{ System::activeTab('views.clients.accounts') }}">
            <span>Accounts</span>
        </a>
        <a href="{{ route('views.clients.documents', $id) }}"
            class="appearance-none w-max text-md flex items-center justify-center font-semibold p-2 px-4 text-gray-900 outline-none  hover:border-primary focus:border-primary border-b-4 {{ System::activeTab('views.clients.documents') }}">
            <span>Documents</span>
        </a>
    </div>
</div>
