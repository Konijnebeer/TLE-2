<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-4">Antwoorden voor: {{ $part->name }}</h1>
        <p class="mb-4 text-gray-600">Onderdeel van quest: <span class="font-semibold">{{ $part->quest->name }}</span></p>

        @if($answers->isEmpty())
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded mb-6">
                <span class="text-yellow-700">Er zijn nog geen antwoorden ingeleverd voor dit onderdeel.</span>
            </div>
        @else
            <div class="bg-white shadow rounded-lg p-4">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Leerling</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Antwoord</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Datum</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($answers as $answer)
                            <tr>
                                <td class="px-4 py-2">{{ $answer->user->name }}</td>
                                <td class="px-4 py-2">{{ $answer->answer_text }}</td>
                                <td class="px-4 py-2 text-xs text-gray-500">{{ $answer->created_at->format('d-m-Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="mt-8">
            <a href="{{ url()->previous() }}" class="text-gray-600 hover:underline">← Terug</a>
        </div>
    </div>
</x-app-layout>

