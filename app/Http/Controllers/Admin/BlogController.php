<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $title = 'Bài Viết';
        if (Auth::user()->role->name == 'author') {
            $blogall = Blog::where('author', Auth::user()->id)->paginate(6);
        } else {
            $blogall = Blog::paginate(4);
        }
        $category = Category::all();
        return view('admin.page.blog.list', compact('title', 'blogall', 'category'));
    }

    public function store(Request $request)
    {
        // dd($request->image);
        $imgName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imgName);
        if (Auth::user()->role->name != 'author') {
            $active = 1;
        } else {
            $active = 0;
        }
        $status = Blog::create([
            'name' => (string) $request->input('name'),
            'short_content' => $request->input('short_content'),
            'content' => (string) $request->input('content'),
            'category_id' => (int) $request->input('category_id'),
            'slug' => Str::slug($request->input('name'), '-'),
            'author' => Auth::user()->id,
            'images' => (string) $imgName,
            'active' => $active
        ]);

        if ($status) {
            $res = [
                'status' => 200,
                'message' => 'Thêm Thành Công'
            ];
            echo json_encode($res);
            return;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Thêm Thất Bại'
            ];
            echo json_encode($res);
            return;
        }
    }
    public function edit(string $id)
    {
        $data = DB::table('blogs')->where('id', $id)->first();
        // $data = Product::find($id);
        // dd($data);
        if ($data) {
            $res = [
                'status' => 200,
                'message' => 'Student Fetch Successfully by id',
                'data' => $data
            ];
            echo json_encode($res);
        } else {
            $res = [
                'status' => 404,
                'message' => 'Student Id Not Found'
            ];
            echo json_encode($res);
            return;
        }
    }

    public function update(Request $request, string $id)
    {
        $status = Blog::find($id);
        // dd($request->image);
        if (isset($request->image)) {
            $imgName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imgName);
            $status->images = $imgName;
        }
        if (Auth::user()->role->name != 'author') {
            $status->active = $request->input('active');
        }
        $status->name =  $request->input('name');
        $status->short_content = $request->input('short_content');
        $status->content = $request->input('content');
        $status->category_id = $request->input('category_id');
        $status->slug = Str::slug($request->input('name'), '-');
        $status->save();

        if ($status) {
            $res = [
                'status' => 200,
                'message' => 'Cập Nhật Thành Công'
            ];
            echo json_encode($res);
            return;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Cập Nhật Thất Bại'
            ];
            echo json_encode($res);
            return;
        }
    }
    public function destroy(string $id)
    {
        $status = Blog::destroy($id);
        if ($status) {
            $res = [
                'status' => 200,
                'message' => 'Xoá Danh Mục Thành Công'
            ];
            echo json_encode($res);
            return;
        }
    }
}
