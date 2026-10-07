{{-- My sessions: only the logged-in user's own sessions, newest first. Each line links to its detail page. --}}
<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-gray-800">My sessions</h1>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <a href="{{ route('sessions.create') }}" class="inline-block mb-4 rounded-md bg-gray-800 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700">+ New session</a>
        <section class="bg-white shadow rounded-lg p-6">
            <ul class="divide-y divide-gray-100">
                @forelse ($sessions as $session)
                    <li class="py-2">
                        <a href="{{ route('sessions.show', $session) }}" class="text-gray-700 hover:text-gray-900 hover:underline">
                            {{ $session->activity->name }} · {{ $session->date }} · {{ $session->duration }} min
                        </a>
                    </li>
                @empty
                    <li class="py-2 text-gray-500">You haven't logged any sessions yet.</li>
                @endforelse
            </ul>
        </section>
    </div>
</x-app-layout>