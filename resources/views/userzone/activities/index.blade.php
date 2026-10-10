{{-- Activities: the shared list of all activities, sorted by name. Every logged-in user sees the same list. --}}
<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-gray-800">Activities</h1>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <section class="bg-white shadow rounded-lg p-6">
            <ul class="divide-y divide-gray-100">
                @forelse ($activities as $activity)
                    <li class="py-2">
                        <p class="font-semibold text-gray-800">{{ $activity->name }}</p>
                        {{-- The description is optional, so an empty one gets a short text instead. --}}
                        <p class="text-sm text-gray-600">{{ $activity->description ?? 'No description.' }}</p>
                    </li>
                @empty
                    <li class="py-2 text-gray-500">No activities yet.</li>
                @endforelse
            </ul>
        </section>
    </div>
</x-app-layout>