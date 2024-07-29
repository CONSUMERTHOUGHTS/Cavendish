<?php

namespace App\Http\Controllers;

use App\Models\Website;
use App\Models\Category;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        $websites = Website::with('categories')->paginate(10);
        return response()->json($websites);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $websites = Website::where('title', 'like', "%$query%")
            ->orWhere('url', 'like', "%$query%")
            ->with('categories')
            ->paginate(10);
        return response()->json($websites);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            'category_ids' => 'required|array'
        ]);

        $website = Website::create([
            'user_id' => $request->user()->id,
            'title' => $validated['title'],
            'url' => $validated['url']
        ]);

        $website->categories()->attach($validated['category_ids']);

        return response()->json($website, 201);
    }

    public function vote(Website $website)
    {
        $website->votes()->create(['user_id' => auth()->id()]);
        return response()->json(['message' => 'Voted successfully'], 200);
    }

    public function unvote(Website $website)
    {
        $website->votes()->where('user_id', auth()->id())->delete();
        return response()->json(['message' => 'Unvoted successfully'], 200);
    }
}
