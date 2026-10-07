{{-- One session in detail. Only its owner gets here: show() checks that first. --}}
<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-gray-800">{{ $session->activity->name }}</h1>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-6">
        <section class="bg-white shadow rounded-lg p-6 space-y-2 text-gray-700">
            <p><span class="font-semibold">Date:</span> {{ $session->date }}</p>
            <p><span class="font-semibold">Duration:</span> {{ $session->duration }} min</p>
            <p><span class="font-semibold">Notes:</span> {{ $session->notes ?? 'No notes.' }}</p>
        </section>

        <a href="{{ route('sessions.index') }}" class="text-sm text-gray-600 hover:text-gray-900">← Back to my sessions</a>
    </div>
</x-app-layout>