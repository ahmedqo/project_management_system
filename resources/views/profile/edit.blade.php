@extends('communs.base')
@section('title', 'Edit Profile')

@section('content')
    <div class="w-full bg-white rounded-lg -mt-12 overflow-hidden">
        <div class="p-4 flex items-center justify-between gap-4">
            <h1 class="font-black text-gray-900 text-2xl">
                Edit Profile
            </h1>
        </div>
        @include('profile.navigation')
    </div>

    <div class="grid grid-rows-1 grid-cols-1 gap-4">
        <div class="w-full bg-white p-4 rounded-lg ">
            <form action="{{ route('actions.profile.update') }}" method="POST" class="w-full flex flex-col gap-4">
                @csrf
                <div class="w-full flex flex-wrap gap-4">
                    <label for="image"
                        class="bg-gray-50 cursor-pointer flex items-center justify-center border border-gray-300 rounded-md aspect-square h-[275px] overflow-hidden">
                        <input id="image" type="file" name="photo" accept="image/*" onchange="preview(event)"
                            class="sr-only" />
                        <img class="max-w-full max-h-full block"
                            src="{{ $data->photo ? asset('storage/profile/' . $data->photo) : 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA0OCA0OCIgd2lkdGg9IjIwMCIgaGVpZ2h0PSIyMDAiIGZpbGw9IiMxMTE4MjciPjxwYXRoIGQ9Ik0yNCAzMS4yNXEtMSAwLTEuNjUtLjY3NVEyMS43IDI5LjkgMjEuNyAyOVYxMy40NWwtNC4xIDQuMXEtLjY1LjYtMS41NzUuNjI1LS45MjUuMDI1LTEuNTI1LS42NzUtLjctLjY1LS43LTEuNiAwLS45NS43LTEuN2w3LjktNy45cS4zLS4yNS43MjUtLjQ1dC44NzUtLjJxLjQ1IDAgLjg3NS4ydC43MjUuNDVsNy45NSA4cS43LjY1LjY3NSAxLjYtLjAyNS45NS0uNjc1IDEuNi0uNi42NS0xLjU1LjYyNS0uOTUtLjAyNS0xLjY1LS42NzVsLTQuMS00VjI5cTAgLjktLjYyNSAxLjU3NVEyNSAzMS4yNSAyNCAzMS4yNVpNMTAuMjUgNDIuMnEtMS44IDAtMy4xNzUtMS4zNVE1LjcgMzkuNSA1LjcgMzcuNTVWMzAuNXEwLS45NS42NzUtMS42MjVUOCAyOC4ycTEgMCAxLjYyNS42NzV0LjYyNSAxLjYyNXY3LjFIMzcuN3YtNy4xcTAtLjk1LjY1LTEuNjI1dDEuNi0uNjc1cTEgMCAxLjY1LjY3NS42NS42NzUuNjUgMS42MjV2Ny4xcTAgMS45LTEuNCAzLjI1VDM3LjcgNDIuMloiLz48L3N2Zz4=' }}" />
                    </label>
                    <div class="w-full flex flex-col flex-1 gap-4">
                        <div class="w-full flex flex-wrap justify-between items-center gap-2 border-b border-gray-300">
                            <h2 class="w-max text-lg font-black text-gray-900">General</h2>
                        </div>
                        <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                            <div class="w-full">
                                <label x-ucfirst for="firstName" class="block text-sm font-black text-gray-900 mb-1">First
                                    name</label>
                                <div class="relative">
                                    <input
                                        class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary"
                                        type="text" value="{{ $data->firstName }}" id="firstName"
                                        placeholder="First name" name="firstName" />
                                </div>
                            </div>
                            <div class="w-full">
                                <label x-ucfirst for="lastName" class="block text-sm font-black text-gray-900 mb-1">Last
                                    name</label>
                                <div class="relative">
                                    <input
                                        class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary"
                                        type="text" value="{{ $data->lastName }}" id="lastName" placeholder="Last name"
                                        name="lastName" />
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                            <div class="w-full">
                                <label x-ucfirst for="identity"
                                    class="block text-sm font-black text-gray-900 mb-1">Identity</label>
                                <div class="relative">
                                    <input
                                        class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary"
                                        type="text" value="{{ $data->identity }}" id="identity" placeholder="Identity"
                                        name="identity" />
                                </div>
                            </div>
                            <div class="w-full">
                                <label x-ucfirst for="identityType"
                                    class="block text-sm font-black text-gray-900 mb-1">Identity
                                    type</label>
                                <div class="relative">
                                    <select x-select id="identityType" placeholder="Identity type" name="identityType">
                                        @foreach (System::identities() as $identityType)
                                            <option x-ucfirst value="{{ $identityType }}"
                                                @if ($data->identityType == $identityType) selected @endif>{{ $identityType }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-4 gap-4">
                            <div class="w-full lg:col-span-2">
                                <label x-ucfirst for="birthDate" class="block text-sm font-black text-gray-900 mb-1">Birth
                                    date</label>
                                <div class="relative">
                                    <input x-date
                                        class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary"
                                        value="{{ $data->birthDate }}" id="birthDate" placeholder="Birth date"
                                        name="birthDate" />
                                </div>
                            </div>
                            <div class="w-full">
                                <label x-ucfirst for="gender"
                                    class="block text-sm font-black text-gray-900 mb-1">Gender</label>
                                <div class="relative">
                                    <select x-select id="gender" placeholder="Gender" name="gender">
                                        @foreach (System::genders() as $gender)
                                            <option x-ucfirst value="{{ $gender }}"
                                                @if ($data->gender == $gender) selected @endif>{{ $gender }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="w-full">
                                <label x-ucfirst for="nationality"
                                    class="block text-sm font-black text-gray-900 mb-1">Nationality</label>
                                <div class="relative">
                                    <input
                                        class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary"
                                        value="{{ $data->nationality }}" id="nationality" placeholder="Nationality"
                                        name="nationality" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full flex flex-wrap justify-between items-center gap-2 border-b border-gray-300">
                    <h2 class="w-max text-lg font-black text-gray-900">Contact</h2>
                </div>
                <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                    <div class="w-full">
                        <label x-ucfirst for="email" class="block text-sm font-black text-gray-900 mb-1">Email</label>
                        <div class="relative">
                            <input
                                class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary"
                                value="{{ $data->email }}" id="email" placeholder="Email" name="email"
                                type="email" />
                        </div>
                    </div>
                    <div class="w-full">
                        <label x-ucfirst for="phone" class="block text-sm font-black text-gray-900 mb-1">Phone</label>
                        <div class="relative">
                            <input
                                class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary"
                                value="{{ $data->phone }}" id="phone" placeholder="Phone" name="phone"
                                type="tel" />
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <label x-ucfirst for="address" class="block text-sm font-black text-gray-900 mb-1">Address</label>
                    <input
                        class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary"
                        value="{{ $data->address }}" id="address" placeholder="Address" name="address"
                        type="text" />
                </div>
                <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-3 gap-4">
                    <div class="w-full">
                        <label x-ucfirst for="state" class="block text-sm font-black text-gray-900 mb-1">State</label>
                        <div class="relative">
                            <input x-ucfirst type="text" id="state" name="state" placeholder="State"
                                value="{{ $data->state }}"
                                class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary" />
                        </div>
                    </div>
                    <div class="w-full">
                        <label x-ucfirst for="city" class="block text-sm font-black text-gray-900 mb-1">City</label>
                        <div class="relative">
                            <input x-ucfirst type="text" id="city" name="city" placeholder="City"
                                value="{{ $data->city }}"
                                class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary" />
                        </div>
                    </div>
                    <div class="w-full">
                        <label x-ucfirst for="zipcode" class="block text-sm font-black text-gray-900 mb-1">Zip
                            code</label>
                        <input
                            class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary"
                            value="{{ $data->zipcode }}" id="zipcode" placeholder="Zip code" name="zipcode"
                            type="number" />
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

@section('script')
    <script>
        function preview(event) {
            event.target.nextElementSibling.src = event.target.files[0] ? URL.createObjectURL(event.target.files[0]) :
                "{{ $data->photo ? asset('storage/profile/' . $data->photo) : 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA0OCA0OCIgd2lkdGg9IjIwMCIgaGVpZ2h0PSIyMDAiIGZpbGw9IiMxMTE4MjciPjxwYXRoIGQ9Ik0yNCAzMS4yNXEtMSAwLTEuNjUtLjY3NVEyMS43IDI5LjkgMjEuNyAyOVYxMy40NWwtNC4xIDQuMXEtLjY1LjYtMS41NzUuNjI1LS45MjUuMDI1LTEuNTI1LS42NzUtLjctLjY1LS43LTEuNiAwLS45NS43LTEuN2w3LjktNy45cS4zLS4yNS43MjUtLjQ1dC44NzUtLjJxLjQ1IDAgLjg3NS4ydC43MjUuNDVsNy45NSA4cS43LjY1LjY3NSAxLjYtLjAyNS45NS0uNjc1IDEuNi0uNi42NS0xLjU1LjYyNS0uOTUtLjAyNS0xLjY1LS42NzVsLTQuMS00VjI5cTAgLjktLjYyNSAxLjU3NVEyNSAzMS4yNSAyNCAzMS4yNVpNMTAuMjUgNDIuMnEtMS44IDAtMy4xNzUtMS4zNVE1LjcgMzkuNSA1LjcgMzcuNTVWMzAuNXEwLS45NS42NzUtMS42MjVUOCAyOC4ycTEgMCAxLjYyNS42NzV0LjYyNSAxLjYyNXY3LjFIMzcuN3YtNy4xcTAtLjk1LjY1LTEuNjI1dDEuNi0uNjc1cTEgMCAxLjY1LjY3NS42NS42NzUuNjUgMS42MjV2Ny4xcTAgMS45LTEuNCAzLjI1VDM3LjcgNDIuMloiLz48L3N2Zz4=' }}";
        };
    </script>
@endsection
