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
        $user->name = "Jan Palacios";
        $user->email = "phobosentured@gmail.com";
        $user->password = bcrypt("secret123");
        $user->save();
    }
}
