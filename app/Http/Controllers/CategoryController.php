<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Follow;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    private $category, $follow, $like, $user;
    public function __construct(Category $category, Follow $follow, Like $like, User $user)
    {
        $this->category = $category;
        $this->follow = $follow;
        $this->like = $like;
        $this->user = $user;
    }

    public function store(CategoryRequest $request)
    {
        $this->category->user_id = Auth::id();
        $this->category->name = $request->category;
        $this->category->save();

        return redirect()->route('home');
    }

    public function show(Category $category)
    {
        return view('users.category.index')
                ->with('category', $category);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category = $this->category->findOrFail($category->id);
        $category->name = $request->category;
        $category->save();

        return redirect()->back();
    }

    public function destroy(Category $category)
    {
        $category = $this->category->findOrFail($category->id);
        $category->delete();

        return redirect()->route('home');
    }

    // OtherUser Page
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

    public function popular()
    {
        $user_id = Auth::id();
        $followed_ids = $this->follow->where('follower_id', $user_id)->pluck('following_id');
        $liked_ids = $this->like->where('user_id', $user_id)->pluck('category_id');


        $categories = $this->category->where('admin_id', 1)
                                    ->where('user_id', '!=', $user_id)
                                    ->whereNotIn('user_id', $followed_ids)
                                    ->whereNotIn('id', $liked_ids)
                                    ->withCount('like')->orderBy('like_count', 'desc')
                                    ->get();

        return view('users.otheruser.index')
                ->with('categories', $categories);

    }

    public function recent()
    {
        $user_id = Auth::id();
        $followed_ids = $this->follow->where('follower_id', $user_id)->pluck('following_id');
        $liked_ids = $this->like->where('user_id', $user_id)->pluck('category_id');


        $categories = $this->category->where('admin_id', 1)
                                    ->where('user_id', '!=', $user_id)
                                    ->whereNotIn('user_id', $followed_ids)
                                    ->whereNotIn('id', $liked_ids)
                                    ->latest()
                                    ->get();

        return view('users.otheruser.index')
                ->with('categories', $categories);
    }

    public function search_user(Request $request) {
        $user_id = Auth::id();
        $followed_ids = $this->follow->where('follower_id', $user_id)->pluck('following_id');
        $liked_ids = $this->like->where('user_id', $user_id)->pluck('category_id');
        $user = $request->user;


        $categories = $this->category->where('admin_id', 1)
                                    ->where('user_id', '!=', $user_id)
                                    ->whereNotIn('user_id', $followed_ids)
                                    ->whereNotIn('id', $liked_ids)
                                    ->latest()
                                    ->whereHas('user', function ($query) use ($user) {
                                        $query->where('name', 'LIKE', '%'. $user. '%');
                                    })
                                    ->get();

        return view('users.otheruser.index')
                ->with('categories', $categories)
                ->with('search_user', $user);
    }

    public function search_category(Request $request) {
        $user_id = Auth::id();
        $followed_ids = $this->follow->where('follower_id', $user_id)->pluck('following_id');
        $liked_ids = $this->like->where('user_id', $user_id)->pluck('category_id');
        $category = $request->category;


        $categories = $this->category->where('admin_id', 1)
                                    ->where('user_id', '!=', $user_id)
                                    ->whereNotIn('user_id', $followed_ids)
                                    ->whereNotIn('id', $liked_ids)
                                    ->latest()
                                    ->where('name', 'LIKE', '%'. $category. '%')
                                    ->get();

        return view('users.otheruser.index')
                ->with('categories', $categories)
                ->with('search_category', $category);
    }

    //Quiz
    public function quiz_index() {
        return view('users.quiz.index');
    }
}
