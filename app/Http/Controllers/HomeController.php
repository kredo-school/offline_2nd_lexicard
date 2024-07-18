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
        $categories = $this->all_categories();

        return view('users.home.home')
                ->with('categories', $categories);
    }

    public function all_categories() {
        $categories = $this->category->latest()->get();

        $all_categories = [];

        foreach ($categories as $category) {
            
            if($category->user_id){
                if($category->user_id == Auth::id() || $category->user->isFollowed() || $category->isLiked()) {
                    $all_categories[] = $category;
                }
            }
        }


        return $all_categories;
    }
}
