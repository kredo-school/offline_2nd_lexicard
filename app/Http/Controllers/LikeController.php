<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class LikeController extends Controller
{
    private $like;
    public function __construct(Like $like)
    {
        $this->like = $like;
    }
    public function index()
    {
        //
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
        $this->like->category_id = $request->category_id;
        $this->like->user_id = Auth::id();
        $this->like->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->like->where('user_id', Auth::id())->where('category_id', $id)->delete();

        return redirect()->back();
    }
}
