<div class="w-full overflow-y-auto no-scrollbar">
    <div class="flex w-max flex-wrap">
        <a href="{{ route('views.employees.summary', $id) }}"
            class="appearance-none w-max text-md flex items-center justify-center font-semibold p-2 px-4 text-gray-900 outline-none  hover:border-primary focus:border-primary border-b-4 {{ System::activeTab('views.employees.summary') }}">
            <span>Summary</span>
        </a>
        <a href="{{ route('views.employees.projects', $id) }}"
            class="appearance-none w-max text-md flex items-center justify-center font-semibold p-2 px-4 text-gray-900 outline-none  hover:border-primary focus:border-primary border-b-4 {{ System::activeTab('views.employees.projects') }}">
            <span>Projects</span>
        </a>
        <a href="{{ route('views.employees.tasks', $id) }}"
            class="appearance-none w-max text-md flex items-center justify-center font-semibold p-2 px-4 text-gray-900 outline-none  hover:border-primary focus:border-primary border-b-4 {{ System::activeTab('views.employees.tasks') }}">
            <span>Tasks</span>
        </a>
        <a href="{{ route('views.employees.contracts', $id) }}"
            class="appearance-none w-max text-md flex items-center justify-center font-semibold p-2 px-4 text-gray-900 outline-none  hover:border-primary focus:border-primary border-b-4 {{ System::activeTab('views.employees.contracts') }}">
            <span>Contracts</span>
        </a>
        <a href="{{ route('views.employees.reviews.index', $id) }}"
            class="appearance-none w-max text-md flex items-center justify-center font-semibold p-2 px-4 text-gray-900 outline-none  hover:border-primary focus:border-primary border-b-4 {{ System::activeTab('views.employees.reviews.index') }}">
            <span>Reviews</span>
        </a>
        <a href="{{ route('views.employees.complaints.index', $id) }}"
            class="appearance-none w-max text-md flex items-center justify-center font-semibold p-2 px-4 text-gray-900 outline-none  hover:border-primary focus:border-primary border-b-4 {{ System::activeTab('views.employees.complaints.index') }}">
            <span>Complaints</span>
        </a>
        <a href="{{ route('views.employees.leaves', $id) }}"
            class="appearance-none w-max text-md flex items-center justify-center font-semibold p-2 px-4 text-gray-900 outline-none  hover:border-primary focus:border-primary border-b-4 {{ System::activeTab('views.employees.leaves') }}">
            <span>Leaves</span>
        </a>
        <a href="{{ route('views.employees.accounts', $id) }}"
            class="appearance-none w-max text-md flex items-center justify-center font-semibold p-2 px-4 text-gray-900 outline-none  hover:border-primary focus:border-primary border-b-4 {{ System::activeTab('views.employees.accounts') }}">
            <span>Accounts</span>
        </a>
        <a href="{{ route('views.employees.expenses', $id) }}"
            class="appearance-none w-max text-md flex items-center justify-center font-semibold p-2 px-4 text-gray-900 outline-none  hover:border-primary focus:border-primary border-b-4 {{ System::activeTab('views.employees.expenses') }}">
            <span>Expenses</span>
        </a>
        <a x-tab="#documents"
            class="appearance-none w-max text-md flex items-center justify-center font-semibold p-2 px-4 text-gray-900 outline-none  hover:border-primary focus:border-primary border-b-4 {{ System::activeTab('views.employees.documents') }}">
            <span>Documents</span>
        </a>
    </div>
</div>
