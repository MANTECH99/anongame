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

        // ---------- Quiz : Culture générale ----------
        $quiz4 = Quiz::create([
            'user_id' => $user->id,
            'title' => 'Culture générale mondiale',
            'description' => 'Un peu de tout pour tester ta culture ! 🌍',
            'category' => 'general',
            'slug' => 'culture-generale-monde-jkl012',
            'is_public' => true,
            'plays' => 205,
        ]);

        $q4Data = [
            [
                'question' => 'Combien y a-t-il de continents sur Terre ?',
                'options' => ['5', '6', '7', '8'],
                'correct' => 2,
            ],
            [
                'question' => 'Quel est le plus grand océan du monde ?',
                'options' => ['Atlantique', 'Pacifique', 'Indien', 'Arctique'],
                'correct' => 1,
            ],
            [
                'question' => 'Quelle planète est surnommée la planète rouge ?',
                'options' => ['Vénus', 'Jupiter', 'Mars', 'Saturne'],
                'correct' => 2,
            ],
            [
                'question' => 'Combien de couleurs y a-t-il dans un arc-en-ciel ?',
                'options' => ['5', '6', '7', '8'],
                'correct' => 2,
            ],
            [
                'question' => 'Quel animal est le plus grand du monde ?',
                'options' => ['Éléphant', 'Baleine bleue', 'Girafe', 'Requin blanc'],
                'correct' => 1,
            ],
        ];

        foreach ($q4Data as $q) {
            $quiz4->questions()->create([
                'question' => $q['question'],
                'options' => $q['options'],
                'correct_index' => $q['correct'],
                'points' => 10,
            ]);
        }

        // ---------- Quiz : Science & Nature ----------
        $quiz5 = Quiz::create([
            'user_id' => $user->id,
            'title' => 'Science et nature',
            'description' => 'Les mystères de la science à ta portée ! 🔬',
            'category' => 'science',
            'slug' => 'science-nature-abcxyz',
            'is_public' => true,
            'plays' => 98,
        ]);

        $q5Data = [
            [
                'question' => 'Quel gaz les plantes absorbent-elles pour la photosynthèse ?',
                'options' => ['Oxygène', 'Azote', 'Dioxyde de carbone', 'Hydrogène'],
                'correct' => 2,
            ],
            [
                'question' => 'Combien de planètes font partie du système solaire (hors Pluton) ?',
                'options' => ['7', '8', '9', '10'],
                'correct' => 1,
            ],
            [
                'question' => 'Quel est le symbole chimique de l\'eau ?',
                'options' => ['O2', 'H2O', 'CO2', 'NaCl'],
                'correct' => 1,
            ],
            [
                'question' => 'Quelle est la vitesse de la lumière ?',
                'options' => ['300 000 km/s', '150 000 km/s', '1 million km/s', '30 000 km/s'],
                'correct' => 0,
            ],
        ];

        foreach ($q5Data as $q) {
            $quiz5->questions()->create([
                'question' => $q['question'],
                'options' => $q['options'],
                'correct_index' => $q['correct'],
                'points' => 10,
            ]);
        }

        // ---------- Quiz : Histoire africaine ----------
        $quiz6 = Quiz::create([
            'user_id' => $user->id,
            'title' => 'Histoire de l\'Afrique',
            'description' => 'Les grands moments de l\'histoire africaine ! 📜',
            'category' => 'histoire',
            'slug' => 'histoire-afrique-xyz987',
            'is_public' => true,
            'plays' => 150,
        ]);

        $q6Data = [
            [
                'question' => 'Quelle ancienne civilisation africaine a bâti les pyramides de Gizeh ?',
                'options' => ['Nubie', 'Égypte', 'Axoum', 'Mali'],
                'correct' => 1,
            ],
            [
                'question' => 'Qui est le célèbre empereur de l\'empire du Mali connu pour son pèlerinage à La Mecque ?',
                'options' => ['Soundiata Keïta', 'Mansa Moussa', 'Askia Mohammed', 'Sundiata'],
                'correct' => 1,
            ],
            [
                'question' => 'Quel est l\'ancien nom de la ville de Bobo-Dioulasso ?',
                'options' => ['Sylla', 'Kong', 'Sya', 'Wagadougou'],
                'correct' => 2,
            ],
        ];

        foreach ($q6Data as $q) {
            $quiz6->questions()->create([
                'question' => $q['question'],
                'options' => $q['options'],
                'correct_index' => $q['correct'],
                'points' => 10,
            ]);
        }

        // ---------- Quiz : Sport ----------
        $quiz7 = Quiz::create([
            'user_id' => $user->id,
            'title' => 'Sport : le monde',
            'description' => 'Teste tes connaissances sportives ! ⚽',
            'category' => 'sport',
            'slug' => 'sport-monde-451abc',
            'is_public' => true,
            'plays' => 88,
        ]);

        $q7Data = [
            ['question' => 'Quel pays a remporté la Coupe du Monde 2018 ?', 'options' => ['Brésil', 'Allemagne', 'France', 'Argentine'], 'correct' => 2],
            ['question' => 'Combien de joueurs y a-t-il dans une équipe de football sur le terrain ?', 'options' => ['10', '11', '12', '9'], 'correct' => 1],
            ['question' => 'Dans quel sport utilise-t-on une raquette et un volant ?', 'options' => ['Tennis', 'Badminton', 'Squash', 'Padel'], 'correct' => 1],
            ['question' => 'Qui est surnommé le GOAT au basketball ?', 'options' => ['LeBron James', 'Michael Jordan', 'Kobe Bryant', 'Shaquille O\'Neal'], 'correct' => 1],
        ];

        foreach ($q7Data as $q) {
            $quiz7->questions()->create([
                'question' => $q['question'],
                'options' => $q['options'],
                'correct_index' => $q['correct'],
                'points' => 10,
            ]);
        }

        // ---------- Quiz : Musique africaine ----------
        $quiz8 = Quiz::create([
            'user_id' => $user->id,
            'title' => 'Musique africaine',
            'description' => 'Les grands noms de la musique africaine ! 🎵',
            'category' => 'musique',
            'slug' => 'musique-africaine-862def',
            'is_public' => true,
            'plays' => 130,
        ]);

        $q8Data = [
            ['question' => 'Quel chanteur sénégalais est surnommé le « Roi du Mbalax » ?', 'options' => ['Ismaël Lô', 'Youssou N\'Dour', 'Baaba Maal', 'Cheikh Lô'], 'correct' => 1],
            ['question' => 'De quel pays vient l\'artiste Sarkodie ?', 'options' => ['Nigeria', 'Ghana', 'Sénégal', 'Côte d\'Ivoire'], 'correct' => 1],
            ['question' => 'Quelle artiste nigériane est connue sous le nom de « Queen of Afrobeats » ?', 'options' => ['Wizkid', 'Davido', 'Yemi Alade', 'Tiwa Savage'], 'correct' => 3],
            ['question' => 'Quel instrument est un tambour traditionnel africain ?', 'options' => ['Kora', 'Balafon', 'Djembe', 'Cora'], 'correct' => 2],
        ];

        foreach ($q8Data as $q) {
            $quiz8->questions()->create([
                'question' => $q['question'],
                'options' => $q['options'],
                'correct_index' => $q['correct'],
                'points' => 10,
            ]);
        }

        // ---------- Quiz : Informatique ----------
        $quiz9 = Quiz::create([
            'user_id' => $user->id,
            'title' => 'Informatique et Internet',
            'description' => 'Le monde du numérique ! 💻',
            'category' => 'informatique',
            'slug' => 'informatique-internet-773ghi',
            'is_public' => true,
            'plays' => 75,
        ]);

        $q9Data = [
            ['question' => 'Que signifie « WWW » ?', 'options' => ['World Web Wide', 'World Wide Web', 'Web World Wide', 'Wide Web World'], 'correct' => 1],
            ['question' => 'Quel est le langage de programmation créé par Rasmus Lerdorf ?', 'options' => ['JavaScript', 'Python', 'PHP', 'Java'], 'correct' => 2],
            ['question' => 'Quelle entreprise a créé le système d\'exploitation Windows ?', 'options' => ['Apple', 'Microsoft', 'Google', 'IBM'], 'correct' => 1],
            ['question' => 'Que signifie l\'acronyme « HTML » ?', 'options' => ['HyperText Markup Language', 'Home Tool Markup Language', 'Hyperlink Text Model Language', 'High Tech Modern Language'], 'correct' => 0],
        ];

        foreach ($q9Data as $q) {
            $quiz9->questions()->create([
                'question' => $q['question'],
                'options' => $q['options'],
                'correct_index' => $q['correct'],
                'points' => 10,
            ]);
        }

        // ---------- Quiz : Géographie du monde ----------
        $quiz10 = Quiz::create([
            'user_id' => $user->id,
            'title' => 'Géographie du monde',
            'description' => 'Les merveilles de la planète ! 🌎',
            'category' => 'geographie',
            'slug' => 'geographie-monde-684jkl',
            'is_public' => true,
            'plays' => 95,
        ]);

        $q10Data = [
            ['question' => 'Quel est le plus long fleuve du monde ?', 'options' => ['Amazon', 'Nil', 'Yangtsé', 'Mississippi'], 'correct' => 0],
            ['question' => 'Quel est le plus grand désert du monde (hors pôles) ?', 'options' => ['Gobi', 'Sahara', 'Kalahari', 'Atacama'], 'correct' => 1],
            ['question' => 'Quel est le plus haut sommet du monde ?', 'options' => ['K2', 'Mont Everest', 'Kangchenjunga', 'Mont Blanc'], 'correct' => 1],
            ['question' => 'Combien de pays font partie de l\'Union africaine ?', 'options' => ['50', '54', '55', '57'], 'correct' => 2],
        ];

        foreach ($q10Data as $q) {
            $quiz10->questions()->create([
                'question' => $q['question'],
                'options' => $q['options'],
                'correct_index' => $q['correct'],
                'points' => 10,
            ]);
        }

        // ---------- Quiz : Cinéma ----------
        $quiz11 = Quiz::create([
            'user_id' => $user->id,
            'title' => 'Cinéma et séries',
            'description' => 'À toi de jouer ! 🎬',
            'category' => 'cinema',
            'slug' => 'cinema-series-595mno',
            'is_public' => true,
            'plays' => 110,
        ]);

        $q11Data = [
            ['question' => 'Qui joue Iron Man dans le MCU ?', 'options' => ['Chris Evans', 'Robert Downey Jr', 'Chris Hemsworth', 'Mark Ruffalo'], 'correct' => 1],
            ['question' => 'Quel film est célèbre pour la phrase « May the Force be with you » ?', 'options' => ['Star Wars', 'Star Trek', 'Avatar', 'Interstellar'], 'correct' => 0],
            ['question' => 'Dans quelle ville se déroule la série « Lupin » ?', 'options' => ['Londres', 'Paris', 'Rome', 'New York'], 'correct' => 1],
            ['question' => 'Quel dessin animé met en scène un garçon ninja ?', 'options' => ['Dragon Ball', 'Naruto', 'One Piece', 'Bleach'], 'correct' => 1],
        ];

        foreach ($q11Data as $q) {
            $quiz11->questions()->create([
                'question' => $q['question'],
                'options' => $q['options'],
                'correct_index' => $q['correct'],
                'points' => 10,
            ]);
        }

        // ---------- Quiz : Cuisine ----------
        $quiz12 = Quiz::create([
            'user_id' => $user->id,
            'title' => 'Cuisine du monde',
            'description' => 'Les saveurs de la planète ! 🍽️',
            'category' => 'cuisine',
            'slug' => 'cuisine-monde-406pqr',
            'is_public' => true,
            'plays' => 64,
        ]);

        $q12Data = [
            ['question' => 'Dans quel pays est née la pizza ?', 'options' => ['France', 'Espagne', 'Italie', 'Grèce'], 'correct' => 2],
            ['question' => 'Quel plat japonais se compose de riz vinaigré et de poisson cru ?', 'options' => ['Ramen', 'Sushi', 'Tempura', 'Udon'], 'correct' => 1],
            ['question' => 'Quel est le plat typique du Sénégal à base de mil ?', 'options' => ['Thiéboudienne', 'Thiakry', 'Yassa', 'Mafé'], 'correct' => 1],
            ['question' => 'Quelle épice donne la couleur jaune au curry ?', 'options' => ['Paprika', 'Curcuma', 'Safran', 'Cumin'], 'correct' => 1],
        ];

        foreach ($q12Data as $q) {
            $quiz12->questions()->create([
                'question' => $q['question'],
                'options' => $q['options'],
                'correct_index' => $q['correct'],
                'points' => 10,
            ]);
        }

        // ---------- Quiz : Science-fiction ----------
        $quiz13 = Quiz::create([
            'user_id' => $user->id,
            'title' => 'Science-fiction et imaginaire',
            'description' => 'L\'univers de l\'imaginaire ! 🚀',
            'category' => 'general',
            'slug' => 'science-fiction-317stu',
            'is_public' => true,
            'plays' => 70,
        ]);

        $q13Data = [
            ['question' => 'Quel vaisseau a emmené le premier homme sur la Lune ?', 'options' => ['Apollo 11', 'Apollo 13', 'Discovery', 'Columbus'], 'correct' => 0],
            ['question' => 'Qui a écrit « Le Petit Prince » ?', 'options' => ['Victor Hugo', 'Antoine de Saint-Exupéry', 'Jules Verne', 'Albert Camus'], 'correct' => 1],
            ['question' => 'Dans « Harry Potter », quelle école apprend-on la magie ?', 'options' => ['Hogwarts', 'Beauxbatons', 'Durmstrang', 'Poudlard'], 'correct' => 3],
            ['question' => 'Quel héros porte un costume bleu et une cape rouge ?', 'options' => ['Batman', 'Superman', 'Spiderman', 'Flash'], 'correct' => 1],
        ];

        foreach ($q13Data as $q) {
            $quiz13->questions()->create([
                'question' => $q['question'],
                'options' => $q['options'],
                'correct_index' => $q['correct'],
                'points' => 10,
            ]);
        }

        // ---------- Quiz : Sénégal hauts lieux ----------
        $quiz14 = Quiz::create([
            'user_id' => $user->id,
            'title' => 'Sénégal : les hauts lieux',
            'description' => 'Explore le Sénégal ! 🗺️',
            'category' => 'geographie',
            'slug' => 'senegal-hauts-lieux-228vwx',
            'is_public' => true,
            'plays' => 58,
        ]);

        $q14Data = [
            ['question' => 'Où se trouve la célèbre Mosquée de la Divinité (Touba) ?', 'options' => ['Touba', 'Dakar', 'Saint-Louis', 'Kaolack'], 'correct' => 0],
            ['question' => 'Quelle ville est surnommée « la Perle de la Casamance » ?', 'options' => ['Ziguinchor', 'Kolda', 'Bignona', 'Oussouye'], 'correct' => 0],
            ['question' => 'Quel est le plus grand port du Sénégal ?', 'options' => ['Port de Saint-Louis', 'Port de Dakar', 'Port de Ziguinchor', 'Port de Kaolack'], 'correct' => 1],
            ['question' => 'Quelle réserve abrite le delta du Saloum ?', 'options' => ['Réserve de Bandia', 'Parc du Niokolo-Koba', 'Réserve du Saloum', 'Réserve de Fathala'], 'correct' => 2],
        ];

        foreach ($q14Data as $q) {
            $quiz14->questions()->create([
                'question' => $q['question'],
                'options' => $q['options'],
                'correct_index' => $q['correct'],
                'points' => 10,
            ]);
        }

        // ---------- Quiz : Économie ----------
        $quiz15 = Quiz::create([
            'user_id' => $user->id,
            'title' => 'Économie et argent',
            'description' => 'Le monde des finances ! 💰',
            'category' => 'economie',
            'slug' => 'economie-argent-139yzab',
            'is_public' => true,
            'plays' => 40,
        ]);

        $q15Data = [
            ['question' => 'Quelle est la monnaie de l\'Union économique ouest-africaine (UEMOA) ?', 'options' => ['Naira', 'Franc CFA', 'Cedi', 'Dirham'], 'correct' => 1],
            ['question' => 'Quel est le plus grand centre financier du monde ?', 'options' => ['Londres', 'New York', 'Tokyo', 'Hong Kong'], 'correct' => 1],
            ['question' => 'Que signifie l\'acronyme « PIB » ?', 'options' => ['Produit Intérieur Brut', 'Produit International Brut', 'Prix Indice Boursier', 'Produit Interne Bancaire'], 'correct' => 0],
            ['question' => 'Quel organisme s\'occupe du commerce mondial ?', 'options' => ['FMI', 'OMC', 'Banque mondiale', 'ONU'], 'correct' => 1],
        ];

        foreach ($q15Data as $q) {
            $quiz15->questions()->create([
                'question' => $q['question'],
                'options' => $q['options'],
                'correct_index' => $q['correct'],
                'points' => 10,
            ]);
        }

        // ---------- Quiz : Nature ----------
        $quiz16 = Quiz::create([
            'user_id' => $user->id,
            'title' => 'Nature et animaux',
            'description' => 'Le règne animal ! 🦁',
            'category' => 'nature',
            'slug' => 'nature-animaux-040cdef',
            'is_public' => true,
            'plays' => 85,
        ]);

        $q16Data = [
            ['question' => 'Quel animal est le plus rapide du monde ?', 'options' => ['Guépard', 'Lion', 'Antilope', 'Panthère'], 'correct' => 0],
            ['question' => 'Combien de cœurs possède une pieuvre ?', 'options' => ['1', '2', '3', '4'], 'correct' => 2],
            ['question' => 'Quel oiseau ne peut pas voler ?', 'options' => ['Aigle', 'Autruche', 'Pigeon', 'Faucon'], 'correct' => 1],
            ['question' => 'Quel est le mammifère le plus grand du monde ?', 'options' => ['Éléphant d\'Afrique', 'Baleine bleue', 'Girafe', 'Rhinocéros'], 'correct' => 1],
        ];

        foreach ($q16Data as $q) {
            $quiz16->questions()->create([
                'question' => $q['question'],
                'options' => $q['options'],
                'correct_index' => $q['correct'],
                'points' => 10,
            ]);
        }

        // ---------- Quiz : Personnalités ----------
        $quiz17 = Quiz::create([
            'user_id' => $user->id,
            'title' => 'Personnalités sénégalaises',
            'description' => 'Connais-tu ces grands Sénégalais ? ⭐',
            'category' => 'culture',
            'slug' => 'personnalites-senegalaises-151ghij',
            'is_public' => true,
            'plays' => 120,
        ]);

        $q17Data = [
            ['question' => 'Quel Sénégalais a été secrétaire général de l\'ONU ?', 'options' => ['Abdou Diouf', 'Kofi Annan', 'Boutros Boutros-Ghali', 'Ban Ki-moon'], 'correct' => 0],
            ['question' => 'Qui a écrit le célèbre roman « Une si longue lettre » ?', 'options' => ['Aminata Sow Fall', 'Mariama Bâ', 'Ken Bugul', 'Calixthe Beyala'], 'correct' => 1],
            ['question' => 'Quel chanteur a composé « 7 Seconds » en duo avec Neneh Cherry ?', 'options' => ['Ismaël Lô', 'Youssou N\'Dour', 'Baaba Maal', 'Cheikh Lô'], 'correct' => 1],
            ['question' => 'Qui est le premier président de la République du Sénégal ?', 'options' => ['Abdoulaye Wade', 'Léopold Sédar Senghor', 'Macky Sall', 'Mamadou Dia'], 'correct' => 1],
        ];

        foreach ($q17Data as $q) {
            $quiz17->questions()->create([
                'question' => $q['question'],
                'options' => $q['options'],
                'correct_index' => $q['correct'],
                'points' => 10,
            ]);
        }

        // ---------- Quiz : Santé ----------
        $quiz18 = Quiz::create([
            'user_id' => $user->id,
            'title' => 'Santé et corps humain',
            'description' => 'Découvre ton corps ! 🩺',
            'category' => 'science',
            'slug' => 'sante-corps-262ijkl',
            'is_public' => true,
            'plays' => 55,
        ]);

        $q18Data = [
            ['question' => 'Combien d\'os possède un adulte humain ?', 'options' => ['200', '206', '210', '215'], 'correct' => 1],
            ['question' => 'Quel organe est chargé de la circulation du sang ?', 'options' => ['Poumons', 'Cœur', 'Foie', 'Reins'], 'correct' => 1],
            ['question' => 'Combien de dents possède un adulte ?', 'options' => ['28', '30', '32', '36'], 'correct' => 2],
            ['question' => 'Quel est le plus grand organe du corps humain ?', 'options' => ['Cerveau', 'Peau', 'Foie', 'Intestin'], 'correct' => 1],
        ];

        foreach ($q18Data as $q) {
            $quiz18->questions()->create([
                'question' => $q['question'],
                'options' => $q['options'],
                'correct_index' => $q['correct'],
                'points' => 10,
            ]);
        }

        // ---------- Quiz : Littérature ----------
        $quiz19 = Quiz::create([
            'user_id' => $user->id,
            'title' => 'Littérature et histoires',
            'description' => 'Le monde des livres ! 📚',
            'category' => 'general',
            'slug' => 'litterature-histoires-373klmn',
            'is_public' => true,
            'plays' => 63,
        ]);

        $q19Data = [
            ['question' => 'Qui a écrit « Le Comte de Monte-Cristo » ?', 'options' => ['Victor Hugo', 'Alexandre Dumas', 'Émile Zola', 'Gustave Flaubert'], 'correct' => 1],
            ['question' => 'Quel est le premier livre de la Bible ?', 'options' => ['Exode', 'Genèse', 'Lévitique', 'Psaumes'], 'correct' => 1],
            ['question' => 'Qui est l\'auteur de « Bel-Ami » ?', 'options' => ['Guy de Maupassant', 'Stendhal', 'Honoré de Balzac', 'Marcel Proust'], 'correct' => 0],
            ['question' => 'Quel conte met en scène un petit chaperon rouge ?', 'options' => ['Blanche-Neige', 'Le petit Chaperon rouge', 'Cendrillon', 'Hansel et Gretel'], 'correct' => 1],
        ];

        foreach ($q19Data as $q) {
            $quiz19->questions()->create([
                'question' => $q['question'],
                'options' => $q['options'],
                'correct_index' => $q['correct'],
                'points' => 10,
            ]);
        }

        // ---------- Quiz : Actualités ----------
        $quiz20 = Quiz::create([
            'user_id' => $user->id,
            'title' => 'Actualités et faits divers',
            'description' => 'Les faits marquants ! 📰',
            'category' => 'general',
            'slug' => 'actualites-faits-484mnop',
            'is_public' => true,
            'plays' => 90,
        ]);

        $q20Data = [
            ['question' => 'En quelle année a eu lieu le début de la pandémie COVID-19 ?', 'options' => ['2018', '2019', '2020', '2021'], 'correct' => 2],
            ['question' => 'Quel est le nom du vaccin d\'AstraZeneca ?', 'options' => ['Vaxzevria', 'Pfizer', 'Moderna', 'Sinovac'], 'correct' => 0],
            ['question' => 'Qui est devenu président du Sénégal en 2024 ?', 'options' => ['Macky Sall', 'Bassirou Diomaye Faye', 'Idrissa Seck', 'Barthélémy Dias'], 'correct' => 1],
            ['question' => 'Quelle ville a accueilli les Jeux Olympiques 2024 ?', 'options' => ['Tokyo', 'Paris', 'Los Angeles', 'Londres'], 'correct' => 1],
        ];

        foreach ($q20Data as $q) {
            $quiz20->questions()->create([
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
            [
                'title' => 'Le serviteur muet',
                'question' => 'Je ne parle pas, mais je raconte tout ce que tu m\'écris. Je suis avec toi chaque jour. Qui suis-je ?',
                'answer' => 'téléphone',
                'hint' => 'Tu l\'utilises pour envoyer des messages anonymes',
                'category' => 'general',
                'challenges' => 52,
                'successes' => 41,
            ],
            [
                'title' => 'L\'oiseau du navigateur',
                'question' => 'Je navigue sans bateau et je voyage sans bouger. J\'explore le monde à travers des pages. Qui suis-je ?',
                'answer' => 'navigateur internet',
                'hint' => 'Chrome, Firefox, Safari...',
                'category' => 'general',
                'challenges' => 38,
                'successes' => 30,
            ],
            [
                'title' => 'Le secret du fogox',
                'question' => 'Plus je cours, plus je suis petit. Que suis-je ?',
                'answer' => 'bougie',
                'hint' => 'Elle éclaire et fond',
                'category' => 'general',
                'challenges' => 18,
                'successes' => 12,
            ],
            [
                'title' => 'La montagne de sel',
                'question' => 'Je blanchis la mer quand je m\'y dissous. Je suis indispensable à ta cuisine. Que suis-je ?',
                'answer' => 'sel',
                'hint' => 'Tu en mets dans la thiéboudienne',
                'category' => 'culture',
                'challenges' => 25,
                'successes' => 22,
            ],
            [
                'title' => 'Le chemin de fer',
                'question' => 'Je me déplace sur des rails et je transporte des passagers. Qui suis-je ?',
                'answer' => 'train',
                'hint' => 'On dit « le petit train de la Teranga »',
                'category' => 'general',
                'challenges' => 44,
                'successes' => 33,
            ],
            [
                'title' => 'La fenêtre du ciel',
                'question' => 'Le jour je suis lumineux, la nuit je disparais. Parfois je pleure. Qui suis-je ?',
                'answer' => 'ciel',
                'hint' => 'Au-dessus de ta tête',
                'category' => 'nature',
                'challenges' => 19,
                'successes' => 14,
            ],
            [
                'title' => 'Le gardien du temps',
                'question' => 'Je mesure les heures sans jamais me lasser. Je suis sur ton poignet ou au mur. Qui suis-je ?',
                'answer' => 'montre',
                'hint' => 'Elle indique l\'heure',
                'category' => 'general',
                'challenges' => 27,
                'successes' => 21,
            ],
            [
                'title' => 'Le roi de la savane',
                'question' => 'Je porte une crinière majestueuse et mon rugissement domine la savane. Qui suis-je ?',
                'answer' => 'lion',
                'hint' => 'Le roi des animaux',
                'category' => 'nature',
                'challenges' => 36,
                'successes' => 28,
            ],
            [
                'title' => 'Le messager du vent',
                'question' => 'Je vole dans le ciel sans avoir d\'ailes. Je porte les lettres et les colis. Qui suis-je ?',
                'answer' => 'avion',
                'hint' => 'Il prend son envol',
                'category' => 'general',
                'challenges' => 22,
                'successes' => 17,
            ],
            [
                'title' => 'La maison du miel',
                'question' => 'Ma maison est en cire et je travaille dur avec mes sœurs. Qui suis-je ?',
                'answer' => 'abeille',
                'hint' => 'Elle produit le miel',
                'category' => 'nature',
                'challenges' => 15,
                'successes' => 11,
            ],
            [
                'title' => 'L\'ami des élèves',
                'question' => 'Je contiens tout ce qu\'on apprend. J\'ai des pages et une couverture. Qui suis-je ?',
                'answer' => 'livre',
                'hint' => 'On le lit à l\'école',
                'category' => 'general',
                'challenges' => 29,
                'successes' => 24,
            ],
            [
                'title' => 'Le danseur des vagues',
                'question' => 'Je danse sur la mer et je suis blanc en haut. Parfois je transporte les bateaux. Qui suis-je ?',
                'answer' => 'vague',
                'hint' => 'Elle se brise sur la plage',
                'category' => 'nature',
                'challenges' => 33,
                'successes' => 26,
            ],
            [
                'title' => 'Le géant de pierre',
                'question' => 'Je suis immense et je fume parfois par le haut. Les gens montent mon sommet. Qui suis-je ?',
                'answer' => 'volcan',
                'hint' => 'Il peut cracher de la lave',
                'category' => 'nature',
                'challenges' => 13,
                'successes' => 9,
            ],
            [
                'title' => 'La gardienne des secrets',
                'question' => 'J\'ai une clé et je demeure verrouillée. Seul son propriétaire ouvre mes cadenas. Qui suis-je ?',
                'answer' => 'boite',
                'hint' => 'On y range ses trésors',
                'category' => 'general',
                'challenges' => 17,
                'successes' => 12,
            ],
            [
                'title' => 'L\'étoile du matin',
                'question' => 'Je me réveille avec le coq et je réchauffe tout le monde. Je suis doré. Qui suis-je ?',
                'answer' => 'soleil',
                'hint' => 'Il se lève à l\'est',
                'category' => 'nature',
                'challenges' => 40,
                'successes' => 35,
            ],
            [
                'title' => 'Le compagnon de route',
                'question' => 'Je cours sous la terre et je porte l\'eau vers les maisons. On ne me voit pas. Qui suis-je ?',
                'answer' => 'canalisation',
                'hint' => 'Tuyau souterrain',
                'category' => 'general',
                'challenges' => 10,
                'successes' => 7,
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
