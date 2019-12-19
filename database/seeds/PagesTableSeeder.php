<?php

use App\Pages;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pages::create([
            'title' => 'Terms of Use',
            'title_sef' => 'terms-of-use',
            'content' => 'Terms of Use',
        ]);

        Pages::create([
            'title' => 'Privacy Policy',
            'title_sef' => 'privacy-policy',
            'content' => 'Privacy Policy',
        ]);

        Pages::create([
            'title' => 'Contact',
            'title_sef' => 'contact',
            'content' => 'Contact',
        ]);
    }
}
