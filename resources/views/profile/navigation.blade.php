<div class="w-full overflow-y-auto no-scrollbar">
    <div class="flex w-max flex-wrap">
        <a href="{{ route('views.profile.summary') }}"
            class="appearance-none w-max text-md flex items-center justify-center font-semibold p-2 px-4 text-gray-900 outline-none  hover:border-primary focus:border-primary border-b-4 {{ System::activeTab('views.profile.summary') }}">
            <span>Summary</span>
        </a>
        <a href="{{ route('views.profile.contracts') }}"
            class="appearance-none w-max text-md flex items-center justify-center font-semibold p-2 px-4 text-gray-900 outline-none  hover:border-primary focus:border-primary border-b-4 {{ System::activeTab('views.profile.contracts') }}">
            <span>Contracts</span>
        </a>
        <a href="{{ route('views.profile.reviews.index') }}"
            class="appearance-none w-max text-md flex items-center justify-center font-semibold p-2 px-4 text-gray-900 outline-none  hover:border-primary focus:border-primary border-b-4 {{ System::activeTab('views.profile.reviews.index') }}">
            <span>Reviews</span>
        </a>
        <a href="{{ route('views.profile.complaints.index') }}"
            class="appearance-none w-max text-md flex items-center justify-center font-semibold p-2 px-4 text-gray-900 outline-none  hover:border-primary focus:border-primary border-b-4 {{ System::activeTab('views.profile.complaints.index') }}">
            <span>Complaints</span>
        </a>
        <a href="{{ route('views.profile.leaves.index') }}"
            class="appearance-none w-max text-md flex items-center justify-center font-semibold p-2 px-4 text-gray-900 outline-none  hover:border-primary focus:border-primary border-b-4 {{ System::activeTab('views.profile.leaves.index') }}">
            <span>Leaves</span>
        </a>
        <a href="{{ route('views.profile.accounts') }}"
            class="appearance-none w-max text-md flex items-center justify-center font-semibold p-2 px-4 text-gray-900 outline-none  hover:border-primary focus:border-primary border-b-4 {{ System::activeTab('views.profile.accounts') }}">
            <span>Accounts</span>
        </a>
        <a href="{{ route('views.profile.expenses.index') }}"
            class="appearance-none w-max text-md flex items-center justify-center font-semibold p-2 px-4 text-gray-900 outline-none  hover:border-primary focus:border-primary border-b-4 {{ System::activeTab('views.profile.expenses') }}">
            <span>Expenses</span>
        </a>
        <a x-tab="#documents"
            class="appearance-none w-max text-md flex items-center justify-center font-semibold p-2 px-4 text-gray-900 outline-none  hover:border-primary focus:border-primary border-b-4 {{ System::activeTab('views.profile.documents') }}">
            <span>Documents</span>
        </a>
    </div>
</div>
