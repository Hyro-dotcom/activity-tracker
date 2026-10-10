{{-- New activity: the form for adding an activity. It sends its fields to store() with POST. --}}
<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-gray-800">New activity</h1>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-6">
        <form method="POST" action="{{ route('activities.store') }}" class="bg-white shadow rounded-lg p-6 space-y-4 text-gray-700">
            @csrf

            {{-- Name: the field's name is the column's name, so store() can validate and save it directly. --}}
            <div>
                <x-breeze.input-label for="name" value="Name" />
                <x-breeze.text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" />
                <x-breeze.input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            {{-- Description is optional, because the description column is nullable. --}}
            <div>
                <x-breeze.input-label for="description" value="Description (optional)" />
                <textarea id="description" name="description" rows="3" class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">{{ old('description') }}</textarea>
                <x-breeze.input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <x-breeze.primary-button>Save activity</x-breeze.primary-button>
        </form>

        <a href="{{ route('activities.index') }}" class="text-sm text-gray-600 hover:text-gray-900">← Back to activities</a>
    </div>
</x-app-layout>