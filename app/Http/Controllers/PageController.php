<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\News;
use App\Models\SocialMedia;
use App\Models\EcommerceLink;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Models\ContactMessage;

class PageController extends Controller
{
    public function home()
    {
    $locale = app()->getLocale();
    $featuredProducts = Cache::remember("home.featuredProducts.$locale", 300, fn() => Product::featured()->take(6)->get());
    $news = Cache::remember("home.news.$locale", 300, function () {
        $query = News::active();
        if (config('features.news_require_published_at')) {
            $query->published();
        }
        return $query->latest('published_at')->take(10)->get();
    });
    $socialMedia = Cache::remember("home.socialMedia", 600, fn() => SocialMedia::active()->get());
    $ecommerceLinks = Cache::remember("home.ecommerceLinks", 600, fn() => EcommerceLink::active()->get());

    return view('home', compact('featuredProducts', 'news', 'socialMedia', 'ecommerceLinks'));
    }

    public function newsIndex(Request $request)
    {
        $query = News::active();
        if (config('features.news_require_published_at')) {
            $query->published();
        }
        // basic filtering by tag for public listing
        if ($tag = $request->query('tag')) {
            $query->whereJsonContains('tags', $tag);
        }
        $news = $query->orderByDesc('published_at')->orderByDesc('created_at')->paginate(12)->withQueryString();
        return view('news.index', compact('news'));
    }

    public function newsShow(string $slug)
    {
        $query = News::where('slug', $slug)->active();
        if (config('features.news_require_published_at')) {
            $query->published();
        }
        $item = $query->firstOrFail();

        // load related (recent others) excluding current
        $relatedQuery = News::active()->where('id', '!=', $item->id);
        if (config('features.news_require_published_at')) {
            $relatedQuery->published();
        }
        $related = $relatedQuery->latest('published_at')->take(6)->get();

        return view('news.show', [
            'item' => $item,
            'related' => $related,
        ]);
    }

    public function about()
    {
        return view('pages.about');
    }

    public function products()
    {
        $products = Product::active()->paginate(12);
        return view('pages.products', compact('products'));
    }

    public function productShow(string $slug)
    {
        $query = Product::where('slug', $slug)->active();
        $item = $query->firstOrFail();

        // related products (exclude current)
        $related = Product::active()->where('id', '!=', $item->id)->latest()->take(6)->get();

        return view('products.show', [
            'item' => $item,
            'related' => $related,
        ]);
    }

    public function contact()
    {
        $socialMedia = SocialMedia::active()->get();
        $ecommerceLinks = EcommerceLink::active()->get();
        return view('pages.contact', compact('socialMedia', 'ecommerceLinks'));
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'phone' => ['nullable', 'string', 'max:50'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:2000'],
            'website' => ['nullable', 'max:0'],
        ]);

        unset($validated['website']);
        ContactMessage::create($validated);

        return back()->with('status', __('Pesan Anda telah dikirim. Terima kasih!'));
    }
}
