<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        // Ensure all existing rows have slug (should be done prior). This migration will make the column NOT NULL.
        $driver = DB::getDriverName();

        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE `products` MODIFY `slug` VARCHAR(255) NOT NULL UNIQUE");
            return;
        }

        if ($driver === 'pgsql') {
            DB::statement('ALTER TABLE "products" ALTER COLUMN slug SET NOT NULL');
            DB::statement('CREATE UNIQUE INDEX IF NOT EXISTS products_slug_unique ON products (slug)');
            return;
        }

        if ($driver === 'sqlite') {
            // SQLite doesn't support MODIFY; rebuild table safely.
            // Get current schema and rebuild table with slug NOT NULL.
            Schema::create('products_temp', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->text('description');
                $table->decimal('price', 10, 2);
                $table->string('image')->nullable();
                $table->string('category')->nullable();
                $table->boolean('is_featured')->default(false);
                $table->boolean('is_active')->default(true);
                $table->string('slug')->unique();
                $table->timestamps();
            });

            // Copy data
            $columns = ['id','name','description','price','image','category','is_featured','is_active','slug','created_at','updated_at'];
            $cols = implode(',', array_map(fn($c) => '"' . $c . '"', $columns));
            DB::statement("INSERT INTO products_temp ($cols) SELECT $cols FROM products");

            Schema::dropIfExists('products');
            Schema::rename('products_temp', 'products');
            return;
        }

        // Fallback: try to use change(); may require doctrine/dbal
        Schema::table('products', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable(false)->change();
        });
    }

    public function down(): void
    {
        $driver = DB::getDriverName();
        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE `products` MODIFY `slug` VARCHAR(255) NULL");
            return;
        }

        if ($driver === 'pgsql') {
            DB::statement('ALTER TABLE "products" ALTER COLUMN slug DROP NOT NULL');
            return;
        }

        if ($driver === 'sqlite') {
            // Rebuild to make slug nullable
            Schema::create('products_temp', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->text('description');
                $table->decimal('price', 10, 2);
                $table->string('image')->nullable();
                $table->string('category')->nullable();
                $table->boolean('is_featured')->default(false);
                $table->boolean('is_active')->default(true);
                $table->string('slug')->nullable();
                $table->timestamps();
            });

            $columns = ['id','name','description','price','image','category','is_featured','is_active','slug','created_at','updated_at'];
            $cols = implode(',', array_map(fn($c) => '"' . $c . '"', $columns));
            DB::statement("INSERT INTO products_temp ($cols) SELECT $cols FROM products");

            Schema::dropIfExists('products');
            Schema::rename('products_temp', 'products');
            return;
        }

        Schema::table('products', function (Blueprint $table) {
            $table->string('slug')->nullable()->change();
        });
    }
};
