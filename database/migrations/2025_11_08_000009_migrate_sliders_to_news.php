<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('sliders') || !Schema::hasTable('news')) {
            return; // missing tables
        }

        $sliders = DB::table('sliders')->get();
        foreach ($sliders as $slider) {
            $content = $slider->description ?? $slider->title ?? '';
            DB::table('news')->insert([
                'title' => $slider->title,
                'slug' => Str::slug($slider->title . '-' . $slider->id),
                'header_image' => $slider->image,
                'content' => $content,
                'tags' => json_encode([]),
                'is_active' => (bool)$slider->is_active,
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Schema::dropIfExists('sliders');
    }

    public function down(): void
    {
        // Cannot easily restore sliders table and original data automatically
    }
};
