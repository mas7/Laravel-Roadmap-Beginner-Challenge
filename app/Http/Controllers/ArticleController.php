<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Article;
use App\Models\Category;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{


    protected $redirectRoute = 'home';

    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('article.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        // dd($request->all());
        $path = NULL;

        if ($request->image) {
            $path = $request->file('image')->store('images', 'public');
        }


        $article = Article::create([
            'title' => $request->title,
            'text' => $request->text,
            'category_id' => $request->category_id,
            'image' => $path,
        ]);

        $article->tags()->sync($request->tags);

        return redirect()->route($this->redirectRoute);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('article.edit', compact('article', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateArticleRequest  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $path = NULL;

        if ($request->image) {
            $path = $request->file('image')->store('images', 'public');
        }


        $article->update([
            'title' => $request->title,
            'text' => $request->text,
            'category_id' => $request->category_id,
            'image' => ($article->image != NULL && $path == NULL) ? $article->image : $path,
        ]);

        $article->tags()->sync($request->tags);

        return redirect()->route($this->redirectRoute);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        // Delete Image
        if ($article->image != NULL) {
            Storage::disk('public')->delete($article->image);
        }

        // Detach Tags
        $article->tags()->detach();

        // Delete Object
        $article->delete();

        // Redirect
        return redirect()->route($this->redirectRoute);
    }
}
