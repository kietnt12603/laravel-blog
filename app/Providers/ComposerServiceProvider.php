<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\WebConfiguration;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(['client.blocks.main'], function ($view) {
            $categories = Category::where('menu_active', '1')->has('blogs')->get();
            $categories_all = Category::all();
            $web_configuration = WebConfiguration::find(1);
            $view->with(['categoriesMenu' => $categories, 'categories' => $categories_all, 'web_configuration' => $web_configuration]);
        });
        View::composer(['client.page.blog.blog', 'client.page.category','client.page.blog.blogDetail','client.blocks.main', 'client.page.search'], function ($view) {
            $blogView = Blog::where('active',1)->orderBy('view', 'desc')->skip(0)->take(3)->get();
            $categoryAll = Category::all();
            $view->with('blogView', $blogView)->with('categoryAll', $categoryAll);
        });
    }
}
