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
use Auth;

class ArticlesApiController extends Controller
{
    public function index()
    {
    	/* email user */
        $email = Auth::user()->email;
        $sql_user = check_user($email);
        $user_of_platform = "";
        $user = DB::connection('economie')->select($sql_user); if($user != null) $user_of_platform .= 'economie';
        $user = DB::connection('eclaira')->select($sql_user); if($user != null) $user_of_platform .= 'eclaira';
        $user = DB::connection('genie')->select($sql_user); if($user != null) $user_of_platform .= 'genie';
        /* articles */
        $sql_article = get_all_articles();
        $articles_economie = DB::connection('economie')->select($sql_article);$articles_economie = set_articles_of_platform($articles_economie, 'economie');
        $articles_eclaira = DB::connection('eclaira')->select($sql_article);$articles_eclaira = set_articles_of_platform($articles_eclaira, 'eclaira');
        $articles_genie = DB::connection('genie')->select($sql_article);$articles_genie = set_articles_of_platform($articles_genie, 'genie');
        $articles = array_merge($articles_economie, $articles_eclaira, $articles_genie);
        $articles = set_articles_of_user($articles, $user_of_platform);
        array_multisort(get_pub_date($articles), SORT_DESC, $articles);
        $json_file = get_json_of_articles($articles);

    	return $json_file;
        
    }

    public function show($id, $platform)
    {
    	/* email user */
        $email = Auth::user()->email;
        $sql_user = check_user($email);
        $user_of_platform = "";
        $user = DB::connection('economie')->select($sql_user); if($user != null) $user_of_platform .= 'economie';
        $user = DB::connection('eclaira')->select($sql_user); if($user != null) $user_of_platform .= 'eclaira';
        $user = DB::connection('genie')->select($sql_user); if($user != null) $user_of_platform .= 'genie';
        /* article */
        $sql_article = get_article_by_id($id);
        $article = DB::connection($platform)->select($sql_article);
        $article = set_articles_of_platform($article, $platform);
        $article = set_articles_of_user($article, $user_of_platform);

        $json_file = get_json_of_articles($article);

    	return $json_file;
    }

    public function update($id, $platform)
    {
        /* update article */
        $title = test_input(Input::get('title'));
        $body = test_input(Input::get('body'));
        $state = test_input(Input::get('state'));
        $sql_article = update_article_by_id($id, $title, $body, $state);
        $affected_edit = DB::connection($platform)->update($sql_article);
        
        if($affected_edit == 1){
            $email = Auth::user()->email;
            $sql_user = check_user($email);
            $user = DB::connection($platform)->select($sql_user); 
            foreach ($user as $u) {
                $id_user = $u->id;
            }
            $sql_moderated = insert_user_moderated($id, $id_user);
            DB::connection($platform)->insert($sql_moderated);
        }
        
        return $affected_edit;
    }
}
