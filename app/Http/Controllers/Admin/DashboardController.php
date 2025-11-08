<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\News;
use App\Models\SocialMedia;
use App\Models\EcommerceLink;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products' => Product::count(),
            'active_products' => Product::where('is_active', true)->count(),
            'featured_products' => Product::where('is_featured', true)->count(),
            'news' => News::count(),
            'social_media' => SocialMedia::count(),
            'ecommerce_links' => EcommerceLink::count(),
            'messages' => ContactMessage::count(),
            'unread_messages' => ContactMessage::where('is_read', false)->count(),
        ];

        $recent_products = Product::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_products'));
    }
}
