<?php

class Action_Blog_Edit extends Action {

	public function execute()
	{
		$blog = new Blog;
		$data = array();

		if (isset($_POST['updateBlogR']))
		{
			$blog->blog_update_record(intval($_GET['id']));
			$data['success'] = TRUE;
		}


		$data['row'] = $blog->get_blog_record_by_id(intval($_GET['id']))->current();

		echo Template::factory('blog/edit', $data)->render();
	}
}