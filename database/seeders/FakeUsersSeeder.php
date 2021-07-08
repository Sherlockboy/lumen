<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class FakeUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Khurshid',
            'email' => 'kabilovhurshid5@gmail.com',
            'password' => app('hash')->make('password')
        ]);
        
        User::factory()->times(100)->create();
    }
}
