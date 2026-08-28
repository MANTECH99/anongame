<?php

namespace Database\Seeders;

use App\Models\AnonymousLink;
use App\Models\Devinette;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use \Illuminate\Database\Console\Seeds\WithoutModelEvents;

    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Admin Sénégal',
            'pseudo' => 'admin221',
            'email' => 'admin@anongame.sn',
            'phone' => '771234567',
            'password' => bcrypt('password'),
        ]);

        AnonymousLink::create([
            'user_id' => $user->id,
            'slug' => 'admin221',
            'title' => 'Admin Sénégal',
            'is_active' => true,
        ]);

        // ---------- Quiz : Culture sénégalaise ----------
        $quiz1 = Quiz::create([
            'user_id' => $user->id,
            'title' => 'Culture sénégalaise',
            'description' => 'Teste ta connaissance de la culture du Sénégal ! 🇸🇳',
            'category' => 'culture',
            'slug' => 'culture-senegalaise-abc123',
            'is_public' => true,
            'plays' => 120,
        ]);

        $q1Data = [
            [
                'question' => 'Quelle est la capitale du Sénégal ?',
                'options' => ['Saint-Louis', 'Dakar', 'Thiès', 'Ziguinchor'],
                'correct' => 1,
            ],
            [
                'question' => 'Quel plat est considéré comme le plat national sénégalais ?',
                'options' => ['Yassa', 'Mafé', 'Thiéboudienne', 'Thiakry'],
                'correct' => 2,
            ],
            [
                'question' => 'Quelle est la langue la plus parlée au Sénégal ?',
                'options' => ['Français', 'Pulaar', 'Wolof', 'Sérère'],
                'correct' => 2,
            ],
            [
                'question' => 'Quelle île est célèbre pour son festival de jazz ?',
                'options' => ['Île de Gorée', 'Île Saint-Louis', 'Île de Ngor', 'Carabane'],
                'correct' => 1,
            ],
            [
                'question' => 'Qui est le premier président du Sénégal ?',
                'options' => ['Abdoulaye Wade', 'Léopold Sédar Senghor', 'Macky Sall', 'Abdou Diouf'],
                'correct' => 1,
            ],
        ];

        foreach ($q1Data as $q) {
            $quiz1->questions()->create([
                'question' => $q['question'],
                'options' => $q['options'],
                'correct_index' => $q['correct'],
                'points' => 10,
            ]);
        }

        // ---------- Quiz : Football Lions ----------
        $quiz2 = Quiz::create([
            'user_id' => $user->id,
            'title' => 'Football : les Lions de la Téranga',
            'description' => 'Les champions d\'Afrique 2022 ! 🦁',
            'category' => 'football',
            'slug' => 'football-lions-teranga-def456',
            'is_public' => true,
            'plays' => 310,
        ]);

        $q2Data = [
            [
                'question' => 'En quelle année le Sénégal a-t-il remporté la CAN ?',
                'options' => ['2019', '2022', '2023', '2017'],
                'correct' => 1,
            ],
            [
                'question' => 'Qui est le capitaine des Lions de la Téranga ?',
                'options' => ['Édouard Mendy', 'Sadio Mané', 'Kalidou Koulibaly', 'Idrissa Gueye'],
                'correct' => 2,
            ],
            [
                'question' => 'Quel club a révélé Sadio Mané en Europe ?',
                'options' => ['Liverpool', 'Southampton', 'RB Salzbourg', 'Metz'],
                'correct' => 2,
            ],
            [
                'question' => 'Qui était le sélectionneur lors du titre de la CAN 2022 ?',
                'options' => ['Aliou Cissé', 'Pape Thiaw', 'Habib Beye', 'Alain Giresse'],
                'correct' => 0,
            ],
        ];

        foreach ($q2Data as $q) {
            $quiz2->questions()->create([
                'question' => $q['question'],
                'options' => $q['options'],
                'correct_index' => $q['correct'],
                'points' => 10,
            ]);
        }

        // ---------- Quiz : Géographie ----------
        $quiz3 = Quiz::create([
            'user_id' => $user->id,
            'title' => 'Géographie du Sénégal',
            'description' => 'Connais-tu bien les régions et fleuves ? 🗺️',
            'category' => 'geographie',
            'slug' => 'geographie-senegal-ghi789',
            'is_public' => true,
            'plays' => 74,
        ]);

        $q3Data = [
            [
                'question' => 'Quel fleuve forme la frontière nord du Sénégal ?',
                'options' => ['Fleuve Gambie', 'Fleuve Sénégal', 'Fleuve Casamance', 'Fleuve Saloum'],
                'correct' => 1,
            ],
            [
                'question' => 'Quel pays est enchâssé dans le territoire sénégalais ?',
                'options' => ['Mali', 'Guinée', 'Gambie', 'Mauritanie'],
                'correct' => 2,
            ],
            [
                'question' => 'Quel lac est célèbre pour sa couleur rose ?',
                'options' => ['Lac de Guiers', 'Lac Rose (Retba)', 'Lac Tamma', 'Lac des Vallées'],
                'correct' => 1,
            ],
        ];

        foreach ($q3Data as $q) {
            $quiz3->questions()->create([
                'question' => $q['question'],
                'options' => $q['options'],
                'correct_index' => $q['correct'],
                'points' => 10,
            ]);
        }

        // ---------- Devinettes ----------
        $devinettes = [
            [
                'title' => 'Le secret du pêcheur',
                'question' => 'Je suis le plat que tout Sénégalais aime. On me prépare avec du riz et du poisson. Qui suis-je ?',
                'answer' => 'thiéboudienne',
                'hint' => 'C\'est le plat national',
                'category' => 'culture',
                'challenges' => 45,
                'successes' => 31,
            ],
            [
                'title' => 'L\'animal de la savane',
                'question' => 'Je suis le roi des animaux et mon nom rappelle le courage. Je suis présent dans le surnom des footballeurs sénégalais. Qui suis-je ?',
                'answer' => 'lion',
                'hint' => 'Roi des animaux',
                'category' => 'general',
                'challenges' => 23,
                'successes' => 19,
            ],
            [
                'title' => 'L\'énigme du lac',
                'question' => 'Je suis un lac célèbre mais pas pour l\'eau bleue. Ma couleur est rose. Où suis-je ?',
                'answer' => 'lac retba',
                'hint' => 'Aussi appelé Lac Rose',
                'category' => 'geographie',
                'challenges' => 12,
                'successes' => 8,
            ],
            [
                'title' => 'Le fruit du baobab',
                'question' => 'Je suis un grand arbre sacré au Sénégal, symbole de la Teranga. Quel arbre suis-je ?',
                'answer' => 'baobab',
                'hint' => 'Très gros tronc',
                'category' => 'culture',
                'challenges' => 30,
                'successes' => 26,
            ],
        ];

        foreach ($devinettes as $d) {
            Devinette::create([
                'user_id' => $user->id,
                'title' => $d['title'],
                'question' => $d['question'],
                'answer' => $d['answer'],
                'hint' => $d['hint'],
                'category' => $d['category'],
                'slug' => Str::slug($d['title']).'-'.Str::random(5),
                'is_public' => true,
                'challenges' => $d['challenges'],
                'successes' => $d['successes'],
            ]);
        }
    }
}
