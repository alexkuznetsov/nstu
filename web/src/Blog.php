<?php

class Blog {

	private $db;

	public function __construct()
	{
		$this->db = new DB;
	}

	public function __destruct()
	{
		unset($this->db);
	}

	public static function blog_body_trimmed($text)
	{
		$text = strip_tags(stripslashes($text));
		$len = text_strlen($text);

		if ($len<=200)
			return $text;

		if (function_exists('mb_substr'))
		{
			return mb_substr($text,0,200) . "&hellip;";
		}

		return substr($text, 0, 200) . "&hellip;";
	}

	public function get_blog_records()
	{
		$res = $this->db->query('select * from blog_post order by date desc');

		return new DBResult($res);
	}

	public function get_blog_comments($blog_id)
	{
		$res = $this->db->query('select * from blog_comments where post_id=:post_id order by date desc', array(
			':post_id' => intval($blog_id),
		));

		return new DBResult($res);
	}

	public function get_blog_record_by_id($id)
	{
		$res = $this->db->query('select * from blog_post where id=:id limit 1', array(
			':id' => intval($id)
		));

		return new DBResult($res);
	}

	public function blog_create_record()
	{
		$title = htmlentities(strip_tags($_POST['title']));
		$text = strip_tags($_POST['text'], '<p><div><h1><h2><h3><h4><h5><h6><a>');
		$text = str_replace(array("\r", "\n"), '', nl2br($text));
		$added = date('Y-m-d H:i:s');

		$this->db->query('insert into blog_post(date,title,text) values(\':date\', \':title\', \':text\')', array(
			':date' => $added,
			':title' => addslashes($title),
			':text' => addslashes($text)
		));

		return $this->db->insert_id();
	}

	public function blog_update_record($id)
	{
		$title = htmlentities(strip_tags($_POST['title']));
		$text = strip_tags($_POST['text'], '<p><div><h1><h2><h3><h4><h5><h6><a>');
		$text = str_replace(array("\r", "\n"), '', nl2br($text));

		$this->db->query('update blog_post set title=\':title\', text=\':text\' where id=:id limit 1', array(
			':id' => intval($id),
			':title' => addslashes($title),
			':text' => addslashes($text)
		));

		return $this->db->affected_rows();
	}

	public function blog_delete_record($id)
	{
		$this->db->query('delete from blog_post where id=:id limit 1', array(
			':id' => intval($id),
		));

		$this->db->query('delete from blog_comments where post_id=:id', array(
			':id' => intval($id),
		));

		return $this->db->affected_rows();
	}

	public function add_comment_to_post($post_id)
	{
		$name = strip_tags($_POST['name']);
		$text = strip_tags($_POST['text']);

		if (strlen($name) > 0 AND strlen($text) > 0)
		{
			$this->db->query('INSERT INTO blog_comments (date, name, text, post_id) VALUES (\':date\', \':name\', \':text\', :post_id)', array(
				':date' => date('Y-m-d H:i:s'),
				':name' => $name,
				':text' => $text,
				':post_id' => intval($post_id),
			));
		}
	}

}