<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::paginate(6);
        $title = 'Danh Mục';
        return view('admin.page.category.list', compact('title', 'category'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $imgName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imgName);
        $status = Category::create([
            'name' => (string) $request->input('name'),
            'slug' => Str::slug($request->input('name'), '-'),
            'author' => Auth::user()->id,
            'menu_active' => $request->input('menu_active'),
            'images' => (string) $imgName,
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
        $data = DB::table('categories')->where('id', $id)->first();
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
        $status = Category::find($id);
        // dd($request->all());
        if (isset($request->image)) {
            $imgName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imgName);
            $status->images = $imgName;
        }
        $status->name =  $request->input('name');
        $status->slug = Str::slug($request->input('name'), '-');
        $status->menu_active = $request->input('menu_active1');
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
        $status = Category::destroy($id);
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
