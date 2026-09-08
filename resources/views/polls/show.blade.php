<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $poll->title }} - Terminli</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased p-6">
    <div class="max-w-5xl mx-auto bg-white rounded-lg shadow-md p-8">
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="text-3xl font-bold mb-2">{{ $poll->title }}</h1>
        @if($poll->description)
            <p class="text-gray-600 mb-8">{{ $poll->description }}</p>
        @endif

        @php
            $currentEditToken = request('edit_token') ?? session('edit_token');
            $editingParticipant = $currentEditToken ? $poll->participants->firstWhere('edit_token', $currentEditToken) : null;

            $maxYes = 0;
            $totals = [];
            foreach ($poll->options as $option) {
                $yesCount = $poll->participants->sum(function($p) use ($option) {
                    $v = $p->votes->firstWhere('poll_option_id', $option->id);
                    return ($v && $v->response === 'yes') ? 1 : 0;
                });
                $maybeCount = $poll->participants->sum(function($p) use ($option) {
                    $v = $p->votes->firstWhere('poll_option_id', $option->id);
                    return ($v && $v->response === 'maybe') ? 1 : 0;
                });
                $noCount = $poll->participants->sum(function($p) use ($option) {
                    $v = $p->votes->firstWhere('poll_option_id', $option->id);
                    return ($v && $v->response === 'no') ? 1 : 0;
                });

                $totals[$option->id] = [
                    'yes' => $yesCount,
                    'maybe' => $maybeCount,
                    'no' => $noCount
                ];

                if ($yesCount > $maxYes) {
                    $maxYes = $yesCount;
                }
            }

            $bestOptions = $poll->options->filter(function($option) use ($totals, $maxYes) {
                return $maxYes > 0 && $totals[$option->id]['yes'] === $maxYes;
            });
        @endphp

        @if($poll->participants->count() > 0 && $maxYes > 0)
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center justify-between flex-wrap gap-3">
                <div class="flex items-center gap-3">
                    <span class="text-2xl">🏆</span>
                    <div>
                        <h3 class="text-xs uppercase tracking-wider font-extrabold text-emerald-800">Beste Übereinstimmung:</h3>
                        <div class="flex flex-wrap gap-2 mt-1.5">
                            @foreach($bestOptions as $bOpt)
                                <span class="inline-flex items-center px-3 py-1 bg-emerald-600 text-white text-xs font-extrabold rounded-lg shadow-sm">
                                    {{ $bOpt->label }} — {{ $totals[$bOpt->id]['yes'] }} von {{ $poll->participants->count() }} Zusagen @if($totals[$bOpt->id]['maybe'] > 0)<span class="ml-1 text-emerald-200">({{ $totals[$bOpt->id]['maybe'] }} evtl.)</span>@endif
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="text-xs font-bold text-emerald-700 bg-emerald-100/80 px-3 py-1.5 rounded-lg border border-emerald-200">
                    {{ $poll->participants->count() }} Personen haben abgestimmt
                </div>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="p-3 border-b-2 border-gray-200">Teilnehmer</th>
                        @foreach($poll->options as $option)
                            <th class="p-3 border-b-2 border-gray-200 text-center @if($maxYes > 0 && $totals[$option->id]['yes'] === $maxYes) bg-green-50 text-green-900 font-bold @endif">
                                {{ $option->label }}
                            </th>
                        @endforeach
                        <th class="p-3 border-b-2 border-gray-200 text-center w-24">Aktion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($poll->participants as $participant)
                        <tr class="hover:bg-gray-50 @if($editingParticipant && $editingParticipant->id === $participant->id) bg-yellow-50 @endif">
                            <td class="p-3 border-b border-gray-200 font-semibold">
                                {{ $participant->name }}
                                @if($editingParticipant && $editingParticipant->id === $participant->id)
                                    <span class="text-xs bg-yellow-200 text-yellow-800 px-2 py-0.5 rounded ml-2">Du</span>
                                @endif
                            </td>
                            @foreach($poll->options as $option)
                                @php
                                    $vote = $participant->votes->firstWhere('poll_option_id', $option->id);
                                @endphp
                                <td class="p-3 border-b border-gray-200 text-center @if($maxYes > 0 && $totals[$option->id]['yes'] === $maxYes) bg-green-50/50 @endif">
                                    @if($vote && $vote->response === 'yes')
                                        <span class="text-green-600 font-bold text-lg">✓</span>
                                    @elseif($vote && $vote->response === 'no')
                                        <span class="text-red-500 font-bold text-lg">✗</span>
                                    @elseif($vote && $vote->response === 'maybe')
                                        <span class="text-yellow-600 font-bold text-lg">(✓)</span>
                                    @else
                                        <span class="text-gray-300">-</span>
                                    @endif
                                </td>
                            @endforeach
                            <td class="p-3 border-b border-gray-200 text-center">
                                @if($participant->edit_token)
                                    <a href="{{ route('polls.show', ['uuid' => $poll->uuid, 'edit_token' => $participant->edit_token]) }}" class="text-xs text-blue-600 hover:underline">Bearbeiten</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    <!-- Total Tally Row -->
                    <tr class="bg-gray-100 font-bold">
                        <td class="p-3 border-t-2 border-b-2 border-gray-300">Ergebnis (Ja / Vielleicht)</td>
                        @foreach($poll->options as $option)
                            <td class="p-3 border-t-2 border-b-2 border-gray-300 text-center @if($maxYes > 0 && $totals[$option->id]['yes'] === $maxYes) bg-green-100 text-green-900 @endif">
                                <span class="text-green-700">✓ {{ $totals[$option->id]['yes'] }}</span>
                                @if($totals[$option->id]['maybe'] > 0)
                                    <span class="text-yellow-700 text-xs ml-1">({{ $totals[$option->id]['maybe'] }})</span>
                                @endif
                            </td>
                        @endforeach
                        <td class="p-3 border-t-2 border-b-2 border-gray-300"></td>
                    </tr>

                    <!-- Vote Form Row (Create or Update) -->
                    <tr class="bg-blue-50">
                        <form action="{{ $editingParticipant ? route('polls.vote.update', ['uuid' => $poll->uuid, 'edit_token' => $editingParticipant->edit_token]) : route('polls.vote', $poll->uuid) }}" method="POST">
                            @csrf
                            <td class="p-3 border-b border-gray-200">
                                <input type="text" name="name" required value="{{ old('name', $editingParticipant->name ?? '') }}" placeholder="Dein Name" class="border rounded px-2 py-1 w-full text-sm">
                            </td>
                            @foreach($poll->options as $option)
                                @php
                                    $existingVote = $editingParticipant ? $editingParticipant->votes->firstWhere('poll_option_id', $option->id) : null;
                                    $selectedResponse = old("votes.{$option->id}", $existingVote->response ?? 'yes');
                                @endphp
                                <td class="p-3 border-b border-gray-200 text-center">
                                    <select name="votes[{{ $option->id }}]" class="border rounded px-2 py-1 text-sm bg-white">
                                        <option value="yes" @selected($selectedResponse === 'yes')>Ja</option>
                                        <option value="no" @selected($selectedResponse === 'no')>Nein</option>
                                        <option value="maybe" @selected($selectedResponse === 'maybe')>Vielleicht</option>
                                    </select>
                                </td>
                            @endforeach
                            <td class="p-3 border-b border-gray-200 text-center">
                                <button type="submit" class="bg-blue-600 text-white px-3 py-1 text-sm rounded hover:bg-blue-700 shadow">
                                    {{ $editingParticipant ? 'Aktualisieren' : 'Speichern' }}
                                </button>
                                @if($editingParticipant)
                                    <a href="{{ route('polls.show', $poll->uuid) }}" class="block text-xs text-gray-500 hover:underline mt-1">Abbrechen</a>
                                @endif
                            </td>
                        </form>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="mt-8 text-sm text-gray-500">
            Link zum Teilen: <a href="{{ route('polls.show', $poll->uuid) }}" class="text-blue-500 underline">{{ route('polls.show', $poll->uuid) }}</a>
        </div>
    </div>
</body>
</html>
