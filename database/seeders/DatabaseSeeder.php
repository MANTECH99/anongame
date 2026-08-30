<?php

namespace Database\Seeders;

use App\Models\AnonymousLink;
use App\Models\Devinette;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use \Illuminate\Database\Console\Seeds\WithoutModelEvents;

    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@anongame.sn'],
            ['name' => 'Admin Sénégal', 'pseudo' => 'admin221', 'phone' => '771234567', 'password' => bcrypt('password')]
        );

        AnonymousLink::firstOrCreate(
            ['user_id' => $user->id],
            ['slug' => 'admin221', 'title' => 'Admin Sénégal', 'is_active' => true]
        );

        // ---------- QUIZ ----------
        $quizzes = [
            [
                'title' => 'Culture sénégalaise',
                'description' => 'Teste ta connaissance de la culture du Sénégal ! 🇸🇳',
                'category' => 'culture',
                'slug' => 'culture-senegalaise-abc123',
                'plays' => 122,
                'questions' => [
                    ['question' => 'Quelle est la capitale du Sénégal ?', 'options' => array (  0 => 'Saint-Louis',  1 => 'Dakar',  2 => 'Thiès',  3 => 'Ziguinchor',), 'correct' => 1],
                    ['question' => 'Quel plat est considéré comme le plat national sénégalais ?', 'options' => array (  0 => 'Yassa',  1 => 'Mafé',  2 => 'Thiéboudienne',  3 => 'Thiakry',), 'correct' => 2],
                    ['question' => 'Quelle est la langue la plus parlée au Sénégal ?', 'options' => array (  0 => 'Français',  1 => 'Pulaar',  2 => 'Wolof',  3 => 'Sérère',), 'correct' => 2],
                    ['question' => 'Quelle île est célèbre pour son festival de jazz ?', 'options' => array (  0 => 'Île de Gorée',  1 => 'Île Saint-Louis',  2 => 'Île de Ngor',  3 => 'Carabane',), 'correct' => 1],
                    ['question' => 'Qui est le premier président du Sénégal ?', 'options' => array (  0 => 'Abdoulaye Wade',  1 => 'Léopold Sédar Senghor',  2 => 'Macky Sall',  3 => 'Abdou Diouf',), 'correct' => 1],
                ],
            ],
            [
                'title' => 'Football : les Lions de la Téranga',
                'description' => 'Les champions d\'Afrique 2022 ! 🦁',
                'category' => 'football',
                'slug' => 'football-lions-teranga-def456',
                'plays' => 310,
                'questions' => [
                    ['question' => 'En quelle année le Sénégal a-t-il remporté la CAN ?', 'options' => array (  0 => '2019',  1 => '2022',  2 => '2023',  3 => '2017',), 'correct' => 1],
                    ['question' => 'Qui est le capitaine des Lions de la Téranga ?', 'options' => array (  0 => 'Édouard Mendy',  1 => 'Sadio Mané',  2 => 'Kalidou Koulibaly',  3 => 'Idrissa Gueye',), 'correct' => 2],
                    ['question' => 'Quel club a révélé Sadio Mané en Europe ?', 'options' => array (  0 => 'Liverpool',  1 => 'Southampton',  2 => 'RB Salzbourg',  3 => 'Metz',), 'correct' => 2],
                    ['question' => 'Qui était le sélectionneur lors du titre de la CAN 2022 ?', 'options' => array (  0 => 'Aliou Cissé',  1 => 'Pape Thiaw',  2 => 'Habib Beye',  3 => 'Alain Giresse',), 'correct' => 0],
                ],
            ],
            [
                'title' => 'Géographie du Sénégal',
                'description' => 'Connais-tu bien les régions et fleuves ? 🗺️',
                'category' => 'geographie',
                'slug' => 'geographie-senegal-ghi789',
                'plays' => 74,
                'questions' => [
                    ['question' => 'Quel fleuve forme la frontière nord du Sénégal ?', 'options' => array (  0 => 'Fleuve Gambie',  1 => 'Fleuve Sénégal',  2 => 'Fleuve Casamance',  3 => 'Fleuve Saloum',), 'correct' => 1],
                    ['question' => 'Quel pays est enchâssé dans le territoire sénégalais ?', 'options' => array (  0 => 'Mali',  1 => 'Guinée',  2 => 'Gambie',  3 => 'Mauritanie',), 'correct' => 2],
                    ['question' => 'Quel lac est célèbre pour sa couleur rose ?', 'options' => array (  0 => 'Lac de Guiers',  1 => 'Lac Rose (Retba)',  2 => 'Lac Tamma',  3 => 'Lac des Vallées',), 'correct' => 1],
                ],
            ],
            [
                'title' => 'Culture générale mondiale',
                'description' => 'Un peu de tout pour tester ta culture ! 🌍',
                'category' => 'general',
                'slug' => 'culture-generale-monde-jkl012',
                'plays' => 205,
                'questions' => [
                    ['question' => 'Combien y a-t-il de continents sur Terre ?', 'options' => array (  0 => '5',  1 => '6',  2 => '7',  3 => '8',), 'correct' => 2],
                    ['question' => 'Quel est le plus grand océan du monde ?', 'options' => array (  0 => 'Atlantique',  1 => 'Pacifique',  2 => 'Indien',  3 => 'Arctique',), 'correct' => 1],
                    ['question' => 'Quelle planète est surnommée la planète rouge ?', 'options' => array (  0 => 'Vénus',  1 => 'Jupiter',  2 => 'Mars',  3 => 'Saturne',), 'correct' => 2],
                    ['question' => 'Combien de couleurs y a-t-il dans un arc-en-ciel ?', 'options' => array (  0 => '5',  1 => '6',  2 => '7',  3 => '8',), 'correct' => 2],
                    ['question' => 'Quel animal est le plus grand du monde ?', 'options' => array (  0 => 'Éléphant',  1 => 'Baleine bleue',  2 => 'Girafe',  3 => 'Requin blanc',), 'correct' => 1],
                ],
            ],
            [
                'title' => 'Science et nature',
                'description' => 'Les mystères de la science à ta portée ! 🔬',
                'category' => 'science',
                'slug' => 'science-nature-abcxyz',
                'plays' => 98,
                'questions' => [
                    ['question' => 'Quel gaz les plantes absorbent-elles pour la photosynthèse ?', 'options' => array (  0 => 'Oxygène',  1 => 'Azote',  2 => 'Dioxyde de carbone',  3 => 'Hydrogène',), 'correct' => 2],
                    ['question' => 'Combien de planètes font partie du système solaire (hors Pluton) ?', 'options' => array (  0 => '7',  1 => '8',  2 => '9',  3 => '10',), 'correct' => 1],
                    ['question' => 'Quel est le symbole chimique de l\'eau ?', 'options' => array (  0 => 'O2',  1 => 'H2O',  2 => 'CO2',  3 => 'NaCl',), 'correct' => 1],
                    ['question' => 'Quelle est la vitesse de la lumière ?', 'options' => array (  0 => '300 000 km/s',  1 => '150 000 km/s',  2 => '1 million km/s',  3 => '30 000 km/s',), 'correct' => 0],
                ],
            ],
            [
                'title' => 'Histoire de l\'Afrique',
                'description' => 'Les grands moments de l\'histoire africaine ! 📜',
                'category' => 'histoire',
                'slug' => 'histoire-afrique-xyz987',
                'plays' => 150,
                'questions' => [
                    ['question' => 'Quelle ancienne civilisation africaine a bâti les pyramides de Gizeh ?', 'options' => array (  0 => 'Nubie',  1 => 'Égypte',  2 => 'Axoum',  3 => 'Mali',), 'correct' => 1],
                    ['question' => 'Qui est le célèbre empereur de l\'empire du Mali connu pour son pèlerinage à La Mecque ?', 'options' => array (  0 => 'Soundiata Keïta',  1 => 'Mansa Moussa',  2 => 'Askia Mohammed',  3 => 'Sundiata',), 'correct' => 1],
                    ['question' => 'Quel est l\'ancien nom de la ville de Bobo-Dioulasso ?', 'options' => array (  0 => 'Sylla',  1 => 'Kong',  2 => 'Sya',  3 => 'Wagadougou',), 'correct' => 2],
                ],
            ],
            [
                'title' => 'Sport : le monde',
                'description' => 'Teste tes connaissances sportives ! ⚽',
                'category' => 'sport',
                'slug' => 'sport-monde-q7abcd',
                'plays' => 88,
                'questions' => [
                    ['question' => 'Quel pays a remporté la Coupe du Monde 2018 ?', 'options' => array (  0 => 'Brésil',  1 => 'Allemagne',  2 => 'France',  3 => 'Argentine',), 'correct' => 2],
                    ['question' => 'Combien de joueurs y a-t-il dans une équipe de football sur le terrain ?', 'options' => array (  0 => '10',  1 => '11',  2 => '12',  3 => '9',), 'correct' => 1],
                    ['question' => 'Dans quel sport utilise-t-on une raquette et un volant ?', 'options' => array (  0 => 'Tennis',  1 => 'Badminton',  2 => 'Squash',  3 => 'Padel',), 'correct' => 1],
                    ['question' => 'Qui est surnommé le GOAT au basketball ?', 'options' => array (  0 => 'LeBron James',  1 => 'Michael Jordan',  2 => 'Kobe Bryant',  3 => 'Shaquille O\'Neal',), 'correct' => 1],
                ],
            ],
            [
                'title' => 'Musique africaine',
                'description' => 'Les grands noms de la musique africaine ! 🎵',
                'category' => 'musique',
                'slug' => 'musique-africaine-q8efgh',
                'plays' => 131,
                'questions' => [
                    ['question' => 'Quel chanteur sénégalais est surnommé le « Roi du Mbalax » ?', 'options' => array (  0 => 'Ismaël Lô',  1 => 'Youssou N\'Dour',  2 => 'Baaba Maal',  3 => 'Cheikh Lô',), 'correct' => 1],
                    ['question' => 'De quel pays vient l\'artiste Sarkodie ?', 'options' => array (  0 => 'Nigeria',  1 => 'Ghana',  2 => 'Sénégal',  3 => 'Côte d\'Ivoire',), 'correct' => 1],
                    ['question' => 'Quelle artiste nigériane est connue sous le nom de « Queen of Afrobeats » ?', 'options' => array (  0 => 'Wizkid',  1 => 'Davido',  2 => 'Yemi Alade',  3 => 'Tiwa Savage',), 'correct' => 3],
                    ['question' => 'Quel instrument est un tambour traditionnel africain ?', 'options' => array (  0 => 'Kora',  1 => 'Balafon',  2 => 'Djembe',  3 => 'Cora',), 'correct' => 2],
                ],
            ],
            [
                'title' => 'Informatique et Internet',
                'description' => 'Le monde du numérique ! 💻',
                'category' => 'informatique',
                'slug' => 'informatique-internet-q9wxyz',
                'plays' => 75,
                'questions' => [
                    ['question' => 'Que signifie « WWW » ?', 'options' => array (  0 => 'World Web Wide',  1 => 'World Wide Web',  2 => 'Web World Wide',  3 => 'Wide Web World',), 'correct' => 1],
                    ['question' => 'Quel est le langage de programmation créé par Rasmus Lerdorf ?', 'options' => array (  0 => 'JavaScript',  1 => 'Python',  2 => 'PHP',  3 => 'Java',), 'correct' => 2],
                    ['question' => 'Quelle entreprise a créé le système d\'exploitation Windows ?', 'options' => array (  0 => 'Apple',  1 => 'Microsoft',  2 => 'Google',  3 => 'IBM',), 'correct' => 1],
                    ['question' => 'Que signifie l\'acronyme « HTML » ?', 'options' => array (  0 => 'HyperText Markup Language',  1 => 'Home Tool Markup Language',  2 => 'Hyperlink Text Model Language',  3 => 'High Tech Modern Language',), 'correct' => 0],
                ],
            ],
            [
                'title' => 'Géographie du monde',
                'description' => 'Les merveilles de la planète ! 🌎',
                'category' => 'geographie',
                'slug' => 'geographie-monde-q10abcd',
                'plays' => 95,
                'questions' => [
                    ['question' => 'Quel est le plus long fleuve du monde ?', 'options' => array (  0 => 'Amazon',  1 => 'Nil',  2 => 'Yangtsé',  3 => 'Mississippi',), 'correct' => 0],
                    ['question' => 'Quelle est la plus grande désert du monde (hors pôles) ?', 'options' => array (  0 => 'Gobi',  1 => 'Sahara',  2 => 'Kalahari',  3 => 'Atacama',), 'correct' => 1],
                    ['question' => 'Quel est le plus haut sommet du monde ?', 'options' => array (  0 => 'K2',  1 => 'Mont Everest',  2 => 'Kangchenjunga',  3 => 'Mont Blanc',), 'correct' => 1],
                    ['question' => 'Combien de pays font partie de l\'Union africaine ?', 'options' => array (  0 => '50',  1 => '54',  2 => '55',  3 => '57',), 'correct' => 2],
                ],
            ],
            [
                'title' => 'Cinéma et séries',
                'description' => 'À toi de jouer ! 🎬',
                'category' => 'cinema',
                'slug' => 'cinema-series-q11wxyz',
                'plays' => 110,
                'questions' => [
                    ['question' => 'Qui joue Iron Man dans le MCU ?', 'options' => array (  0 => 'Chris Evans',  1 => 'Robert Downey Jr',  2 => 'Chris Hemsworth',  3 => 'Mark Ruffalo',), 'correct' => 1],
                    ['question' => 'Quel film est célèbre pour la phrase « May the Force be with you » ?', 'options' => array (  0 => 'Star Wars',  1 => 'Star Trek',  2 => 'Avatar',  3 => 'Interstellar',), 'correct' => 0],
                    ['question' => 'Dans quelle ville se déroule la série « Lupin » ?', 'options' => array (  0 => 'Londres',  1 => 'Paris',  2 => 'Rome',  3 => 'New York',), 'correct' => 1],
                    ['question' => 'Quel dessin animé met en scène un garçon ninja ?', 'options' => array (  0 => 'Dragon Ball',  1 => 'Naruto',  2 => 'One Piece',  3 => 'Bleach',), 'correct' => 1],
                ],
            ],
            [
                'title' => 'Cuisine du monde',
                'description' => 'Les saveurs de la planète ! 🍽️',
                'category' => 'cuisine',
                'slug' => 'cuisine-monde-q12abcd',
                'plays' => 64,
                'questions' => [
                    ['question' => 'Dans quel pays est née la pizza ?', 'options' => array (  0 => 'France',  1 => 'Espagne',  2 => 'Italie',  3 => 'Grèce',), 'correct' => 2],
                    ['question' => 'Quel plat japonais se compose de riz vinaigré et de poisson cru ?', 'options' => array (  0 => 'Ramen',  1 => 'Sushi',  2 => 'Tempura',  3 => 'Udon',), 'correct' => 1],
                    ['question' => 'Quel est le plat typique du Sénégal à base de mil ?', 'options' => array (  0 => 'Thiéboudienne',  1 => 'Thiakry',  2 => 'Yassa',  3 => 'Mafé',), 'correct' => 1],
                    ['question' => 'Quelle épice donne la couleur jaune au curry ?', 'options' => array (  0 => 'Paprika',  1 => 'Curcuma',  2 => 'Safran',  3 => 'Cumin',), 'correct' => 1],
                ],
            ],
            [
                'title' => 'Science-fiction et imaginaire',
                'description' => 'L\'univers de l\'imaginaire ! 🚀',
                'category' => 'general',
                'slug' => 'science-fiction-q13wxyz',
                'plays' => 70,
                'questions' => [
                    ['question' => 'Quel vaisseau a emmené le premier homme sur la Lune ?', 'options' => array (  0 => 'Apollo 11',  1 => 'Apollo 13',  2 => 'Discovery',  3 => 'Columbus',), 'correct' => 0],
                    ['question' => 'Qui a écrit « Le Petit Prince » ?', 'options' => array (  0 => 'Victor Hugo',  1 => 'Antoine de Saint-Exupéry',  2 => 'Jules Verne',  3 => 'Albert Camus',), 'correct' => 1],
                    ['question' => 'Dans « Harry Potter », quelle école apprend-on la magie ?', 'options' => array (  0 => 'Hogwarts',  1 => 'Beauxbatons',  2 => 'Durmstrang',  3 => 'Poudlard',), 'correct' => 3],
                    ['question' => 'Quel héros porte un costume bleu et une cape rouge ?', 'options' => array (  0 => 'Batman',  1 => 'Superman',  2 => 'Spiderman',  3 => 'Flash',), 'correct' => 1],
                ],
            ],
            [
                'title' => 'Sénégal : les hauts lieux',
                'description' => 'Explore le Sénégal ! 🗺️',
                'category' => 'geographie',
                'slug' => 'senegal-hauts-lieux-q14abcd',
                'plays' => 58,
                'questions' => [
                    ['question' => 'Où se trouve la célèbre Mosquée de la Divinité ?', 'options' => array (  0 => 'Touba',  1 => 'Dakar',  2 => 'Saint-Louis',  3 => 'Kaolack',), 'correct' => 0],
                    ['question' => 'Quelle ville est surnommée « la Perle de la Casamance » ?', 'options' => array (  0 => 'Ziguinchor',  1 => 'Kolda',  2 => 'Bignona',  3 => 'Oussouye',), 'correct' => 0],
                    ['question' => 'Quel est le plus grand port du Sénégal ?', 'options' => array (  0 => 'Port de Saint-Louis',  1 => 'Port de Dakar',  2 => 'Port de Ziguinchor',  3 => 'Port de Kaolack',), 'correct' => 1],
                    ['question' => 'Quelle réserve abrite le delta du Saloum ?', 'options' => array (  0 => 'Réserve de Bandia',  1 => 'Parc du Niokolo-Koba',  2 => 'Réserve du Saloum',  3 => 'Réserve de Fathala',), 'correct' => 2],
                ],
            ],
            [
                'title' => 'Économie et argent',
                'description' => 'Le monde des finances ! 💰',
                'category' => 'economie',
                'slug' => 'economie-argent-q15wxyz',
                'plays' => 40,
                'questions' => [
                    ['question' => 'Quelle est la monnaie de l\'Union économique ouest-africaine (UEMOA) ?', 'options' => array (  0 => 'Naira',  1 => 'Franc CFA',  2 => 'Cedi',  3 => 'Dirham',), 'correct' => 1],
                    ['question' => 'Quel est le plus grand centre financier du monde ?', 'options' => array (  0 => 'Londres',  1 => 'New York',  2 => 'Tokyo',  3 => 'Hong Kong',), 'correct' => 1],
                    ['question' => 'Que signifie l\'acronyme « PIB » ?', 'options' => array (  0 => 'Produit Intérieur Brut',  1 => 'Produit International Brut',  2 => 'Prix Indice Boursier',  3 => 'Produit Interne Bancaire',), 'correct' => 0],
                    ['question' => 'Quel organisme s\'occupe du commerce mondial ?', 'options' => array (  0 => 'FMI',  1 => 'OMC',  2 => 'Banque mondiale',  3 => 'ONU',), 'correct' => 1],
                ],
            ],
            [
                'title' => 'Nature et animaux',
                'description' => 'Le règne animal ! 🦁',
                'category' => 'nature',
                'slug' => 'nature-animaux-q16abcd',
                'plays' => 85,
                'questions' => [
                    ['question' => 'Quel animal est le plus rapide du monde ?', 'options' => array (  0 => 'Guépard',  1 => 'Lion',  2 => 'Antilope',  3 => 'Panthère',), 'correct' => 0],
                    ['question' => 'Combien de cœurs possède une pieuvre ?', 'options' => array (  0 => '1',  1 => '2',  2 => '3',  3 => '4',), 'correct' => 2],
                    ['question' => 'Quel oiseau ne peut pas voler ?', 'options' => array (  0 => 'Aigle',  1 => 'Autruche',  2 => 'Pigeon',  3 => 'Faucon',), 'correct' => 1],
                    ['question' => 'Quel est le mammifère le plus grand du monde ?', 'options' => array (  0 => 'Éléphant d\'Afrique',  1 => 'Baleine bleue',  2 => 'Girafe',  3 => 'Rhinocéros',), 'correct' => 1],
                ],
            ],
            [
                'title' => 'Personnalités sénégalaises',
                'description' => 'Connais-tu ces grands Sénégalais ? ⭐',
                'category' => 'culture',
                'slug' => 'personnalites-senegalaises-q17wxyz',
                'plays' => 120,
                'questions' => [
                    ['question' => 'Quel Sénégalais a été secrétaire général de l\'ONU ?', 'options' => array (  0 => 'Abdou Diouf',  1 => 'Kofi Annan',  2 => 'Boutros Boutros-Ghali',  3 => 'Ban Ki-moon',), 'correct' => 0],
                    ['question' => 'Qui a écrit le célèbre roman « Une si longue lettre » ?', 'options' => array (  0 => 'Aminata Sow Fall',  1 => 'Mariama Bâ',  2 => 'Ken Bugul',  3 => 'Calixthe Beyala',), 'correct' => 1],
                    ['question' => 'Quel chanteur a composé « 7 Seconds » en duo avec Neneh Cherry ?', 'options' => array (  0 => 'Ismaël Lô',  1 => 'Youssou N\'Dour',  2 => 'Baaba Maal',  3 => 'Cheikh Lô',), 'correct' => 1],
                    ['question' => 'Qui est le premier président de la République du Sénégal ?', 'options' => array (  0 => 'Abdoulaye Wade',  1 => 'Léopold Sédar Senghor',  2 => 'Macky Sall',  3 => 'Mamadou Dia',), 'correct' => 1],
                ],
            ],
            [
                'title' => 'Santé et corps humain',
                'description' => 'Découvre ton corps ! 🩺',
                'category' => 'science',
                'slug' => 'sante-corps-q18abcd',
                'plays' => 55,
                'questions' => [
                    ['question' => 'Combien d\'os possède un adulte humain ?', 'options' => array (  0 => '200',  1 => '206',  2 => '210',  3 => '215',), 'correct' => 1],
                    ['question' => 'Quel organe est chargé de la circulation du sang ?', 'options' => array (  0 => 'Poumons',  1 => 'Cœur',  2 => 'Foie',  3 => 'Reins',), 'correct' => 1],
                    ['question' => 'Combien de dents possède un adulte ?', 'options' => array (  0 => '28',  1 => '30',  2 => '32',  3 => '36',), 'correct' => 2],
                    ['question' => 'Quel est le plus grand organe du corps humain ?', 'options' => array (  0 => 'Cerveau',  1 => 'Peau',  2 => 'Foie',  3 => 'Intestin',), 'correct' => 1],
                ],
            ],
            [
                'title' => 'Littérature et histoires',
                'description' => 'Le monde des livres ! 📚',
                'category' => 'general',
                'slug' => 'litterature-histoires-q19wxyz',
                'plays' => 63,
                'questions' => [
                    ['question' => 'Qui a écrit « Le Comte de Monte-Cristo » ?', 'options' => array (  0 => 'Victor Hugo',  1 => 'Alexandre Dumas',  2 => 'Émile Zola',  3 => 'Gustave Flaubert',), 'correct' => 1],
                    ['question' => 'Quel est le premier livre de la Bible ?', 'options' => array (  0 => 'Exode',  1 => 'Genèse',  2 => 'Lévitique',  3 => 'Psaumes',), 'correct' => 1],
                    ['question' => 'Qui est l\'auteur de « Bel-Ami » ?', 'options' => array (  0 => 'Guy de Maupassant',  1 => 'Stendhal',  2 => 'Honoré de Balzac',  3 => 'Marcel Proust',), 'correct' => 0],
                    ['question' => 'Quel conte met en scène un petit chaperon rouge ?', 'options' => array (  0 => 'Blanche-Neige',  1 => 'Le petit Chaperon rouge',  2 => 'Cendrillon',  3 => 'Hansel et Gretel',), 'correct' => 1],
                ],
            ],
            [
                'title' => 'Actualités et faits divers',
                'description' => 'Les faits marquants ! 📰',
                'category' => 'general',
                'slug' => 'actualites-faits-q20abcd',
                'plays' => 90,
                'questions' => [
                    ['question' => 'En quelle année a eu lieu la première pandémie COVID-19 ?', 'options' => array (  0 => '2018',  1 => '2019',  2 => '2020',  3 => '2021',), 'correct' => 2],
                    ['question' => 'Quel est le nom du vaccin d\'AstraZeneca ?', 'options' => array (  0 => 'Vaxzevria',  1 => 'Pfizer',  2 => 'Moderna',  3 => 'Sinovac',), 'correct' => 0],
                    ['question' => 'Qui est devenu président du Sénégal en 2024 ?', 'options' => array (  0 => 'Macky Sall',  1 => 'Bassirou Diomaye Faye',  2 => 'Idrissa Seck',  3 => 'Barthélémy Dias',), 'correct' => 1],
                    ['question' => 'Quelle ville a accueilli les Jeux Olympiques 2024 ?', 'options' => array (  0 => 'Tokyo',  1 => 'Paris',  2 => 'Los Angeles',  3 => 'Londres',), 'correct' => 1],
                ],
            ],
        ];

        foreach ($quizzes as $qz) {
            $quiz = Quiz::firstOrCreate(
                ['slug' => $qz['slug']],
                [
                    'user_id' => $user->id,
                    'title' => $qz['title'],
                    'description' => $qz['description'],
                    'category' => $qz['category'],
                    'is_public' => true,
                    'plays' => $qz['plays'],
                ]
            );
            foreach ($qz['questions'] as $qq) {
                $quiz->questions()->firstOrCreate(
                    ['question' => $qq['question']],
                    ['options' => $qq['options'], 'correct_index' => $qq['correct'], 'points' => 10]
                );
            }
        }

        // ---------- DEVINETTES ----------
        $devinettes = [
            [
                'title' => 'Le secret du pêcheur',
                'question' => 'Je suis le plat que tout Sénégalais aime. On me prépare avec du riz et du poisson. Qui suis-je ?',
                'answer' => 'thiéboudienne',
                'hint' => 'C\'est le plat national',
                'category' => 'culture',
                'challenges' => 49,
                'successes' => 31,
            ],
            [
                'title' => 'L\'animal de la savane',
                'question' => 'Je suis le roi des animaux et mon nom rappelle le courage. Je suis présent dans le surnom des footballeurs sénégalais. Qui suis-je ?',
                'answer' => 'lion',
                'hint' => 'Roi des animaux',
                'category' => 'general',
                'challenges' => 25,
                'successes' => 20,
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
                'challenges' => 21,
                'successes' => 15,
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
            Devinette::firstOrCreate(
                ['title' => $d['title']],
                [
                    'user_id' => $user->id,
                    'question' => $d['question'],
                    'answer' => $d['answer'],
                    'hint' => $d['hint'],
                    'category' => $d['category'],
                    'slug' => Str::slug($d['title']) . '-' . Str::random(5),
                    'is_public' => true,
                    'challenges' => $d['challenges'],
                    'successes' => $d['successes'],
                ]
            );
        }
    }
}
