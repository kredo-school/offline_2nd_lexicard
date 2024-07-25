<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Classroom;
use App\Models\User;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class ProfileController extends Controller
{
    private $user, $category, $word, $classroom;
    public function __construct(User $user, Category $category, Word $word, Classroom $classroom)
    {
        $this->user = $user;
        $this->category = $category;
        $this->word = $word;
        $this->classroom = $classroom;
    }
    public function index($id)
    {
        $user = $this->user->findOrFail($id);

        $classrooms = $this->classroom->whereHas('userClassroom', function($query) use ($id) {
            $query->where('user_id', $id);
        })->get();

        return view('users.profile.index')
                ->with('user', $user)
                ->with('classrooms', $classrooms);
    }

    public function follow($id)
    {
        $user = $this->user->findOrFail($id);

        return view('users.profile.follow')
                ->with('user', $user);
    }

    public function category($id) {
        $category = $this->category->findOrFail($id);

        return view('users.category.index')
                ->with('category', $category);
    }

    public function word($id) {
        $word = $this->word->findOrFail($id);

        $example = $word->example;
        $example = str_replace('{it}', '', $example);
        $example = str_replace('{/it}', '', $example);

        return view('users.category.show')
                ->with('word', $word)
                ->with('example', $example);
    }



    public function show($id)
    {
        $user = $this->user->findOrFail($id);

        $classrooms = $this->classroom->whereHas('userClassroom', function($query) use ($id){
            $query->where('user_id', $id);
        })->get();

        return view('users.profile.index')
                ->with('user', $user)
                ->with('classrooms', $classrooms);
    }

    public function edit($id)
    {
        $user = $this->user->findOrFail($id);

        return view('users.profile.edit')
                ->with('user', $user);
    }

    public function update(Request $request, string $id)
    {
        $user = $this->user->findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if($request->image){
            $user->image = 'data:image/'.$request->image->extension().';base64,'.base64_encode(file_get_contents($request->image));
        }

        $user->save();

        return redirect()->route('profile.index', $user->id);
    }

    public function destroy(string $id)
    {
        //
    }
}
