<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseService
{
    public function __construct()
    {
        // $this->config();
    }

    public function config($database = '')
    {
        $host = env('DB_HOST2');
        $username = env('DB_USERNAME2');
        $password = env('DB_PASSWORD2');
        $port = 3306;

        // Set the database connection dynamically
        Config::set('database.connections.dynamic', [
            'driver' => 'mysql',
            'host' => $host,
            'port' => $port,
            'database' => $database ?? null,
            'username' => $username,
            'password' => $password,
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ]);
        DB::setDefaultConnection('dynamic');
    }

    public function createAccount(User $user, string $username, string $password, string $dbname = '')
    {
        Artisan::call('db:create-user', [
            'username' => $username,
            'password' => $password,
            'dbname' => $dbname ?? null,
        ]);

        $params = ['id' => Str::uuid(), 'user_id' => $user->id, 'username' => $username, 'password' => EncryptService::encrypt($password), 'db_name' => $dbname];
        $model = UserDatabase::insert($params);

        return $model;
    }

    public function getDatabase(string $search = '')
    {
        $this->config();

        $where = '';
        if ($search) {
            $where = 'WHERE table_schema LIKE "%'.$search.'%"';
        }
        $query = 'SELECT 
                table_schema AS database_name,
                COUNT(table_name) AS table_count,
                SUM(data_length + index_length) AS total_size_bytes,
                MIN(create_time) AS created_at
            FROM 
                information_schema.tables
            '.$where.' 
            GROUP BY 
                table_schema;';

        return DB::select($query);
    }

    public function showDatabases()
    {
        $this->config();

        return DB::select('SHOW DATABASES');
    }

    public function getTables(string $database = '')
    {
        $this->config();

        return DB::select('SELECT table_name
            FROM information_schema.tables
            WHERE table_schema = ?
            ORDER BY table_name ASC', [$database]);
    }

    public function getColumns(string $database = '', string $table = '')
    {
        $this->config();
        $columns = DB::select('
            SELECT COLUMN_NAME as column_name
            FROM information_schema.columns
            WHERE table_schema = ?
            AND table_name = ?
            ORDER BY ordinal_position ASC
        ', [$database, $table]);

        return $columns;
    }

    public function getPrimaryKey(string $database = '', string $table = '')
    {
        $this->config();
        $columns = DB::select('
            SELECT COLUMN_NAME as column_name
            FROM information_schema.key_column_usage
            WHERE table_schema = ?
            AND table_name = ?
            AND constraint_name = "PRIMARY"
        ', [$database, $table]);

        return $columns;
    }

    public function getUserAccounts(string $search = '')
    {
        $this->config();
        $where = '';
        if ($search) {
            $where = "WHERE User LIKE '%".$search."%'";
        }

        $query = 'SELECT User, Host FROM mysql.user';

        return DB::select($query);
    }
}
