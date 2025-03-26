<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateDatabaseUser extends Command
{
    protected $signature = 'db:create-user {username} {password} {dbname}';

    protected $description = 'Create a new MySQL user and database with necessary permissions';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $ip = '14.64.16.10';
        $ip_localhost = 'localhost';

        $username = $this->argument('username');
        $password = $this->argument('password');
        $dbname = $this->argument('dbname');

        try {
            DB::connection('mysql2')->statement("CREATE DATABASE IF NOT EXISTS {$dbname}");
            DB::connection('mysql2')->statement("CREATE USER IF NOT EXISTS '{$username}'@'{$ip}' IDENTIFIED BY '{$password}'");
            DB::connection('mysql2')->statement("CREATE USER IF NOT EXISTS '{$username}'@'{$ip_localhost}' IDENTIFIED BY '{$password}'");
            if ($dbname) {
                DB::connection('mysql2')->statement("GRANT ALL PRIVILEGES ON {$dbname}.* TO '{$username}'@'{$ip}'");
                DB::connection('mysql2')->statement("GRANT ALL PRIVILEGES ON {$dbname}.* TO '{$username}'@'{$ip_localhost}'");
                DB::connection('mysql2')->statement('FLUSH PRIVILEGES');
            }

            $this->info("Database '{$dbname}' and user '{$username}' created successfully.");
        } catch (\Exception $e) {
            $this->error('Error: '.$e->getMessage());
        }
    }
}
