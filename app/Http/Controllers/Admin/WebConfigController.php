<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebConfiguration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebConfigController extends Controller
{
    public function index()
    {
        $web_config = WebConfiguration::find(1);
        // dd($web_config);
        $title = "Cấu Hình Website";
        return view('admin.page.WebConfig', compact('web_config', 'title'));
    }
    public function edit(string $id)
    {
        $data = DB::table('web_configurations')->where('id', $id)->first();
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
        $status = WebConfiguration::find($id);
        // dd($request->all());
        if (isset($request->image)) {
            $imgName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imgName);
            $status->logo = $imgName;
        }
        $status->name =  $request->input('name');
        $status->about = $request->input('about');
        $status->instagram = $request->input('instagram');
        $status->twitter = $request->input('twitter');
        $status->facebook = $request->input('facebook');
        $status->linkedin = $request->input('linkedin');
        $status->pinterest = $request->input('pinterest');
        $status->dribbble = $request->input('dribbble');

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
}
