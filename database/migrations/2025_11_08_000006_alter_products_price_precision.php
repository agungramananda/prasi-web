<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $driver = DB::getDriverName();
        // Only run on MySQL/MariaDB; SQLite used in tests doesn't support MODIFY
        if (in_array($driver, ['mysql', 'mariadb'])) {
            DB::statement('ALTER TABLE products MODIFY price DECIMAL(12,2)');
        }
    }

    public function down(): void
    {
        $driver = DB::getDriverName();
        if (in_array($driver, ['mysql', 'mariadb'])) {
            DB::statement('ALTER TABLE products MODIFY price DECIMAL(10,2)');
        }
    }
};
