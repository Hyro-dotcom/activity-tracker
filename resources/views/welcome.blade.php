{{-- Homepage: a short introduction and the most recent sessions. No names, because this page is public. --}}
<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-gray-800">Activity Tracker</h1>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-6">
        @auth
            <p class="text-gray-700">Welcome back, {{ auth()->user()->name }}!</p>
        @endauth

        <p class="text-gray-700">Log your training sessions and see what has been happening recently.</p>

        <section class="bg-white shadow rounded-lg p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Recent sessions in the community</h2>

            <ul class="divide-y divide-gray-100">
                @forelse ($recentSessions as $session)
                    <li class="py-2 text-gray-700">
                        {{ $session->activity->name }} · {{ $session->date }} · {{ $session->duration }} min
                    </li>
                @empty
                    <li class="py-2 text-gray-500">No sessions yet.</li>
                @endforelse
            </ul>
        </section>
    </div>
</x-app-layout>