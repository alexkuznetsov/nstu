<div class="text-right">
	<a href="?a=blog.index">[Blog index]</a>
	<a href="?a=blog.create">[new record]</a>
</div>

<h3>Create new record</h3>

<?php if (isset($success)):?>
<h4>
	<em>New record has been added!</em>
</h4>
<?php endif;?>

<form method="post" action="?a=blog.create">
	<label>
		Title<br />
		<input name="title" type="text"/>
	</label>
	<br />
	<br />
	<textarea name="text" cols="50" rows="10"></textarea>
	<br />
	<button type="submit" name="createBlogR">Create new</button>
	<button type="button" onclick="history.go(-1);">Cancel</button>
</form>