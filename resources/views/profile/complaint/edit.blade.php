@extends('communs.base')
@section('title', 'Edit Complaint #' . $data->id)

@section('content')
    <div class="w-full bg-white rounded-lg -mt-12 overflow-hidden">
        <div class="p-4 flex items-center justify-between gap-4">
            <h1 class="font-black text-gray-900 text-2xl">
                Edit Complaint #{{ $data->id }}
            </h1>
        </div>
        @include('profile.navigation')
    </div>

    <div class="grid grid-rows-1 grid-cols-1 gap-4">
        <div class="w-full bg-white p-4 rounded-lg ">
            <form action="{{ route('actions.profile.complaints.update', $data->id) }}" method="POST"
                class="w-full flex flex-col gap-4">
                @csrf
                <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                    <div class="w-full">
                        <label x-ucfirst for="grievance"
                            class="block text-sm font-black text-gray-900 mb-1">Grievance</label>
                        <div class="relative">
                            <select x-select id="grievance" placeholder="Grievance" name="grievance">
                                <option x-ucfirst value="benefit denial" @if ($data->grievance == 'benefit denial') selected @endif>
                                    Benefit
                                    denial</option>
                                <option x-ucfirst value="bullying" @if ($data->grievance == 'bullying') selected @endif>
                                    Bullying</option>
                                <option x-ucfirst value="classification" @if ($data->grievance == 'classification') selected @endif>
                                    Classification</option>
                                <option x-ucfirst value="demotion" @if ($data->grievance == 'demotion') selected @endif>
                                    Demotion</option>
                                <option x-ucfirst value="discipline" @if ($data->grievance == 'discipline') selected @endif>
                                    Discipline
                                </option>
                                <option x-ucfirst value="discrimination" @if ($data->grievance == 'discrimination') selected @endif>
                                    Discrimination</option>
                                <option x-ucfirst value="harassment" @if ($data->grievance == 'harassment') selected @endif>
                                    Harassment
                                </option>
                                <option x-ucfirst value="safety" @if ($data->grievance == 'safety') selected @endif>Safety
                                </option>
                                <option x-ucfirst value="workload" @if ($data->grievance == 'workload') selected @endif>Kenitra
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="w-full">
                        <label x-ucfirst for="location" class="block text-sm font-black text-gray-900 mb-1">Incident
                            location</label>
                        <div class="relative">
                            <input id="location" type="text" placeholder="Incident location" name="location"
                                value="{{ $data->location }}"
                                class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary" />
                        </div>
                    </div>
                </div>
                <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                    <div class="w-full">
                        <label x-ucfirst for="time" class="block text-sm font-black text-gray-900 mb-1">Incident
                            time</label>
                        <div class="relative">
                            <input id="time" type="text" placeholder="Incident time" name="time"
                                value="{{ $data->time }}"
                                class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary" />
                        </div>
                    </div>
                    <div class="w-full">
                        <label x-ucfirst for="date" class="block text-sm font-black text-gray-900 mb-1">Incident
                            date</label>
                        <div class="relative">
                            <input x-date id="date" type="text" placeholder="Incident date" name="date"
                                value="{{ $data->date }}"
                                class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-md block w-full p-2 focus:outline-1 outline-primary" />
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
