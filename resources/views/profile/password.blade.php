@extends('communs.base')
@section('title', 'Edit Password')

@section('content')
    <div class="w-full bg-white rounded-lg -mt-12 overflow-hidden">
        <div class="p-4 flex items-center justify-between gap-4">
            <h1 class="font-black text-gray-900 text-2xl">
                Edit Password
            </h1>
        </div>
    </div>

    <div class="grid grid-rows-1 grid-cols-1 gap-4">
        <div class="w-full bg-white p-4 rounded-lg ">
            <form action="{{ route('actions.profile.password') }}" method="POST" class="w-full flex flex-col gap-4">
                @csrf
                <div class="w-full">
                    <label x-ucfirst for="oldPassword" class="block text-sm font-black text-gray-900 mb-1">Old
                        password</label>
                    <input x-password id="oldPassword" type="password" placeholder="Old password" name="oldPassword" />
                </div>
                <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                    <div class="w-full">
                        <label x-ucfirst for="newPassword" class="block text-sm font-black text-gray-900 mb-1">New
                            password</label>
                        <input x-password id="newPassword" type="password" placeholder="New password" name="newPassword" />
                    </div>
                    <div class="w-full">
                        <label x-ucfirst for=confirmPassword" class="block text-sm font-black text-gray-900 mb-1">Confirm
                            password</label>
                        <input x-password id="confirmPassword" type="password" placeholder="Confirm password"
                            name="confirmPassword" />
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
