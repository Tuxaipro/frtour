<?php

namespace Database\Seeders;

use App\Models\Circuit;
use App\Models\Destination;
use Illuminate\Database\Seeder;

class CircuitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some destinations
        $northIndia = Destination::where('slug', 'north-india')->first();
        $southIndia = Destination::where('slug', 'south-india')->first();
        $nepal = Destination::where('slug', 'nepal')->first();
        
        if (!$northIndia || !$southIndia || !$nepal) {
            $this->command->info('Please run DestinationSeeder first.');
            return;
        }
        
        // Create sample circuits
        $circuits = [
            [
                'name' => 'Trésors de l\'Inde du Sud',
                'slug' => 'tresors-inde-sud',
                'description' => 'Découvrez les merveilles de l\'Inde du Sud lors de ce voyage exceptionnel. Explorez les temples colorés de Madurai, les palais de Mysore et les plantations de thé des collines de Coorg. Ce circuit vous emmène à la découverte de la culture, de la gastronomie et des traditions millénaires de cette région fascinante.',
                'duration_days' => 12,
                'price_from' => 2450.00,
                'highlights' => "Visite des temples de Madurai et Rameswaram\nDécouverte des palais de Mysore et de Bangalore\nExploration des plantations de thé de Coorg\nCroisière sur le Kerala Backwaters\nSafari dans le parc national de Bandipur",
                'itinerary' => "Jour 1-3: Chennai - Pondichéry - Thanjavur\nJour 4-5: Madurai - Rameswaram\nJour 6-7: Coorg - Mysore\nJour 8-9: Bangalore - Ooty\nJour 10-12: Kerala Backwaters - Kochi",
                'destination_id' => $southIndia->id,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Himalaya et Terai Népalais',
                'slug' => 'himalaya-terai-nepal',
                'description' => 'Un voyage épique à travers le Népal, depuis les sommets himalayens jusqu\'aux jungles du sud. Cette aventure vous emmène de Katmandou aux temples de Boudhanath, en passant par les villages traditionnels de la vallée de Kathmandu et les jungles de Chitwan pour un safari unique.',
                'duration_days' => 14,
                'price_from' => 2850.00,
                'highlights' => "Visite des temples et monastères de Katmandou\nVol vers le mont Everest pour une vue imprenable\nSafari photographique dans le parc de Chitwan\nRandonnée dans la vallée de Kathmandu\nObservation des éléphants dans leur habitat naturel",
                'itinerary' => "Jour 1-3: Arrivée à Katmandou - Exploration de la vallée\nJour 4-5: Vol vers Lukla - Trek vers Everest Base Camp\nJour 6-8: Retour à Katmandou - Vol vers Pokhara\nJour 9-11: Pokhara - Exploration du lac Phewa\nJour 12-14: Safari à Chitwan - Retour à Katmandou",
                'destination_id' => $nepal->id,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Trésors de l\'Inde du Nord',
                'slug' => 'tresors-inde-nord',
                'description' => 'Découvrez les merveilles de l\'Inde du Nord lors de ce voyage exceptionnel. Explorez le Triangle d\'Or (Delhi, Agra, Jaipur), les palais de Rajasthan et les temples sacrés. Ce circuit vous emmène à la découverte de l\'histoire, de la culture et de l\'architecture millénaires de cette région fascinante.',
                'duration_days' => 10,
                'price_from' => 2150.00,
                'highlights' => "Visite du Taj Mahal à Agra\nExploration des palais de Jaipur\nDécouverte de Delhi et ses monuments\nCroisière sur le lac Pichola à Udaipur\nSafari dans le parc national de Ranthambore",
                'itinerary' => "Jour 1-2: Arrivée à Delhi - Visite de la ville\nJour 3-4: Agra - Taj Mahal et monuments\nJour 5-7: Jaipur - Palais et forteresses\nJour 8-9: Udaipur - Ville des lacs\nJour 10: Ranthambore - Safari et retour",
                'destination_id' => $northIndia->id,
                'is_active' => true,
                'sort_order' => 1,
            ],
        ];
        
        foreach ($circuits as $circuitData) {
            Circuit::updateOrCreate(
                ['slug' => $circuitData['slug']],
                $circuitData
            );
        }
        
        $this->command->info('Circuits seeded successfully!');
    }
}