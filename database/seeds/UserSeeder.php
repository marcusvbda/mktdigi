<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $this->createUsers();
    }

    private function createUsers()
    {
        DB::table("users")->truncate();
        User::create([
            "name" => "Driely Aoyama",
            "email" => "driely.aoyama@gmail.com",
            "password" => bcrypt("123456"),
            "confirmed_at" => now(),
        ]);
    }
}
