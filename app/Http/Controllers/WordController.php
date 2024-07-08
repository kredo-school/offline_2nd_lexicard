<?php

namespace App\Http\Controllers;

use App\Models\Word;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


//API
use ChrisKonnertz\DeepLy\DeepLy;
use GuzzleHttp\Client;
use Flow\JSONPath\JSONPath;

class WordController extends Controller
{
    private $word, $category;
    public function __construct(Word $word, Category $category)
    {
        $this->word = $word;
        $this->category = $category;
    }


    public function index()
    {
        //
    }



    public function create(Request $request)
    {
        $request->validate([
            'word' => 'required',
        ]);

        $word = $request->word;
        $meaning = $this->translate($word);
        $definition = $this->def_and_exa($word)['definition'];
        $example_with_it = $this->def_and_exa($word)['example'];


        $example = str_replace('{it}', '', $example_with_it);
        $example = str_replace('{/it}', '', $example);

        $category = $this->category->all();

        //add from users.category.index
        if($request->category){
            $current_category = $this->category->findOrFail($request->category);

            return view('users.home.add_word')
            ->with('word', $word)
            ->with('meaning', $meaning)
            ->with('definition', $definition)
            ->with('example', $example)
            ->with('example_with_it', $example_with_it)
            ->with('categories', $category)
            ->with('current_category', $current_category);
        }else{
        //add from users.home.home

            return view('users.home.add_word')
            ->with('word', $word)
            ->with('meaning', $meaning)
            ->with('definition', $definition)
            ->with('example', $example)
            ->with('example_with_it', $example_with_it)
            ->with('categories', $category);
        }




    }

    //get translation
    public function translate($word)
    {
        $apiKey = config('services.deeply.api_key');

        $deepLy = new DeepLy($apiKey);

        try {
            $translatedText = $deepLy->translate($word, DeepLy::LANG_JA, DeepLy::LANG_AUTO);

            return $translatedText;
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    //get definition and example
    public function def_and_exa($word)
    {
        $apiKey = config('services.merriam-webster.api_key');

        $client = new Client();

        $response = $client->get("https://www.dictionaryapi.com/api/v3/references/learners/json/{$word}", [
            'query' => [
                'key' => $apiKey,
            ],
        ]);

        $definition = json_decode($response->getBody()->getContents(), true);

        $shortdef = 'shortdef';
        $example = 't';
        $jsonPath = new JSONPath($definition);
        $def = $jsonPath->find("$..$shortdef");
        $exp = $jsonPath->find("$..$example");



        $def_and_exa = [
            'definition' => $def[0][0],
            'example' => $exp[0],
        ];

        return $def_and_exa;
    }


    public function store(Request $request)
    {
        $this->word->user_id = Auth::id();
        $this->word->word = $request->word;
        $this->word->meaning = $request->meaning;
        $this->word->definition = $request->definition;
        $this->word->example = $request->example;
        $this->word->save();

        if($request->category){
            $category_post[] = ["category_id" => $request->category];

            $this->word->categoryWord()->createMany($category_post);
        }

        if($request->page == 0){
            return redirect()->route('category.category.show', $request->category);
        }else{
            return redirect()->route('home');
        }

    }

    public function store_more(Request $request)
    {
        foreach ($request->word as $word) {
            $definitionAndExample = $this->def_and_exa($word);

            $word = $this->word->create([
                "user_id" => Auth::id(),
                "word" => $word,
                "meaning" => $this->translate($word),
                "definition" => $definitionAndExample['definition'],
                "example" => $definitionAndExample['example'],
            ]);

            if($request->category){
                // $category_post[] = ["category_id" => $request->category];

                // $word->categoryWord()->createMany($category_post);

                $word->categoryWord()->create([
                    "category_id" => $request->category,
                ]);
            }

        }




        return redirect()->route('category.category.show', $request->category);
    }

    /**
     * Display the specified resource.
     */
    public function show(Word $word)
    {
        $example = $this->word->where('id', $word->id)->first()->example;

        $example = str_replace('{it}', '', $example);
        $example = str_replace('{/it}', '', $example);

        return view('users.category.show')
                ->with('word', $word)
                ->with('example', $example);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Word $word)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Word $word)
    {
        $word = $this->word->findOrFail($word->id);
        $word->word = $request->word;
        $word->meaning = $request->meaning;
        $word->definition = $request->definition;
        $word->example = $request->example;
        $word->save();

        $category_id = $word->categoryWord()->first()->category_id;

        return redirect()->route('category.category.show', $category_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Word $word)
    {
        $word = $this->word->findOrFail($word->id);
        $category_id = $word->categoryWord()->first()->category_id;
        $word->delete();

        return redirect()->route('category.category.show', $category_id);
    }
}
