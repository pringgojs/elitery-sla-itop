<?php

namespace App\Console\Commands;

use App\Services\DatabaseService;
use Illuminate\Console\Command;

class ShowDatabases extends Command
{
    protected $signature = 'db:show-databases';

    protected $description = 'Show all databases on the MySQL server';

    public function handle()
    {
        $service = new DatabaseService;
        $service->config();
        $databases = $service->getDatabase();

        dd($databases);
        $this->info('Databases on the MySQL server:');
        foreach ($databases as $db) {
            $this->line($db->Database);
        }
    }
}
