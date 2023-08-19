<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class SearchBlogControllor extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        // dd($searchTerm);
        $results = Blog::where('name', 'LIKE', "%$searchTerm%")->where('active',1)->get();
        // return response()->json($results);
        return view('client.page.search', compact('results', 'searchTerm'));
    }
}
