<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\banner;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog1 = Blog::where('active', '1')->orderBy('id', 'desc')->skip(0)->take(1)->first();
        $blog2 = Blog::where('active', '1')->orderBy('id', 'desc')->skip(1)->take(1)->first();
        $blog3 = Blog::where('active', '1')->orderBy('id', 'desc')->skip(2)->take(1)->first();
        $blog4 = Blog::where('active', '1')->orderBy('id', 'desc')->skip(3)->take(1)->first();
        $blog5 = Blog::where('active', '1')->orderBy('id', 'desc')->skip(4)->take(1)->first();

        #lấy sản phẩm theo danh mục
        $categories = Category::with('blogs')->get();
        // dd($categories);

        #lấy Banners

        $banners = banner::all();
        // dd($banners);

        // $test = Blog::find(1);
        // $users = $test->users; // Lấy danh sách người dùng liên quan đến bài viết
        // $test1 = $users->pluck('name'); // Lấy danh sách tên của người dùng
        // dd($test1);

        // $test = Blog::find(2);
        // $users = $test->users->name; // Lấy thông tin người dùng của bài viết
        // dd($users);

        return view('Client.page.home', compact('blog1', 'blog2', 'blog3', 'blog4', 'blog5', 'categories', 'banners'));
    }
    public function testmail()
    {
        $name = 'Nguyễn Tuấn Kiệt';
        Mail::send('email.test', compact('name'), function ($email) {
            $email->subject('Test Mail');
            $email->to('tuankiet.aye24@gmail.com', 'tintuc24h.com');
        });
    }
}
