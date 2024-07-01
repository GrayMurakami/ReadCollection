<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BookManager;
use Illuminate\Support\Facades\Hash;

class BookManagerSeeder extends Seeder
{
    public function run()
    {
        BookManager::create([
            'name' => 'Koby',
            'bookAdminID' => 'AdminKoby',
            'password' => Hash::make('00083315'),
        ]);

        BookManager::create([
            'name' => 'Yana',
            'bookAdminID' => 'BookBoss',
            'password' => Hash::make('33150008'),
        ]);

        BookManager::create([
            'name' => 'Jordan',
            'bookAdminID' => 'Manager0008',
            'password' => Hash::make('24242424'),
        ]);
    }
}
