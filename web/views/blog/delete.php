<div class="text-right">
	<a href="?a=blog.index">[Blog index]</a>
	<a href="?a=blog.create">[new record]</a>
</div>

<h3>Delete record</h3>

<form method="post" action="?a=blog.delete&id=<?php echo $row['id']?>">
	Remove record &laquo;<?php echo $row['title']?>&raquo;?
	<br />
	<br />
	<button type="submit" name="delBlogR">Remove</button>
	<button type="button" onclick="history.go(-1);">Cancel</button>
</form>