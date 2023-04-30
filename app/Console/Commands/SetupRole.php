<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class SetupRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup-role';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set Up Role Laravel Spatie';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $role = Role::create(['name' => 'administrator']);
        $role = Role::create(['name' => 'klien']);
        $role = Role::create(['name' => 'manajer']);
        $role = Role::create(['name' => 'dokter-hewan']);
    }
}
