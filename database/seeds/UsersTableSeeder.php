<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Truncating users table');
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        for ($i=0; $i < 10; $i++) {
            $name = 'User ' . ($i + 1);
            $user = User::create([
                'name' => $name,
                'password' => Hash::make('password'),
                'email' => strtolower(str_replace(' ', '', $name)) . '@gmail.com',
                'email_verified_at' => now(),
            ]);
            $this->command->info('Creating ' . $user->name);
            sleep(1);
        }

    }
}
