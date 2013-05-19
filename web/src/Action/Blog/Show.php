<?php

class Action_Blog_Show extends Action {

	public function execute()
	{
		$blog = new Blog;

		if (isset($_POST['addComment']))
		{
			$blog->add_comment_to_post($_GET['id']);
		}

		echo Template::factory('blog/show', array(
			'record' => $blog->get_blog_record_by_id($_GET['id']),
			'comments' => $blog->get_blog_comments($_GET['id'])
		))->render();
	}
}