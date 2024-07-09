<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Article::where('user_id', Auth::id())->exists()) {
            return redirect('/user/' . Auth::user()->name);
        }

        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Article::where('user_id', Auth::id())->exists()) {
            abort(403);
        }

        $validated_data = $request->validate([
            'title' => 'required|max:100',
            'content' => 'required',
            'image' => 'required|image|max:2048',
        ]);

        $validated_data['image'] = $request->file('image')->store('article_pics', 'public');
        $validated_data['user_id'] = Auth::id();

        Article::create($validated_data);
        return redirect('/user/' . Auth::user()->name);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        if ($article->user_id != Auth::id()) {
            return redirect('/user/' . Auth::user()->name);
        }

        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $validated_data = $request->validate([
            'title' => 'required|max:100',
            'content' => 'required',
            'image' => 'image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated_data['image'] = $request->file('image')->store('photos', 'public');
        } else {
            $validated_data['image'] = $article->image;
        }

        $article->update($validated_data);
        return redirect('/user/' . Auth::user()->name);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
