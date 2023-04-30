<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class FirstSetUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:first-set-up';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'First Set Up';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Artisan::call('app:setup-role');
        $this->info('Role has been setup');
        Artisan::call('app:create-test-user');
        $this->info('Users has been created');

    }
}
