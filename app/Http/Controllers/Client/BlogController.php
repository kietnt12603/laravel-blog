<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogAll = Blog::where('active', 1)->paginate(5);
        $categoryAll = Category::all();
        // dd($blogAll);
        $category = Category::find(1);
        $blogsCount = $category->blogsCount();
        // dd($blogsCount);
        // dd($blogView);
        return view('client.page.blog.blog', compact('blogAll'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blogDetail = Blog::where('id', $id)->where('active', 1)->first();
        if (!$blogDetail) {
            return redirect()->route('client_home');
        } else {
            $category = $blogDetail->category;
            $blogDetail->view = $blogDetail->view + 1;
            $blogDetail->save();
            $relatedBlogs = $category->blogs()
                ->where('active', 1)
                ->where('id', '!=', $id) // Loại trừ bài viết hiện tại
                ->limit(4) // Số lượng bài viết cùng danh mục bạn muốn lấy
                ->get();
        }
        $commentCount = Comment::where('blog_id', $id)->count();
        $categoryAll = Category::all();
        $author = Blog::find($id)->users;
        // dd($author);
        $topLevelComments = $blogDetail->comments()->whereNull('parent_id')->get();
        // dd($topLevelComments);

        return view('client.page.blog.blogDetail', compact('blogDetail', 'categoryAll', 'author', 'commentCount', 'relatedBlogs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
