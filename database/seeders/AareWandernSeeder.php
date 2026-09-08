<?php

namespace Database\Seeders;

use App\Models\Poll;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AareWandernSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => bcrypt('password')]
        );

        $poll = Poll::create([
            'user_id' => $user->id,
            'uuid' => (string) Str::uuid(),
            'title' => 'Wandern an der Aare (Tagesausflug)',
            'description' => 'Gemeinsame Tageswanderung entlang der Aare (Route: Solothurn bis Büren an der Aare). Bitte tragt eure Verfügbarkeiten für August und November ein.',
            'location' => 'Aare (Solothurn - Büren)',
            'allow_maybe' => true,
        ]);

        $optionsData = [
            'Sa 08.08.2026',
            'So 16.08.2026',
            'Sa 22.08.2026',
            'Sa 07.11.2026',
            'So 15.11.2026',
            'Sa 21.11.2026',
        ];

        $createdOptions = [];
        foreach ($optionsData as $label) {
            $createdOptions[] = $poll->options()->create([
                'label' => $label,
            ]);
        }

        // 8 participants with responses
        $participantsData = [
            [
                'name' => 'Anna Meier',
                'votes' => ['yes', 'maybe', 'yes', 'yes', 'no', 'yes'],
            ],
            [
                'name' => 'Ben Keller',
                'votes' => ['yes', 'no', 'yes', 'maybe', 'no', 'no'],
            ],
            [
                'name' => 'Clara Schmid',
                'votes' => ['maybe', 'yes', 'yes', 'yes', 'yes', 'maybe'],
            ],
            [
                'name' => 'David Weber',
                'votes' => ['no', 'yes', 'yes', 'yes', 'maybe', 'no'],
            ],
            [
                'name' => 'Elena Fischer',
                'votes' => ['yes', 'maybe', 'yes', 'no', 'yes', 'yes'],
            ],
            [
                'name' => 'Felix Huber',
                'votes' => ['maybe', 'no', 'yes', 'yes', 'no', 'yes'],
            ],
            [
                'name' => 'Gretta Steiner',
                'votes' => ['yes', 'yes', 'yes', 'yes', 'maybe', 'no'],
            ],
            [
                'name' => 'Hans Brunner',
                'votes' => ['no', 'maybe', 'maybe', 'yes', 'yes', 'maybe'],
            ],
        ];

        foreach ($participantsData as $pData) {
            $participant = $poll->participants()->create([
                'name' => $pData['name'],
                'edit_token' => (string) Str::uuid(),
            ]);

            foreach ($pData['votes'] as $index => $response) {
                $participant->votes()->create([
                    'poll_option_id' => $createdOptions[$index]->id,
                    'response' => $response,
                ]);
            }
        }
    }
}
