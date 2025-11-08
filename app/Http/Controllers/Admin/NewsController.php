<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $query = News::query();
        $search = request('q');
        $tag = request('tag');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%$search%");
                $q->orWhere('content', 'like', "%$search%");
            });
        }
        if ($tag) {
            $query->whereJsonContains('tags', $tag);
        }

        $news = $query->orderByDesc('published_at')->orderByDesc('created_at')->paginate(15)->withQueryString();

        // Collect distinct tags for filtering UI
        $allTags = News::select('tags')->get()->pluck('tags')->flatten()->filter()->unique()->values();

        return view('admin.news.index', compact('news', 'search', 'tag', 'allTags'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title_id' => ['required','string','max:255'],
            'title_en' => ['nullable','string','max:255'],
            'slug' => ['nullable','string','max:255','unique:news,slug'],
            'content_id' => ['required','string'],
            'content_en' => ['nullable','string'],
            'tags' => ['nullable','string'], // comma separated
            'header_image' => ['nullable','image','max:10240'],
            'is_active' => ['sometimes','boolean'],
            // published_at removed from form: we'll set it automatically to now()
        ]);

        if ($request->hasFile('header_image')) {
            $disk = config('filesystems.default') === 'digitalocean' ? 'digitalocean' : 'public';
            $data['header_image'] = $request->file('header_image')->store('news', $disk);
        }

        if (!empty($data['tags'])) {
            $tags = array_values(array_filter(array_map(fn($t) => trim($t), explode(',', $data['tags']))));
            $data['tags'] = $tags;
        } else {
            $data['tags'] = [];
        }

        if (empty($data['slug']) && !empty($data['title_id'])) {
            $base = Str::slug($data['title_id']);
            $slug = $base;
            $i = 1;
            while (News::where('slug', $slug)->exists()) {
                $slug = $base.'-'.$i++;
            }
            $data['slug'] = $slug;
        }

        $data['is_active'] = (bool)($data['is_active'] ?? true);

        $news = new News();
        $news->fill([
            'slug' => $data['slug'] ?? null,
            'header_image' => $data['header_image'] ?? null,
            'tags' => $data['tags'],
            'is_active' => $data['is_active'],
            // set published_at to now() on create
            'published_at' => now(),
        ]);
        // Set translations
        $news->setTranslations('title', [
            'id' => $data['title_id'],
            'en' => $data['title_en'] ?? $data['title_id'],
        ]);
        $news->setTranslations('content', [
            'id' => $data['content_id'],
            'en' => $data['content_en'] ?? $data['content_id'],
        ]);
        $news->save();

        return redirect()->route('admin.news.index')->with('success', 'News created');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $data = $request->validate([
            'title_id' => ['required','string','max:255'],
            'title_en' => ['nullable','string','max:255'],
            'slug' => ['nullable','string','max:255','unique:news,slug,'.$news->id],
            'content_id' => ['required','string'],
            'content_en' => ['nullable','string'],
            'tags' => ['nullable','string'],
            'header_image' => ['nullable','image','max:102048'],
            'is_active' => ['sometimes','boolean'],
            // published_at removed from form: we set it automatically to now() on update
        ]);

        if ($request->hasFile('header_image')) {
            $disk = config('filesystems.default') === 'digitalocean' ? 'digitalocean' : 'public';
            if ($news->header_image) {
                Storage::disk($disk)->delete($news->header_image);
            }
            $data['header_image'] = $request->file('header_image')->store('news', $disk);
        }

        if (!empty($data['tags'])) {
            $tags = array_values(array_filter(array_map(fn($t) => trim($t), explode(',', $data['tags']))));
            $data['tags'] = $tags;
        } else {
            $data['tags'] = [];
        }

        if (empty($data['slug']) && !empty($data['title_id'])) {
            $base = Str::slug($data['title_id']);
            $slug = $base;
            $i = 1;
            while (News::where('slug', $slug)->where('id','!=',$news->id)->exists()) {
                $slug = $base.'-'.$i++;
            }
            $data['slug'] = $slug;
        }

        $data['is_active'] = (bool)($data['is_active'] ?? true);

        // Fill non-translatable
        $news->fill([
            'slug' => $data['slug'] ?? $news->slug,
            'tags' => $data['tags'],
            'is_active' => $data['is_active'],
            // set published_at to now() on update (publish immediately)
            'published_at' => now(),
            'header_image' => $data['header_image'] ?? $news->header_image,
        ]);
        // header image handled above
        // Set translations
        $news->setTranslations('title', [
            'id' => $data['title_id'],
            'en' => $data['title_en'] ?? $data['title_id'],
        ]);
        $news->setTranslations('content', [
            'id' => $data['content_id'],
            'en' => $data['content_en'] ?? $data['content_id'],
        ]);
        $news->save();

        return redirect()->route('admin.news.index')->with('success', 'News updated');
    }

    public function destroy(News $news)
    {
        if ($news->header_image) {
            $disk = config('filesystems.default') === 'digitalocean' ? 'digitalocean' : 'public';
            Storage::disk($disk)->delete($news->header_image);
        }
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'News deleted');
    }
}
