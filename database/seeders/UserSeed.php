<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!User::Where('email','teste@gmail.com')->first()){
            $adminMaster = User::create([
                'name'=>"teste",
                'email'=>'teste@gmail.com',
                'password'=>Hash::make('123456',['rounds'=>12])
            ]);
        }
    }
}
