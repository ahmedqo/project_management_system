@extends('communs.base')
@section('title', 'Edit Review #' . $data->id)

@section('content')
    <div class="w-full bg-white rounded-lg -mt-12 overflow-hidden">
        <div class="p-4 flex items-center justify-between gap-4">
            <h1 class="font-black text-gray-900 text-2xl">
                Edit Review #{{ $data->id }}
            </h1>
        </div>
    </div>

    <div class="grid grid-rows-1 grid-cols-1 gap-4">
        <div class="w-full bg-white p-4 rounded-lg ">
            <form action="{{ route('actions.reviews.update', $data->id) }}" method="POST" class="w-full flex flex-col gap-4">
                @csrf
                <div class="grid grid-rows-1 grid-cols-1 lg:grid-cols-2 gap-4">
                    <div class="w-full">
                        <label x-ucfirst for="employee" class="block text-sm font-black text-gray-900 mb-1">Employee</label>
                        <div class="relative">
                            <select x-select id="employee" placeholder="Employee" name="employee">
                                @foreach ($employees as $employee)
                                    <option x-ucfirst value="{{ $employee->id }}"
                                        @if ($employee->id == $data->employee) selected @endif>
                                        {{ $employee->firstName }} {{ $employee->lastName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="w-full">
                        <label x-ucfirst for="date" class="block text-sm font-black text-gray-900 mb-1">Date</label>
                        <div class="relative">
                            <input x-date type="text" id="date" placeholder="Date" name="date"
                                value="{{ $data->date }}" />
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <label x-ucfirst for="rating" class="block text-sm font-black text-gray-900 mb-1">Rating</label>
                    <div class="relative">
                        <div class="grid grid-rows-1 grid-cols-4 lg:grid-cols-5">
                            <div class="w-full col-span-4 lg:col-span-1"></div>
                            <div
                                class="sticky top-0 z-[1] w-full grid grid-rows-1 grid-cols-4 col-span-4 border border-b-0 border-gray-300 bg-gray-100 rounded-t-md">
                                <div class="w-full px-4 py-1 border-r border-gray-300">
                                    <span
                                        class="block w-full text-center text-xs font-black text-gray-900 uppercase">poor</span>
                                </div>
                                <div class="w-full px-4 py-1 border-r border-gray-300">
                                    <span
                                        class="block w-full text-center text-xs font-black text-gray-900 uppercase">fair</span>
                                </div>
                                <div class="w-full px-4 py-1 border-r border-gray-300">
                                    <span
                                        class="block w-full text-center text-xs font-black text-gray-900 uppercase">good</span>
                                </div>
                                <div class="w-full px-4 py-1">
                                    <span
                                        class="block w-full text-center text-xs font-black text-gray-900 uppercase">excellent</span>
                                </div>
                            </div>
                            <div class="w-full col-span-5 border border-gray-300 rounded-tr-none rounded-md">
                                <div class="grid grid-rows-1 grid-cols-4 lg:grid-cols-5 border-b border-gray-300">
                                    <div
                                        class="w-full col-span-4 lg:col-span-1 px-4 py-2 border-b lg:border-b-0 lg:border-r border-gray-300">
                                        <span x-ucfirst class="text-md text-gray-900">
                                            Work quality
                                        </span>
                                    </div>
                                    <div class="w-full px-4 py-2 flex justify-center border-r border-gray-300">
                                        <label class="relative flex items-center gap-2">
                                            <input type="radio" value="poor" name="work" class="sr-only peer"
                                                @if ($data->work == 'poor') checked @endif />
                                            <div
                                                class="w-12 h-6 cursor-pointer rounded-full bg-gray-50 border border-gray-300 peer peer-focus:border-2 peer-focus:border-primary peer-checked:after:translate-x-full after:border after:border-gray-300 after:content-[''] after:absolute after:top-1/2 after:-translate-y-1/2 after:left-0 after:bg-white after:rounded-full after:h-6 after:w-6 after:shadow-sm after:transition-all peer-checked:bg-primary">
                                            </div>
                                        </label>
                                    </div>
                                    <div class="w-full px-4 py-2 flex justify-center border-r border-gray-300">
                                        <label class="relative flex items-center gap-2">
                                            <input type="radio" value="fair" name="work" class="sr-only peer"
                                                @if ($data->work == 'fair') checked @endif />
                                            <div
                                                class="w-12 h-6 cursor-pointer rounded-full bg-gray-50 border border-gray-300 peer peer-focus:border-2 peer-focus:border-primary peer-checked:after:translate-x-full after:border after:border-gray-300 after:content-[''] after:absolute after:top-1/2 after:-translate-y-1/2 after:left-0 after:bg-white after:rounded-full after:h-6 after:w-6 after:shadow-sm after:transition-all peer-checked:bg-primary">
                                            </div>
                                        </label>
                                    </div>
                                    <div class="w-full px-4 py-2 flex justify-center border-r border-gray-300">
                                        <label class="relative flex items-center gap-2">
                                            <input type="radio" value="good" name="work" class="sr-only peer"
                                                @if ($data->work == 'good') checked @endif />
                                            <div
                                                class="w-12 h-6 cursor-pointer rounded-full bg-gray-50 border border-gray-300 peer peer-focus:border-2 peer-focus:border-primary peer-checked:after:translate-x-full after:border after:border-gray-300 after:content-[''] after:absolute after:top-1/2 after:-translate-y-1/2 after:left-0 after:bg-white after:rounded-full after:h-6 after:w-6 after:shadow-sm after:transition-all peer-checked:bg-primary">
                                            </div>
                                        </label>
                                    </div>
                                    <div class="w-full px-4 py-2 flex justify-center">
                                        <label class="relative flex items-center gap-2">
                                            <input type="radio" value="excellent" name="work" class="sr-only peer"
                                                @if ($data->work == 'excellent') checked @endif />
                                            <div
                                                class="w-12 h-6 cursor-pointer rounded-full bg-gray-50 border border-gray-300 peer peer-focus:border-2 peer-focus:border-primary peer-checked:after:translate-x-full after:border after:border-gray-300 after:content-[''] after:absolute after:top-1/2 after:-translate-y-1/2 after:left-0 after:bg-white after:rounded-full after:h-6 after:w-6 after:shadow-sm after:transition-all peer-checked:bg-primary">
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div
                                    class="grid grid-rows-1 grid-cols-4 lg:grid-cols-5 bg-gray-100 border-b border-gray-300">
                                    <div
                                        class="w-full col-span-4 lg:col-span-1 px-4 py-2 border-b lg:border-b-0 lg:border-r border-gray-300">
                                        <span x-ucfirst class="text-md text-gray-900">
                                            Productivity
                                        </span>
                                    </div>
                                    <div class="w-full px-4 py-2 flex justify-center border-r border-gray-300">
                                        <label class="relative flex items-center gap-2">
                                            <input type="radio" value="poor" name="productivity" class="sr-only peer"
                                                @if ($data->productivity == 'poor') checked @endif />
                                            <div
                                                class="w-12 h-6 cursor-pointer rounded-full bg-gray-50 border border-gray-300 peer peer-focus:border-2 peer-focus:border-primary peer-checked:after:translate-x-full after:border after:border-gray-300 after:content-[''] after:absolute after:top-1/2 after:-translate-y-1/2 after:left-0 after:bg-white after:rounded-full after:h-6 after:w-6 after:shadow-sm after:transition-all peer-checked:bg-primary">
                                            </div>
                                        </label>
                                    </div>
                                    <div class="w-full px-4 py-2 flex justify-center border-r border-gray-300">
                                        <label class="relative flex items-center gap-2">
                                            <input type="radio" value="fair" name="productivity" class="sr-only peer"
                                                @if ($data->productivity == 'fair') checked @endif />
                                            <div
                                                class="w-12 h-6 cursor-pointer rounded-full bg-gray-50 border border-gray-300 peer peer-focus:border-2 peer-focus:border-primary peer-checked:after:translate-x-full after:border after:border-gray-300 after:content-[''] after:absolute after:top-1/2 after:-translate-y-1/2 after:left-0 after:bg-white after:rounded-full after:h-6 after:w-6 after:shadow-sm after:transition-all peer-checked:bg-primary">
                                            </div>
                                        </label>
                                    </div>
                                    <div class="w-full px-4 py-2 flex justify-center border-r border-gray-300">
                                        <label class="relative flex items-center gap-2">
                                            <input type="radio" value="good" name="productivity" class="sr-only peer"
                                                @if ($data->productivity == 'good') checked @endif />
                                            <div
                                                class="w-12 h-6 cursor-pointer rounded-full bg-gray-50 border border-gray-300 peer peer-focus:border-2 peer-focus:border-primary peer-checked:after:translate-x-full after:border after:border-gray-300 after:content-[''] after:absolute after:top-1/2 after:-translate-y-1/2 after:left-0 after:bg-white after:rounded-full after:h-6 after:w-6 after:shadow-sm after:transition-all peer-checked:bg-primary">
                                            </div>
                                        </label>
                                    </div>
                                    <div class="w-full px-4 py-2 flex justify-center">
                                        <label class="relative flex items-center gap-2">
                                            <input type="radio" value="excellent" name="productivity"
                                                class="sr-only peer" @if ($data->productivity == 'excellent') checked @endif />
                                            <div
                                                class="w-12 h-6 cursor-pointer rounded-full bg-gray-50 border border-gray-300 peer peer-focus:border-2 peer-focus:border-primary peer-checked:after:translate-x-full after:border after:border-gray-300 after:content-[''] after:absolute after:top-1/2 after:-translate-y-1/2 after:left-0 after:bg-white after:rounded-full after:h-6 after:w-6 after:shadow-sm after:transition-all peer-checked:bg-primary">
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="grid grid-rows-1 grid-cols-4 lg:grid-cols-5 border-b border-gray-300">
                                    <div
                                        class="w-full col-span-4 lg:col-span-1 px-4 py-2 border-b lg:border-b-0 lg:border-r border-gray-300">
                                        <span x-ucfirst class="text-md text-gray-900">
                                            Communication
                                        </span>
                                    </div>
                                    <div class="w-full px-4 py-2 flex justify-center border-r border-gray-300">
                                        <label class="relative flex items-center gap-2">
                                            <input type="radio" value="poor" name="communication"
                                                class="sr-only peer" @if ($data->communication == 'poor') checked @endif />
                                            <div
                                                class="w-12 h-6 cursor-pointer rounded-full bg-gray-50 border border-gray-300 peer peer-focus:border-2 peer-focus:border-primary peer-checked:after:translate-x-full after:border after:border-gray-300 after:content-[''] after:absolute after:top-1/2 after:-translate-y-1/2 after:left-0 after:bg-white after:rounded-full after:h-6 after:w-6 after:shadow-sm after:transition-all peer-checked:bg-primary">
                                            </div>
                                        </label>
                                    </div>
                                    <div class="w-full px-4 py-2 flex justify-center border-r border-gray-300">
                                        <label class="relative flex items-center gap-2">
                                            <input type="radio" value="fair" name="communication"
                                                class="sr-only peer" @if ($data->communication == 'fair') checked @endif />
                                            <div
                                                class="w-12 h-6 cursor-pointer rounded-full bg-gray-50 border border-gray-300 peer peer-focus:border-2 peer-focus:border-primary peer-checked:after:translate-x-full after:border after:border-gray-300 after:content-[''] after:absolute after:top-1/2 after:-translate-y-1/2 after:left-0 after:bg-white after:rounded-full after:h-6 after:w-6 after:shadow-sm after:transition-all peer-checked:bg-primary">
                                            </div>
                                        </label>
                                    </div>
                                    <div class="w-full px-4 py-2 flex justify-center border-r border-gray-300">
                                        <label class="relative flex items-center gap-2">
                                            <input type="radio" value="good" name="communication"
                                                class="sr-only peer" @if ($data->communication == 'good') checked @endif />
                                            <div
                                                class="w-12 h-6 cursor-pointer rounded-full bg-gray-50 border border-gray-300 peer peer-focus:border-2 peer-focus:border-primary peer-checked:after:translate-x-full after:border after:border-gray-300 after:content-[''] after:absolute after:top-1/2 after:-translate-y-1/2 after:left-0 after:bg-white after:rounded-full after:h-6 after:w-6 after:shadow-sm after:transition-all peer-checked:bg-primary">
                                            </div>
                                        </label>
                                    </div>
                                    <div class="w-full px-4 py-2 flex justify-center">
                                        <label class="relative flex items-center gap-2">
                                            <input type="radio" value="excellent" name="communication"
                                                class="sr-only peer" @if ($data->communication == 'excellent') checked @endif />
                                            <div
                                                class="w-12 h-6 cursor-pointer rounded-full bg-gray-50 border border-gray-300 peer peer-focus:border-2 peer-focus:border-primary peer-checked:after:translate-x-full after:border after:border-gray-300 after:content-[''] after:absolute after:top-1/2 after:-translate-y-1/2 after:left-0 after:bg-white after:rounded-full after:h-6 after:w-6 after:shadow-sm after:transition-all peer-checked:bg-primary">
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div
                                    class="grid grid-rows-1 grid-cols-4 lg:grid-cols-5 bg-gray-100 border-b border-gray-300">
                                    <div
                                        class="w-full col-span-4 lg:col-span-1 px-4 py-2 border-b lg:border-b-0 lg:border-r border-gray-300">
                                        <span x-ucfirst class="text-md text-gray-900">
                                            Collaboration
                                        </span>
                                    </div>
                                    <div class="w-full px-4 py-2 flex justify-center border-r border-gray-300">
                                        <label class="relative flex items-center gap-2">
                                            <input type="radio" value="poor" name="collaboration"
                                                class="sr-only peer" @if ($data->collaboration == 'poor') checked @endif />
                                            <div
                                                class="w-12 h-6 cursor-pointer rounded-full bg-gray-50 border border-gray-300 peer peer-focus:border-2 peer-focus:border-primary peer-checked:after:translate-x-full after:border after:border-gray-300 after:content-[''] after:absolute after:top-1/2 after:-translate-y-1/2 after:left-0 after:bg-white after:rounded-full after:h-6 after:w-6 after:shadow-sm after:transition-all peer-checked:bg-primary">
                                            </div>
                                        </label>
                                    </div>
                                    <div class="w-full px-4 py-2 flex justify-center border-r border-gray-300">
                                        <label class="relative flex items-center gap-2">
                                            <input type="radio" value="fair" name="collaboration"
                                                class="sr-only peer" @if ($data->collaboration == 'fair') checked @endif />
                                            <div
                                                class="w-12 h-6 cursor-pointer rounded-full bg-gray-50 border border-gray-300 peer peer-focus:border-2 peer-focus:border-primary peer-checked:after:translate-x-full after:border after:border-gray-300 after:content-[''] after:absolute after:top-1/2 after:-translate-y-1/2 after:left-0 after:bg-white after:rounded-full after:h-6 after:w-6 after:shadow-sm after:transition-all peer-checked:bg-primary">
                                            </div>
                                        </label>
                                    </div>
                                    <div class="w-full px-4 py-2 flex justify-center border-r border-gray-300">
                                        <label class="relative flex items-center gap-2">
                                            <input type="radio" value="good" name="collaboration"
                                                class="sr-only peer" @if ($data->collaboration == 'good') checked @endif />
                                            <div
                                                class="w-12 h-6 cursor-pointer rounded-full bg-gray-50 border border-gray-300 peer peer-focus:border-2 peer-focus:border-primary peer-checked:after:translate-x-full after:border after:border-gray-300 after:content-[''] after:absolute after:top-1/2 after:-translate-y-1/2 after:left-0 after:bg-white after:rounded-full after:h-6 after:w-6 after:shadow-sm after:transition-all peer-checked:bg-primary">
                                            </div>
                                        </label>
                                    </div>
                                    <div class="w-full px-4 py-2 flex justify-center">
                                        <label class="relative flex items-center gap-2">
                                            <input type="radio" value="excellent" name="collaboration"
                                                class="sr-only peer" @if ($data->collaboration == 'excellent') checked @endif />
                                            <div
                                                class="w-12 h-6 cursor-pointer rounded-full bg-gray-50 border border-gray-300 peer peer-focus:border-2 peer-focus:border-primary peer-checked:after:translate-x-full after:border after:border-gray-300 after:content-[''] after:absolute after:top-1/2 after:-translate-y-1/2 after:left-0 after:bg-white after:rounded-full after:h-6 after:w-6 after:shadow-sm after:transition-all peer-checked:bg-primary">
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="grid grid-rows-1 grid-cols-4 lg:grid-cols-5">
                                    <div
                                        class="w-full col-span-4 lg:col-span-1 px-4 py-2 border-b lg:border-b-0 lg:border-r border-gray-300">
                                        <span x-ucfirst class="text-md text-gray-900">
                                            Punctuality
                                        </span>
                                    </div>
                                    <div class="w-full px-4 py-2 flex justify-center border-r border-gray-300">
                                        <label class="relative flex items-center gap-2">
                                            <input type="radio" value="poor" name="punctuality" class="sr-only peer"
                                                @if ($data->punctuality == 'poor') checked @endif />
                                            <div
                                                class="w-12 h-6 cursor-pointer rounded-full bg-gray-50 border border-gray-300 peer peer-focus:border-2 peer-focus:border-primary peer-checked:after:translate-x-full after:border after:border-gray-300 after:content-[''] after:absolute after:top-1/2 after:-translate-y-1/2 after:left-0 after:bg-white after:rounded-full after:h-6 after:w-6 after:shadow-sm after:transition-all peer-checked:bg-primary">
                                            </div>
                                        </label>
                                    </div>
                                    <div class="w-full px-4 py-2 flex justify-center border-r border-gray-300">
                                        <label class="relative flex items-center gap-2">
                                            <input type="radio" value="fair" name="punctuality" class="sr-only peer"
                                                @if ($data->punctuality == 'fair') checked @endif />
                                            <div
                                                class="w-12 h-6 cursor-pointer rounded-full bg-gray-50 border border-gray-300 peer peer-focus:border-2 peer-focus:border-primary peer-checked:after:translate-x-full after:border after:border-gray-300 after:content-[''] after:absolute after:top-1/2 after:-translate-y-1/2 after:left-0 after:bg-white after:rounded-full after:h-6 after:w-6 after:shadow-sm after:transition-all peer-checked:bg-primary">
                                            </div>
                                        </label>
                                    </div>
                                    <div class="w-full px-4 py-2 flex justify-center border-r border-gray-300">
                                        <label class="relative flex items-center gap-2">
                                            <input type="radio" value="good" name="punctuality" class="sr-only peer"
                                                @if ($data->punctuality == 'good') checked @endif />
                                            <div
                                                class="w-12 h-6 cursor-pointer rounded-full bg-gray-50 border border-gray-300 peer peer-focus:border-2 peer-focus:border-primary peer-checked:after:translate-x-full after:border after:border-gray-300 after:content-[''] after:absolute after:top-1/2 after:-translate-y-1/2 after:left-0 after:bg-white after:rounded-full after:h-6 after:w-6 after:shadow-sm after:transition-all peer-checked:bg-primary">
                                            </div>
                                        </label>
                                    </div>
                                    <div class="w-full px-4 py-2 flex justify-center">
                                        <label class="relative flex items-center gap-2">
                                            <input type="radio" value="excellent" name="punctuality"
                                                class="sr-only peer" @if ($data->punctuality == 'excellent') checked @endif />
                                            <div
                                                class="w-12 h-6 cursor-pointer rounded-full bg-gray-50 border border-gray-300 peer peer-focus:border-2 peer-focus:border-primary peer-checked:after:translate-x-full after:border after:border-gray-300 after:content-[''] after:absolute after:top-1/2 after:-translate-y-1/2 after:left-0 after:bg-white after:rounded-full after:h-6 after:w-6 after:shadow-sm after:transition-all peer-checked:bg-primary">
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
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
