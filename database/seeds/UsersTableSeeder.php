<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder{
  public function run(){
    DB::table('users')->delete();

    App\User::create([
      'email'=>'root',
      'email'=>'root@example.com',
      'password'=>Hash::make('password'),
    ]);
  }
}