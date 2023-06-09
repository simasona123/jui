<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class CreateTestUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-test-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membuat users untuk masing-masing role';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::firstOrCreate([
            'full_name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'verification' => true,
        ]);

        $user->assignRole('administrator');

        $user = User::firstOrCreate([
            'full_name' => 'manajer',
            'email' => 'manajer@manajer.com',
            'password' => Hash::make('admin123'),
            'verification' => true,
        ]);

        $user->assignRole('manajer');

        $user = User::firstOrCreate([
            'full_name' => 'klien',
            'email' => 'klien@klien.com',
            'password' => Hash::make('admin123'),
            'verification' => true,
        ]);

        $user->assignRole('klien');

        $user = User::firstOrCreate([
            'full_name' => 'dokter',
            'email' => 'dokter@dokter.com',
            'password' => Hash::make('admin123'),
            'verification' => true,
        ]);

        $user->assignRole('dokter-hewan');
    }
}
