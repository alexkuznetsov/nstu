<?php

class Action_Blog_Create extends Action {

	public function execute()
	{
		$data = array();

		if (isset($_POST['createBlogR']))
		{
			$blog = new Blog;
			$res = $blog->blog_create_record();

			if ($res)
			{
				$data['success'] = TRUE;
			}
		}

		echo Template::factory('blog/create', $data)->render();
	}
}