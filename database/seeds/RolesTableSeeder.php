<?php

use App\Userroles;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Userroles::create([
            'user_id' => 1,
            'role_name' => 'admin',
        ]);
    }
}
