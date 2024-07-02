<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        return view('users.category.index');
    }

    public function otheruser_index() {
        return view('users.otheruser.index');
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
