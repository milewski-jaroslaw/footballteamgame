<?php

namespace App\Console\Commands;

use Database\Factories\UserFactory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $email    = $this->ask('Enter the email address:');
        $password = $this->secret('Enter the password:');
        $username = $this->secret('Enter the username:');

        UserFactory::new()->create([
            'email' => $email,
            'password' => Hash::make($password),
            'username' => $username,
        ]);

        $this->info('User created successfully!');
    }
}
