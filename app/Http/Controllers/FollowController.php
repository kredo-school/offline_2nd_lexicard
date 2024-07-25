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

    public function store(Request $request)
    {
        $this->follow->following_id = $request->following_id;
        $this->follow->follower_id = Auth::id();
        $this->follow->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->follow->where('following_id', $id)->where('follower_id', Auth::id())->delete();

        return redirect()->back();
    }
}
