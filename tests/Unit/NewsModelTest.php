<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\News;
use Illuminate\Support\Facades\Storage;

class NewsModelTest extends TestCase
{
    /** @test */
    public function header_image_url_returns_null_without_image()
    {
        $news = new News();
        $this->assertNull($news->header_image_url);
    }

    /** @test */
    public function header_image_url_returns_asset_path_for_local_disk()
    {
        config(['filesystems.default' => 'local']);
        $news = new News(['header_image' => 'news/example.jpg']);
        $this->assertStringContainsString('/storage/news/example.jpg', $news->header_image_url);
    }
}
