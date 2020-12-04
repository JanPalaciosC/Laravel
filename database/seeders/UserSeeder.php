<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Sergio Rojas Noris";
        $user->email = "sergio@email.com";
        $user->password = bcrypt("secret");
        $user->role = 'admin';
        $user->save();
    }
}
