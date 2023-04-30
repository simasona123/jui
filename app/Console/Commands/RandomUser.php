<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class RandomUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate 100 Users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        for ($i=0; $i < 90 ; $i++) { 
            if($i < 10){
                $user = User::firstOrCreate([
                    'full_name' => 'admin' . $i,
                    'email' => 'admin'. $i .'@admin.com',
                    'password' => Hash::make('admin123'),
                    'verification' => true,
                ]);

                $user->assignRole('administrator');

            }
            else if($i < 80){
                $user = User::firstOrCreate([
                    'full_name' => 'klien' . $i,
                    'email' => 'klien' . $i . '@admin.com',
                    'password' => Hash::make('admin123'),
                    'verification' => true,
                ]);

                $user->assignRole('klien');
            }
           else if($i < 85){
                $user = User::firstOrCreate([
                    'full_name' => 'dokter' . $i,
                    'email' => 'dokter' . $i . '@admin.com',
                    'password' => Hash::make('admin123'),
                    'verification' => true,
                ]);

                $user->assignRole('dokter-hewan');
            }
            else{
                $user = User::firstOrCreate([
                    'full_name' => 'manajer' . $i,
                    'email' => 'manajer' . $i . '@admin.com',
                    'password' => Hash::make('admin123'),
                    'verification' => true,
                ]);

                $user->assignRole('manajer');
            }
        }
    }
}
