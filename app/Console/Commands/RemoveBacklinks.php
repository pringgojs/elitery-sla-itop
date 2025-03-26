<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class RemoveBacklinks extends Command
{
    protected $signature = 'remove:backlinks {column} {table} {dbname}';

    protected $description = 'Remove backlinks from WordPress posts';

    public function handle()
    {
        $table = $this->argument('table') ?? 'wp_posts';
        $column = $this->argument('column') ?? 'post_content';
        $database = $this->argument('dbname');
        $host = env('DB_HOST2');
        $username = env('DB_USERNAME2');
        $password = env('DB_PASSWORD2');
        $port = 3306;

        // Set the database connection dynamically
        Config::set('database.connections.dynamic', [
            'driver' => 'mysql',
            'host' => $host,
            'port' => $port,
            'database' => $database,
            'username' => $username,
            'password' => $password,
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ]);

        DB::setDefaultConnection('dynamic');

        $keywords = ['judi', 'slot', 'gacor', 'maxwin', 'zeus'];
        $keyword = implode('|', $keywords);

        // Regex pattern to match anchor tags containing specific keywords
        $backlinkPattern = '/<a[^>]*href=["\']?https?:\/\/[^\s>]*["\']?[^>]*>(?:[^<]*('.$keyword.')[^<]*)<\/a>/i';
        $hiddenContentPattern = '/<div[^>]*style=["\']?display\s*:\s*none["\']?[^>]*>.*?<\/div>/is';

        $posts = DB::table($table)->select('ID', $column)->get();

        foreach ($posts as $post) {
            $contentWithoutBacklinks = preg_replace($backlinkPattern, '', $post->$column);
            // Remove hidden content
            $cleanContent = preg_replace($hiddenContentPattern, '', $contentWithoutBacklinks);

            if ($cleanContent !== $post->$column) {
                try {
                    //code...
                    DB::table($table)
                        ->where('ID', $post->ID)
                        ->update([$column => $cleanContent]);

                    $this->info("Backlinks removed from post ID: {$post->ID}");
                } catch (\Throwable $th) {
                    $this->info('Ini bukan Wordpress');
                    //throw $th;
                }
            }
        }

        $this->info('Backlink removal process completed.');
    }
}
