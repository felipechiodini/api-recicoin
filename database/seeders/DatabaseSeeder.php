<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Felipe Bona',
            'email' => 'felipechiodinibona@hotmail.com',
            'document' => '11048424910',
            'password' => Hash::make('132567'),
            'cellphone' => '47999097073',
        ]);
    }
}
