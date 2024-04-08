<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class HomePageController extends Controller
{
    /**
     * Handle the incoming request.
     */

    //  this is a controller for only 1 request for a single page
    public function __invoke(Request $request)
    {
        // we will cache the featured posts
        $featured_posts = Cache::remember('featured_posts', Carbon::now()->addDay(), function () {
            return Post::Published()
                ->Featured()
                ->take(3)
                ->get();
        });

        $latest_posts = Cache::remember('latest_posts', Carbon::now()->addDay(), function () {
            return Post::Published()->take(5)->get();
            
        });
        return view('home')
            ->with('latest_posts', $latest_posts)
            ->with('featured_posts', $featured_posts);
    }
}
