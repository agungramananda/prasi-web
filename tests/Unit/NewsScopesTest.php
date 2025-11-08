<?php

namespace Tests\Unit;

use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;

class NewsScopesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function published_scope_includes_only_past_published_at_when_flag_enabled()
    {
        // create records
        $past = News::create([
            'title' => 'Past Item',
            'slug' => 'past-item',
            'content' => 'Content',
            'tags' => ['a'],
            'is_active' => true,
            'published_at' => Carbon::now()->subDay(),
        ]);
        $future = News::create([
            'title' => 'Future Item',
            'slug' => 'future-item',
            'content' => 'Content',
            'tags' => ['b'],
            'is_active' => true,
            'published_at' => Carbon::now()->addDay(),
        ]);
        $draft = News::create([
            'title' => 'Draft Item',
            'slug' => 'draft-item',
            'content' => 'Content',
            'tags' => ['c'],
            'is_active' => true,
            'published_at' => null,
        ]);

        $published = News::active()->published()->get();

        $this->assertTrue($published->contains('id', $past->id));
        $this->assertFalse($published->contains('id', $future->id));
        $this->assertFalse($published->contains('id', $draft->id));
    }
}
