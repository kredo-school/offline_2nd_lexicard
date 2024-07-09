<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Follow;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    private $category, $follow, $like;
    public function __construct(Category $category, Follow $follow, Like $like)
    {
        $this->category = $category;
        $this->follow = $follow;
        $this->like = $like;
    }

    public function index()
    {
        //
    }

    public function otheruser_index() {
        $user_id = Auth::id();
        $followed_ids = $this->follow->where('follower_id', $user_id)->pluck('following_id');
        $liked_ids = $this->like->where('user_id', $user_id)->pluck('category_id');

        $categories = $this->category->where('user_id', '!=', $user_id)
        ->whereNotIn('user_id', $followed_ids)
        ->whereNotIn('id', $liked_ids)
        ->get();

        return view('users.otheruser.index')
                ->with('categories', $categories);
    }

    public function quiz_index() {
        return view('users.quiz.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->category->user_id = Auth::id();
        $this->category->name = $request->category;
        $this->category->save();

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('users.category.index')
                ->with('category', $category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category = $this->category->findOrFail($category->id);
        $category->name = $request->category;
        $category->save();

        return redirect()->route('category.category.show', $category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category = $this->category->findOrFail($category->id);
        $category->delete();

        return redirect()->route('home');
    }
}
