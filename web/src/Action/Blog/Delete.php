<?php

class Action_Blog_Delete extends Action {

	private $withTemplate = TRUE;

	public function beforeExecute()
	{
		$this->withTemplate = $this->request()->post('delBlogR') === NULL;

		if ($this->withTemplate === TRUE)
		{
			parent::beforeExecute();
		}
	}

	public function afterExecute()
	{
		if ($this->withTemplate)
		{
			parent::afterExecute();
		}
	}

	public function execute()
	{
		$blog = new Blog;

		if (isset($_POST['delBlogR']))
		{
			$blog->blog_delete_record(intval($_GET['id']));

			header('Location: ?a=blog.index');

		} else {

			echo Template::factory('blog/delete', array(
				'row' => $blog->get_blog_record_by_id(intval($_GET['id']))->current(),
			))->render();
		}
	}
}