<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    public function index()
    {
        $banner = banner::paginate(6);
        $title = "Banner";
        return view('admin.page.banner.list', compact('banner', 'title'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $imgName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imgName);
        $status = banner::create([
            'name' => (string) $request->input('name'),
            'images' => (string) $imgName,
            'url' => (string) $request->input('url')
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
        $data = DB::table('banners')->where('id', $id)->first();
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
        $status = banner::find($id);
        // dd($request->all());
        if (isset($request->image)) {
            $imgName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imgName);
            $status->images = $imgName;
        }
        $status->name =  $request->input('name');
        $status->url = $request->input('url');
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
        $status = banner::destroy($id);
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
