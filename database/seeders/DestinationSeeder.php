<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $destinations = [
            [
                'name' => '🇮🇳 Inde du Nord',
                'slug' => 'north-india',
                'description' => 'Découvrez les merveilles de l\'Inde du Nord, du Triangle d\'Or aux palais majestueux du Rajasthan. Une expérience culturelle et historique inoubliable.',
                'hero_title' => 'Circuits Inde du Nord',
                'hero_description' => 'Découvrez les merveilles du Triangle d\'Or, les palais du Rajasthan et les trésors de l\'Inde du Nord. Des circuits sur-mesure pour une expérience inoubliable.',
                'meta_title' => 'Circuits Inde du Nord — India Tourisme',
                'meta_description' => 'Explorez les joyaux de l\'Inde du Nord, des monuments emblématiques aux villes sacrées',
                'is_active' => true,
            ],
            [
                'name' => '🇮🇳 Inde du Sud',
                'slug' => 'south-india',
                'description' => 'Découvrez la richesse culturelle et la beauté naturelle de l\'Inde du Sud, des backwaters du Kerala aux temples du Tamil Nadu.',
                'hero_title' => 'Circuits Inde du Sud',
                'hero_description' => 'Découvrez la douceur de vivre du Kerala, les temples du Tamil Nadu et les palais de Mysore. Des circuits sur-mesure pour une expérience authentique.',
                'meta_title' => 'Circuits Inde du Sud — India Tourisme',
                'meta_description' => 'Explorez les joyaux de l\'Inde du Sud, des backwaters de Kerala aux temples de Tamil Nadu',
                'is_active' => true,
            ],
            [
                'name' => '🇱🇰 Sri Lanka',
                'slug' => 'sri-lanka',
                'description' => 'Découvrez le paradis tropical du Sri Lanka avec ses villes anciennes, ses plages immaculées et sa riche biodiversité.',
                'hero_title' => 'Circuits Sri Lanka',
                'hero_description' => 'Découvrez l\'île de Ceylan, ses plages de rêve, ses temples bouddhiques et sa faune exceptionnelle. Des circuits sur-mesure pour une expérience inoubliable.',
                'meta_title' => 'Circuits Sri Lanka — India Tourisme',
                'meta_description' => 'Explorez les joyaux du Sri Lanka, des plages de Galle aux temples sacrés',
                'is_active' => true,
            ],
            [
                'name' => '🇳🇵 Népal',
                'slug' => 'nepal',
                'description' => 'Découvrez l\'Himalaya majestueux, les temples anciens et la culture riche du Népal, le toit du monde.',
                'hero_title' => 'Circuits Népal',
                'hero_description' => 'Découvrez le toit du monde, ses sommets himalayens, ses temples bouddhiques et sa culture millénaire. Des circuits sur-mesure pour une expérience authentique.',
                'meta_title' => 'Circuits Népal — India Tourisme',
                'meta_description' => 'Explorez les merveilles du Népal, de Katmandou aux sommets himalayens',
                'is_active' => true,
            ],
            [
                'name' => '🇧🇹 Bhoutan',
                'slug' => 'bhoutan',
                'description' => 'Découvrez le royaume du bonheur, le Bhoutan, avec ses monastères perchés, ses paysages himalayens et sa culture bouddhique préservée.',
                'hero_title' => 'Circuits Bhoutan',
                'hero_description' => 'Découvrez le royaume du bonheur, ses monastères himalayens, ses paysages à couper le souffle et sa culture bouddhique millénaire. Des circuits sur-mesure pour une expérience spirituelle unique.',
                'meta_title' => 'Circuits Bhoutan — India Tourisme',
                'meta_description' => 'Explorez les merveilles du Bhoutan, de Thimphou aux monastères himalayens',
                'is_active' => true,
            ],
        ];

        foreach ($destinations as $destination) {
            Destination::updateOrCreate(
                ['slug' => $destination['slug']],
                $destination
            );
        }
    }
}