<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\ArticleFormRequest;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use DB;

class ArticlesController extends Controller
{
    public function index()
    {
    	$sql = get_all_articles();
        $articles_economie = DB::connection('economie')->select($sql);
        $articles_economie = set_articles_of_platform($articles_economie, 'economie');
        $articles_eclaira = DB::connection('eclaira')->select($sql);
        $articles_eclaira = set_articles_of_platform($articles_eclaira, 'eclaira');
        $articles_genie = DB::connection('genie')->select($sql);
        $articles_genie = set_articles_of_platform($articles_genie, 'genie');
        $articles = array_merge($articles_economie, $articles_eclaira, $articles_genie);
        array_multisort(get_pub_date($articles), SORT_DESC, $articles);
        /* count number of array */
        $number_articles = count($articles);
        /* pagination 
        $articles = new Paginator($articles, 5);
        */
        /* test if edit article in database */
        $affected = Input::get('affected');

        return view('articles/index', compact('articles', 'affected', 'number_articles')); 
    }

    public function create()
    {
        return view('articles/create');
    }
    public function save(ArticleFormRequest $request)
    {
        $title = $request->get('title');
        $body = $request->get('body');
        $state = check_box($request->get('state'));
        Article::create([
            'title' => $title,
            'body' => $body,
            'state' => $state
        ]);
        return redirect()->route('articles');
    }

    public function preview($id, $platform)
    {
    	$sql = get_article_by_id($id);
        $article = DB::connection($platform)->select($sql);

    	return view('articles/preview', compact('article'));
    }

    public function edit($id, $platform)
    {
        $sql = get_article_by_id($id);
        $article = DB::connection($platform)->select($sql);
        $article = set_articles_of_platform($article, $platform);

        return view('articles/edit', compact('article'));
    }

    public function update($id, $platform)
    {   
        $title = Input::get('title');
        $body = Input::get('body');
        $state = check_box(Input::get('state'));
        $sql = update_article_by_id($id, $title, $body, $state);
        $affected_edit = DB::connection($platform)->update($sql);

        return redirect()->route('articles', array('affected_edit' => $affected_edit));
    }
}
