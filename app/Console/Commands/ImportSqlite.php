<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportSqlite extends Command
{
    protected $signature = 'import:sqlite';
    protected $description = 'Import data dari SQLite ke PostgreSQL (Supabase)';

    public function handle()
    {
        $sqlite = new \PDO('sqlite:' . database_path('database.sqlite'));

        $tables = [
            'users',
            'categories',
            'complaints',
            'responses',
        ];

        DB::statement('SET session_replication_role = replica');

        foreach ($tables as $table) {

            $this->info("Import tabel: {$table}");

            $rows = $sqlite->query("SELECT * FROM {$table}")
                           ->fetchAll(\PDO::FETCH_ASSOC);

            if (count($rows) == 0) {
                $this->warn("Tidak ada data.");
                continue;
            }

            DB::table($table)->truncate();

            foreach ($rows as $row) {
                DB::table($table)->insert($row);
            }

            $this->info(count($rows)." data berhasil diimport.");
        }

        DB::statement('SET session_replication_role = DEFAULT');

        $this->info('====================================');
        $this->info('Import selesai.');
    }
}