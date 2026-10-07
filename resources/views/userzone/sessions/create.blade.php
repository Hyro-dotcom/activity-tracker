<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-gray-800">New session</h1>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-6">
        <section class="bg-white shadow rounded-lg p-6 space-y-4 text-gray-700">
            {{-- Activity: you see the name, the form sends the id. --}}
            <div>
                <x-breeze.input-label for="activity_id" value="Activity" />
                <select id="activity_id" name="activity_id" class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                    <option value="">Choose an activity</option>
                    @foreach ($activities as $activity)
                        <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Date: the date picker sends YYYY-MM-DD, the format of the date column. --}}
            <div>
                <x-breeze.input-label for="date" value="Date" />
                <x-breeze.text-input id="date" name="date" type="date" class="mt-1 block w-full" />
            </div>

            {{-- Duration in whole minutes, as the duration column stores it. --}}
            <div>
                <x-breeze.input-label for="duration" value="Duration (minutes)" />
                <x-breeze.text-input id="duration" name="duration" type="number" class="mt-1 block w-full" />
            </div>

            {{-- Notes are optional, because the notes column is nullable. --}}
            <div>
                <x-breeze.input-label for="notes" value="Notes (optional)" />
                <textarea id="notes" name="notes" rows="3" class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm"></textarea>
            </div>
        </section>

        <a href="{{ route('sessions.index') }}" class="text-sm text-gray-600 hover:text-gray-900">← Back to my sessions</a>
    </div>
</x-app-layout>