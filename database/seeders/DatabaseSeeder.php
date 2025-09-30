<?php

namespace Database\Seeders;

use App\Models\AiModel;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a user with specific details
        User::factory()->create([
            'name' => 'aaaa',  // Name of the user
            'email' => 'bedoadly12@gmail.com',  // Email of the user
            'password' => Hash::make('Pa$$w0rd!'),  // Hash the password before storing it
            'email_verified_at' => now(),  // Mark email as verified
            'age' => 30,  // Example age, set it if needed
            'gender' => 'Male',  // Example gender, set it if needed
        ]);
        AiModel::create(['name' => 'Brain', 'type' => 'DL']);
        AiModel::create(['name' => 'Skin', 'type' => 'DL']);
        AiModel::create(['name' => 'Lung', 'type' => 'ML']);
        AiModel::create(['name' => 'Breast', 'type' => 'ML']);
        AiModel::create(['name' => 'Kidney', 'type' => 'DL']);
        AiModel::create(['name' => 'Oral', 'type' => 'DL']);
        AiModel::create(['name' => 'Thyroid', 'type' => 'ML']);
        AiModel::create(['name' => 'Prostate', 'type' => 'ML']);
        AiModel::create(['name' => 'Colorectal', 'type' => 'DL']);
    }
}
