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


        $categories = $this->category->where('admin_id', 1)
                                    ->where('user_id', '!=', $user_id)
                                    ->whereNotIn('user_id', $followed_ids)
                                    ->whereNotIn('id', $liked_ids)
                                    ->get();

        return view('users.otheruser.index')
                ->with('categories', $categories);
    }

    public function quiz_index() {
        return view('users.quiz.index');
    }

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

    public function update(Request $request, Category $category)
    {
        $category = $this->category->findOrFail($category->id);
        $category->name = $request->category;
        $category->save();

        return redirect()->back();
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
