<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ThemeSeeder extends Seeder
{
    public function run()
    {
        $themes = [
            [
                'name' => 'Default',
                'slug' => 'default',
                'description' => 'The default theme for the website.',
                'version' => '1.0.0',
                'status' => true,
                'preview_link' => 'dfsdf',
                'assets_path' => 'theme1',
                'preview_image' => 'themes/default/preview.png',
                'options' => json_encode([
                    'primary_color' => '#3498db',
                    'secondary_color' => '#2ecc71',
                    'font_family' => 'Arial, sans-serif',
                    'layout' => 'boxed',
                ]),
            ],
            [
                'name' => 'theme 2',
                'slug' => 'dark',
                'description' => 'Dark mode theme for night mode lovers.',
                'version' => '1.0.0',
                'status' => true,
                'preview_link' => 'dfsdf',
                'assets_path' => 'theme2',
                'preview_image' => 'themes/dark/preview.png',
                'options' => json_encode([
                    'primary_color' => '#2c3e50',
                    'secondary_color' => '#34495e',
                    'font_family' => 'Helvetica, sans-serif',
                    'layout' => 'full-width',
                ]),
            ],
            [
                'name' => 'theme 3',
                'slug' => 'modern',
                'description' => 'Modern and sleek design theme.',
                'version' => '1.0.0',
                'status' => true,
                'preview_link' => 'fsdf',
                'assets_path' => 'theme3',
                'preview_image' => 'themes/modern/preview.png',
                'options' => json_encode([
                    'primary_color' => '#e74c3c',
                    'secondary_color' => '#f1c40f',
                    'font_family' => 'Roboto, sans-serif',
                    'layout' => 'wide',
                ]),
            ],
            [
                'name' => 'theme 4',
                'slug' => 'modern',
                'description' => 'Modern and sleek design theme.',
                'version' => '1.0.0',
                'status' => true,
                'preview_link' => 'test',
                'assets_path' => 'theme4',
                'preview_image' => 'themes/modern/preview.png',
                'options' => json_encode([
                    'primary_color' => '#e74c3c',
                    'secondary_color' => '#f1c40f',
                    'font_family' => 'Roboto, sans-serif',
                    'layout' => 'wide',
                ]),
            ],
        ];

        foreach ($themes as $theme) {
            DB::table('themes')->updateOrInsert(
                ['slug' => $theme['slug']],
                $theme
            );
        }
    }
}
