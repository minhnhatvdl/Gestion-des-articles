<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FrontendArticlesApiController extends Controller
{
    public function index()
    {
    	return view('articlesapi/frontend/index');
    }
    public function show()
    {
    	return view('articlesapi/frontend/edit');
    }
}
