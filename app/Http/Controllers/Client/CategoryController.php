<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(string $id)
    {
        // dd($id);
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('client_home');
        }
        $categoryName = Category::find($id)->name;
        $blog = $category->blogs()->where('active','1')->paginate(3);
        // dd($blog);

        // dd($categoryName);
        return view('client.page.category', compact('categoryName', 'category', 'blog'));
    }
}
