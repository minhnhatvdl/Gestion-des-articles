<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	protected $table = 'articles';
	protected $fillable = [
		'page_id',
		'title',
		'subtitle',
		'body',
		'pub_date',
		'user_id',
		'img',
		'video',
		'edition_state',
		'state',
		'last_name',
		'first_name',
		'category_id',
		'category',
		'event_begin_date',
		'event_end_date',
		'event_location',
		'news_type'
	];
}
