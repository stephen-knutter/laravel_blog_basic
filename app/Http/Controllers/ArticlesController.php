<?php
namespace App\Http\Controllers;

use App\Article;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ArticleRequest;
use App\Http\Controllers\Controller;
use Carbon\Carbon;





class ArticlesController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth', ['only' => 'create']);
    }

    public function index()
    {

      // return \Auth::user()->name;

      $articles = Article::latest('published_at')->published()->get();
      /*
      /ALTERNATIVE APPROACH
      /return view('articles.index'->with('articles', $articles));
      */
      return view('articles.index', compact('articles'));
    }

    public function show($id)
    {
      $article = Article::findOrFail($id);
      /*
      /SHOW WHAT WAS RETURNED FROM DATABASE
      /dd($article);
      */
      /*
      /ABORT TO 404 PAGE
      /if(is_null($article)){
      /  abort(404);
      /}
      */
      return view('articles.show', compact('article'));
    }

    public function create()
    {
      // $tags = \App\Tag::lists('name'); //For single list i.e. ['one','two']
      $tags = \App\Tag::lists('name', 'id'); //For key=>value  i.e. [1=>'one', 2=>'two']

      return view('articles.create', compact('tags'));
    }

    public function store(ArticleRequest $request)
    {
      //$this->validate($request, ['title' => 'required']) //Alternate to ArticleRequest

      $this->createArticle($request);

      //\Session::flash('flash_message', 'Your article has been created!');
      //\Flash::success()
      return redirect('articles')->with([
        'flash_message' => 'Your article has been created!',
        // 'flash_message_important' => true
      ]);
    }

    public function edit($id)
    {
      $tags = \App\Tag::lists('name', 'id');

      $article = Article::findOrFail($id);

      return view('articles.edit', compact('article', 'tags'));
    }

    public function update($id, ArticleRequest $request)
    {
      $article = Article::findOrFail($id);

      $article->update($request->all());

      $this->syncTags($article, $request->input('tag_list'));

      return redirect('articles');
    }

    /**
    * Sync up the list of tags in the database.
    * @param Article $article
    * @param array $tags
    */
    private function syncTags(Article $article, array $tags)
    {
      $article->tags()->sync($tags);
    }

    /**
    * Sync up the list of tags in the database.
    * @param ArticleRequest $request
    * @return mixed
    */
    private function createArticle(ArticleRequest $request)
    {
      $article = \Auth::user()->articles()->create($request->all());
      // $article = new Article($request->all());
      // $article = \Auth::user()->articles()->save($article);

      // Article::create($request->all());

      // $article->tags()->attach($request->input('tag_list'));
      $this->syncTags($article, $request->input('tag_list'));

      return $article;
    }
}
