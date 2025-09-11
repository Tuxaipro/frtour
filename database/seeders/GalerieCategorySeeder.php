<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GalerieCategory;

class GalerieCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Paysages',
                'description' => 'Magnifiques paysages d\'Inde, du Sri Lanka et du Népal',
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'Monuments',
                'description' => 'Monuments historiques et sites culturels emblématiques',
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'name' => 'Culture',
                'description' => 'Traditions, festivals et vie quotidienne locale',
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'name' => 'Aventure',
                'description' => 'Activités d\'aventure et sports de plein air',
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'name' => 'Gastronomie',
                'description' => 'Cuisine locale et spécialités culinaires',
                'is_active' => true,
                'sort_order' => 5
            ],
            [
                'name' => 'Vie sauvage',
                'description' => 'Faune et flore des parcs nationaux et réserves',
                'is_active' => true,
                'sort_order' => 6
            ]
        ];

        foreach ($categories as $category) {
            GalerieCategory::create($category);
        }
    }
}
