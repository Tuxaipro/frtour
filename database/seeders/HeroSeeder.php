<?php

namespace Database\Seeders;

use App\Models\Hero;
use Illuminate\Database\Seeder;

class HeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hero::create([
            'title' => 'Voyages <span class="text-primary">sur‑mesure</span> en Inde,<br class="hidden sm:block"> Sri Lanka, Népal & Bhoutan',
            'subtitle' => 'Circuits privés, chauffeurs anglophones/francophones, assistance 24/7 — pour voyageurs exigeants, agences et MICE.',
            'description' => null,
            'primary_button_text' => 'Demander un devis',
            'primary_button_url' => '#devis',
            'secondary_button_text' => 'WhatsApp',
            'secondary_button_url' => 'https://wa.me/XXXXXXXXXXX',
            'tertiary_button_text' => 'RDV visio 15 min',
            'tertiary_button_url' => 'https://calendly.com/votre-calendly/rdv-15min',
            'background_image' => null,
            'badge_text' => 'DMC certifié ISO 9001:2015',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Hero::create([
            'title' => 'Découvrez l\'<span class="text-primary">authenticité</span> de l\'Asie du Sud',
            'subtitle' => 'Des expériences uniques et personnalisées pour créer des souvenirs inoubliables.',
            'description' => 'Notre expertise locale et notre réseau de partenaires de confiance vous garantissent un voyage exceptionnel.',
            'primary_button_text' => 'Voir nos circuits',
            'primary_button_url' => '#circuits',
            'secondary_button_text' => 'Consulter nos tarifs',
            'secondary_button_url' => '#devis',
            'tertiary_button_text' => 'Télécharger le catalogue',
            'tertiary_button_url' => '#',
            'background_image' => null,
            'badge_text' => 'Plus de 15 ans d\'expérience',
            'is_active' => true,
            'sort_order' => 2,
        ]);
    }
}