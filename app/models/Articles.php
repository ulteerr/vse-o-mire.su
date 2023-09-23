<?php

namespace app\models;

use app\core\Model;

class Articles extends Model
{
	public function count()
	{
		$count = $this->db->row('SELECT COUNT(*) AS total FROM `articles`');
		$count = current($count);
		$totalRecords = $count['total'] ?? null;
		return $totalRecords;
	}
	public function get($offset, $recordsPerPage)
	{
		$result = $this->db->row("SELECT * FROM `articles` LIMIT $offset, $recordsPerPage");
		return $result;
	}

	public function where($params = [])
	{
		if (!empty($params)) {
			$sql = '';
			$data  = [];
			$count = 0;
			foreach ($params as $key => $param) {
				if ($count == 0) {
					$sql .= "WHERE" . " `" . $key . "` " . $param['operator'] . " " . ":" . $key;
				} else {
					$sql .= " " . "AND" . " `" . $key . "` " . $param['operator'] . " " . ":" . $key;
				}
				$data[$key] = $param['value'];
				$count++;
			}

			$result = $this->db->row("SELECT
		    a.id AS article_id,
			a.title AS article_title,
			a.slug AS article_slug,
			a.content AS article_content,
			a.image_path AS article_image_path,
			u.id AS user_id,
			u.username AS username,
			u.image_path AS user_image_path,
			c.id AS comment_id,
			c.content AS comment_content,
			cu.id AS comment_user_id,
			cu.username AS comment_username,
			r.id AS reply_id,
			r.content AS reply_content,
			ru.id AS reply_user_id,
			ru.username AS reply_username
		FROM
			articles AS a
		INNER JOIN
			users AS u ON a.user_id = u.id
		LEFT JOIN
			comments AS c ON a.id = c.article_id
		LEFT JOIN
			replies AS r ON c.id = r.comment_id
		LEFT JOIN
			users AS cu ON c.user_id = cu.id 
		LEFT JOIN
			users AS ru ON r.user_id = ru.id 
			WHERE
				a.slug = :slug;", $data);
			if (!empty($result)) {
				$article = array(
					'id' => $result[0]['article_id'],
					'title' => $result[0]['article_title'],
					'slug' => $result[0]['article_slug'],
					'content' => $result[0]['article_content'],
					'image_path' => $result[0]['article_image_path'],
					'user' => array(
						'id' => $result[0]['user_id'],
						'username' => $result[0]['username'],
						'image_path' => $result[0]['user_image_path']
					),
					'comments' => array()
				);

				foreach ($result as $row) {
					$commentId = $row['comment_id'];
					if (!isset($comments[$commentId])) {
						$comments[$commentId] = array(
							'id' => $commentId,
							'content' => $row['comment_content'],
							'user' => array(
								'id' => $row['comment_user_id'],
								'username' => $row['comment_username']
							),
							'replies' => array()
						);
					}
					if ($row['reply_id']) {
						$reply = array(
							'id' => $row['reply_id'],
							'content' => $row['reply_content'],
							'user' => array(
								'id' => $row['reply_user_id'],
								'username' => $row['reply_username']
							)
						);

						$comments[$commentId]['replies'][] = $reply;
					}
				}
				$article['comments'] = array_values($comments);
				return $article;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}
