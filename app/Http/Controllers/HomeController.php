<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $category;
    public function __construct(Category $category)
    {
        $this->middleware('auth');
        $this->category = $category;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all_categories = $this->category->latest()->get();

        $categories = [];

        foreach ($all_categories as $category) {

            if($category->user_id){
                if($category->user_id == Auth::id() || $category->user->isFollowed() || $category->isLiked()) {
                    $categories[] = $category;
                }
            }else{
                if($category->isLiked()) {
                    $categories[] = $category;
                }
            }
        }

        return view('users.home.home')
                ->with('categories', $categories);
    }

    public function my_category()
    {
        $categories = $this->category->where('user_id', Auth::id())->latest()->get();

        return view('users.home.home')
                ->with('categories', $categories);
    }

    public function liked()
    {
        $all_categories = $this->category->latest()->get();

        $categories = [];

        foreach ($all_categories as $category) {

            if($category->user_id){
                if($category->isLiked()) {
                    $categories[] = $category;
                }
            }else{
                if($category->isLiked()) {
                    $categories[] = $category;
                }
            }

        }

        return view('users.home.home')
                ->with('categories', $categories);
    }

    public function popular()
    {
        $all_categories = $this->category->withCount('like')->orderBy('like_count', 'desc')->get();

        $categories = [];

        foreach ($all_categories as $category) {

            if($category->user_id){
                if($category->user_id == Auth::id() || $category->user->isFollowed() || $category->isLiked()) {
                    $categories[] = $category;
                }
            }else{
                if($category->isLiked()) {
                    $categories[] = $category;
                }
            }
        }


        return view('users.home.home')
                ->with('categories', $categories);
    }

    public function otheruser(Request $request)
    {
        $categories = $this->category->where('user_id', $request->other_user)->latest()->get();

        return view('users.home.home')
                ->with('categories', $categories);
    }

}
