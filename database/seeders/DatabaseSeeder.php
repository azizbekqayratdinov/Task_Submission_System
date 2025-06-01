<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Group;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Subject::create([
            'name'=>"Matematika"
        ]);
        Subject::create([
            'name'=>"Fizika"
        ]);
        Subject::create([
            'name'=>"Informatika"
        ]);
        Subject::create([
            'name'=>"Qaraqalpaq-tili"
        ]);

        Group::create([
            'name'=>"204-22-DI-RUS"
        ]);
        Group::create([
            'name'=>"205-21-MT-KK"
        ]);
        Group::create([
            'name'=>"104-20-IT-RUS"
        ]);
        User::create([
            'name'=>"Azizbek",
            'email'=>"aziz@gmail.com",
            'password'=>Hash::make(111),
            'role'=>"teacher"
        ]);    
        User::create([
            'name'=>"Adminbek",
            'email'=>"admin@gmail.com",
            'password'=>Hash::make(111),
            'role'=>"admin"
        ]);
        User::create([
            'name'=>"Aybergen",
            'email'=>"ayba@gmail.com",
            'password'=>Hash::make(111),
            'role'=>"teacher"
        ]);      
    }
}
