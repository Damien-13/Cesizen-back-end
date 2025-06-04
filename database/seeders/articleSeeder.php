<?php

namespace Database\Seeders;

use App\Models\RelationType;
use App\Models\article;
use App\Models\articleCategorie;
use App\Models\User;
use Illuminate\Database\Seeder;

class articleSeeder extends Seeder
{
    public function run(): void
    {
        $categories = articleCategorie::pluck('id', 'lib_article_categorie');
        $relationTypes = RelationType::pluck('id', 'lib_relation_type');

        $articles = [
            [
                'titre' => 'Comprendre les symptômes de l’anxiété',
                'description' => "Palpitations, fatigue, troubles du sommeil : l’anxiété se manifeste de différentes façons.
                    \nReconnaître ses symptômes est une première étape vers une meilleure gestion émotionnelle.
                    \n👉 Article détaillé : https://www.ameli.fr/assure/sante/themes/anxiete",
                'url' => 'https://www.ameli.fr/assure/sante/themes/anxiete',
                'categorie' => $categories['Santé mentale'],
                'relation' => $relationTypes['Dans l’espace public'],
            ],
            [
                'titre' => 'Exercice de respiration : la cohérence cardiaque',
                'description' => "Une méthode simple pour apaiser rapidement le stress.
                    \nRespirez 6 fois par minute pendant 5 minutes, 3 fois par jour.
                    \n🎥 Démonstration en vidéo : https://www.youtube.com/watch?v=YfXpspBv9BI",
                'url' => 'https://www.youtube.com/watch?v=YfXpspBv9BI',
                'categorie' => $categories['Relaxation'],
                'relation' => $relationTypes['Avec un professionnel de santé'],
            ],
            [
                'titre' => 'Comment bien dormir quand on est stressé ?',
                'description' => "Le sommeil est essentiel à l’équilibre mental.
                    \nRituels de coucher, déconnexion numérique, relaxation… découvrez 5 astuces pour améliorer votre endormissement.",
                'url' => null,
                'categorie' => $categories['Gestion du stress'],
                'relation' => $relationTypes['Vie de famille'],
            ],
            [
                'titre' => 'Burn-out : 1 salarié sur 4 concerné',
                'description' => "Une enquête 2024 de l’IFOP révèle qu’un salarié sur quatre présente des signes d’épuisement.
                    \nQuels sont les signes avant-coureurs ? Comment agir rapidement ?
                    \n📊 Résultats du sondage : https://ifop.com/burnout-2024/",
                'url' => 'https://ifop.com/burnout-2024/',
                'categorie' => $categories['Santé mentale'],
                'relation' => $relationTypes['Entre collègues'],
            ],
            [
                'titre' => '3 applis gratuites pour méditer',
                'description' => "Petit Bambou, Respirelax+, Namatata : des applis testées et gratuites pour s’initier à la méditation.
                    \n📱 Apprenez à vous recentrer en 10 minutes par jour.",
                'url' => null,
                'categorie' => $categories['Relaxation'],
                'relation' => $relationTypes['À l’école ou en formation'],
            ],
            [
                'titre' => 'Exprimer ses émotions sans exploser',
                'description' => "Colère, tristesse, frustration : mettre des mots sur ses ressentis permet de mieux les vivre.
                    \nDécouvrez la communication non violente en 4 étapes.",
                'url' => null,
                'categorie' => $categories['Émotions'],
                'relation' => $relationTypes['En couple'],
            ],
            [
                'titre' => 'Santé mentale : des inégalités sociales fortes',
                'description' => "Selon Santé publique France, les personnes précaires souffrent deux fois plus de troubles anxieux.
                    \n👉 En savoir plus : https://www.santepubliquefrance.fr/sante-mentale-et-precarite",
                'url' => 'https://www.santepubliquefrance.fr/sante-mentale-et-precarite',
                'categorie' => $categories['Santé mentale'],
                'relation' => $relationTypes['Aidant et aidé·e'],
            ],
            [
                'titre' => 'Se relaxer en 5 minutes au bureau',
                'description' => "Tensions dans les épaules ? Fatigue mentale ?
                    \nTestez ces micro-pauses de respiration et d’étirement discrètes à faire même devant son écran.",
                'url' => null,
                'categorie' => $categories['Gestion du stress'],
                'relation' => $relationTypes['Avec son supérieur hiérarchique'],
            ],
            [
                'titre' => 'Identifier une crise de panique',
                'description' => "Sueurs, vertiges, cœur qui s’emballe : comment différencier une crise d’angoisse d’un malaise cardiaque ?
                    \nQue faire dans l’instant, et quand consulter ?",
                'url' => null,
                'categorie' => $categories['Émotions'],
                'relation' => $relationTypes['Dans l’espace public'],
            ],
            [
                'titre' => 'Podcast : le stress, comment le comprendre et l’apprivoiser ?',
                'description' => "Un épisode de 15 minutes pour mieux comprendre les mécanismes du stress et découvrir des pistes concrètes.
                    \n🎧 À écouter ici : https://open.spotify.com/episode/stress-apprivoiser",
                'url' => 'https://open.spotify.com/episode/stress-apprivoiser',
                'categorie' => $categories['Gestion du stress'],
                'relation' => $relationTypes['Avec un professionnel de santé'],
            ],
        ];

        foreach ($articles as $data) {
            article::create([
                'titre' => $data['titre'],
                'description' => $data['description'],
                'nom_fichier' => null,
                'restreint' => false,
                'valide' => true,
                'url' => $data['url'],
                'user_id' => User::inRandomOrder()->first()->id,
                'article_categorie_id' => $data['categorie'],
                'article_type_id' => 1,
                'relation_type_id' => $data['relation'],
            ]);
        }
    }
}
