<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Doe Jhon';
        $user->email = 'admin@admin.com';
        $user->email_verified_at = now();
        $user->role = '1';
        $user->password = bcrypt('123456');
        $user->save();


    }
}
