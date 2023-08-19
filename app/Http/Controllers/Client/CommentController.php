<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $post_id)
    {
        // dd(auth()->user()->id);
        // Validate dữ liệu
        // dd($request->all());
        $request->validate([
            // 'content' => 'required'
        ]);
        // Lưu bình luận vào cơ sở dữ liệu
        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->user_id = auth('customers')->id();
        $comment->blog_id = $post_id;
        $comment->parent_id = null;
        $comment->save();
        // return redirect()->back();
        // Trả về kết quả cho Ajax
        $commentCount = Comment::where('blog_id', $post_id)->count();
        return response()->json(['status' => 'success', 'message' => 'Bình luận đã được thêm thành công.', 'commentCount' => $commentCount]);
    }
    public function commentReply(Request $request, $post_id)
    {
        // dd($request->all());
        $request->validate([
            'content' => 'required'
        ]);
        $parent_id = $request->input('parent_id');
        // Lưu bình luận vào cơ sở dữ liệu
        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->user_id = auth('customers')->id();
        $comment->blog_id = $post_id;
        $comment->parent_id = $parent_id;
        $comment->save();
        // return redirect()->back();
        // Trả về kết quả cho Ajax
        $commentCount = Comment::where('blog_id', $post_id)->count();
        return response()->json(['status' => 'success', 'message' => 'Bình luận đã được thêm thành công.', 'commentCount' => $commentCount]);
    }
    public function getComments($blogId)
    {
        $blogDetail = Blog::findOrFail($blogId);
        // $comment = $blogDetail->comment;
        // dd($comment);
        $topLevelComments = $blogDetail->comments()->whereNull('parent_id')->get();
        return view('client.comments.partial', compact('topLevelComments'))->render(); // Trả về view chứa phần danh sách bình luận
    }

    // public function store(Request $request, $post_id)
    // {
    //     $request->validate([
    //         'content' => 'required'
    //     ]);

    //     $parent_id = $request->input('parent_id'); // Nếu có, lấy ID của bình luận cha

    //     $comment = new Comment();
    //     $comment->content = $request->input('content');
    //     $comment->user_id = auth()->user()->id;
    //     $comment->blog_id = $post_id;
    //     $comment->parent_id = $parent_id; // Gán ID của bình luận cha
    //     $comment->save();

    //     // Trả về danh sách bình luận dưới dạng HTML
    //     $commentsHtml = $this->getCommentsHtml($post_id);

    //     return response()->json(['status' => 'success', 'message' => 'Bình luận đã được thêm thành công.', 'commentsHtml' => $commentsHtml]);
    // }

    // public function getCommentsHtml($blogId)
    // {
    //     $blogDetail = Blog::findOrFail($blogId);
    //     $comments = $blogDetail->comments;

    //     return view('client.comments.partial', compact('comments'));
    // }
}
