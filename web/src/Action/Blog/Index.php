<?php

class Action_Blog_Index extends Action {

	public function execute()
	{
		$blog = new Blog;
		$records = $blog->get_blog_records();

		echo Template::factory('blog/index', array(
			'records' => $records,
		))->render();
	}
}