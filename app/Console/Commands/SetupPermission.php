<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;

class SetupPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spatie:setup-permission {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set Up all Permissions to a model';

    /**
     * Execute the console command.
     */
    public function handle()
    {   
        $model = $this->argument('model');

        $x = [
            'index', 'create', 'update', 'delete'
        ];

        foreach ($x as $item){
            $permission = Permission::create(['name' => $model."-".$item]);
        }


    }
}
