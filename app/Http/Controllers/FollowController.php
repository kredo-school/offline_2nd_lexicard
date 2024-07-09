<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FollowController extends Controller
{
    private $follow;
    public function __construct(Follow $follow)
    {
        $this->follow = $follow;
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
        $this->follow->following_id = $request->following_id;
        $this->follow->follower_id = Auth::id();
        $this->follow->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Follow $follow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Follow $follow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Follow $follow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->follow->where('following_id', $id)->where('follower_id', Auth::id())->delete();

        return redirect()->back();
    }
}
