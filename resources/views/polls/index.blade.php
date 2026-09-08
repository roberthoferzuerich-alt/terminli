<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Meine Umfragen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold">Deine erstellten Umfragen</h3>
                        <a href="{{ route('polls.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            + Neue Umfrage erstellen
                        </a>
                    </div>
                    
                    @if($polls->isEmpty())
                        <div class="p-4 bg-gray-50 border border-gray-200 rounded text-center">
                            <p class="text-gray-500 mb-4">Du hast noch keine Umfragen erstellt.</p>
                        </div>
                    @else
                        <ul class="divide-y divide-gray-200 border-t border-b border-gray-200">
                            @foreach($polls as $poll)
                                <li class="py-4 flex justify-between items-center">
                                    <div>
                                        <h3 class="text-lg font-bold">{{ $poll->title }}</h3>
                                    </div>
                                    <div>
                                        <a href="{{ route('polls.show', $poll->uuid) }}" class="text-blue-600 hover:underline border border-blue-600 px-3 py-1 rounded">
                                            Ansehen
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
