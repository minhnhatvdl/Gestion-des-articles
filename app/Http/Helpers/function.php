<?php
function text_only($htmlcode, $limit = 100, $end = ' ...')
{
    $text = strip_tags($htmlcode);

    return str_limit($text, $limit, $end);
}

function check_box($value)
{
    if($value == 1) return 1;
    return 0;
}

function set_articles_of_platform($articles, $platform)
{
	$articles_new = [];
	foreach ($articles as $a) {
		$a = (object)array_merge((array)$a, array( 'platform' => $platform ));
		array_push($articles_new, $a);
	}
	return $articles_new;
}

function set_articles_of_user($articles, $user)
{
	$articles_new = [];
	foreach ($articles as $a) {
		$a = (object)array_merge((array)$a, array( 'user_platform' => $user ));
		array_push($articles_new, $a);
	}
	return $articles_new;
}

function set_type_array($articles)
{
	$articles_new = [];
	foreach ($articles as $a) {
		array_push($articles_new, (array)$a);
	}
	return $articles_new;
}

function get_pub_date($articles)
{
	$pub_date = [];
	foreach ($articles as $a) {
		$pub_date[] = $a->pub_date;
	}
	return $pub_date;
}

function get_json_of_articles($articles)
{
	$outp = '';
	foreach($articles as $a){
		if($outp != "") $outp .= ",";
		$outp .= '{"id":"' . $a->id . '",';
	    $outp .= '"title":' . json_encode($a->title) . ',';
	    $outp .= '"body":' . json_encode($a->body) . ',';
	    $outp .= '"description":' . json_encode(text_only($a->body)) . ',';
	    $outp .= '"pub_date":"' . $a->pub_date . '",';
	    $outp .= '"state":"' . $a->state . '",';
	    $outp .= '"last_name":' . json_encode($a->last_name) . ',';
	    $outp .= '"first_name":' . json_encode($a->first_name) . ',';
	    $outp .= '"user_platform":' . json_encode($a->user_platform) . ',';
	    $outp .= '"platform":"'. $a->platform . '"}';
	}
	$outp ='{"records":['.$outp.']}';
	return $outp;
}

function test_input($data) {
  	$data = trim($data);
  	$data = addslashes($data);
  	return $data;
}

?>