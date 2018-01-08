<?php
function get_all_articles()
{
    $sql = "SELECT SQL_CALC_FOUND_ROWS 
				p.id,
				pc.title,
				pc.subtitle,
				pc.body,
				p.pub_date,
				p.user_id,
				p.img,
				p.video,
				p.edition_state,
				pc.state,
				u.last_name,
				u.first_name,
				a.category_id,
				category.category,
				a.event_begin_date,
				a.event_end_date,
				a.event_location,
				news_type.news_type
				FROM page AS p
				INNER JOIN article AS a ON a.page_id = p.id
				INNER JOIN user AS u ON p.user_id = u.id
				INNER JOIN page_content as pc ON p.id = pc.page_id
				LEFT JOIN category ON a.category_id = category.id
				LEFT JOIN news_type ON a.news_type_id = news_type.id
				WHERE p.ressource_type_id = 3
				AND pc.state = 1
				ORDER by pub_date DESC";
	return $sql;
}

function get_article_by_id($id = 1)
{
    $sql = "SELECT SQL_CALC_FOUND_ROWS 
				p.id,
				pc.title,
				pc.subtitle,
				pc.body,
				p.pub_date,
				p.user_id,
				p.img,
				p.video,
				p.edition_state,
				pc.state,
				u.last_name,
				u.first_name,
				a.category_id,
				category.category,
				a.event_begin_date,
				a.event_end_date,
				a.event_location,
				news_type.news_type
				FROM page AS p
				INNER JOIN article AS a ON a.page_id = p.id
				INNER JOIN user AS u ON p.user_id = u.id
				INNER JOIN page_content as pc ON p.id = pc.page_id
				LEFT JOIN category ON a.category_id = category.id
				LEFT JOIN news_type ON a.news_type_id = news_type.id
				WHERE p.ressource_type_id = 3
				AND pc.state = 1
				AND p.id = $id
				ORDER by pub_date DESC";
	return $sql;
}

function update_article_by_id($id = 1, $title = "", $body = "", $state = 0)
{
	$sql = "UPDATE page_content
			SET title = \"$title\", body = \"$body\", state = $state
			WHERE page_id = $id";
	return $sql;
}

function check_user($email)
{
	$sql = "SELECT SQL_CALC_FOUND_ROWS
				id, login
				FROM user
				WHERE user.login = \"$email\"";
	return $sql;
}

function insert_user_moderated($id = 1, $id_user)
{
	$sql = "INSERT INTO page_moderated (page_id, moderator_id)
			VALUES ($id, $id_user)";
	return $sql;
}
?>