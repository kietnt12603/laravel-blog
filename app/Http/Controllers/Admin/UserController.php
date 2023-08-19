<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', '<>', 4)->paginate(5);
        $title = "Quản Trị Viên";
        $role = Role::whereNotIn('name', ['customer'])->get();
        return view('admin.page.user.quantrivien.list', compact('users', 'title', 'role'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $imgName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imgName);
        $status = User::create([
            'name' => (string) $request->input('name'),
            'email' => (string) $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'avatar' => (string) $imgName,
            'role_id' => (int) $request->input('role_id')
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
        $data = DB::table('users')->where('id', $id)->first();
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
        $status = User::find($id);
        if (isset($request->image)) {
            $imgName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imgName);
            $status->avatar = $imgName;
        }
        $status->name =  $request->input('name');
        $status->email =  $request->input('email');
        $status->role_id = $request->input('role_id');
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
        $status = User::destroy($id);
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
