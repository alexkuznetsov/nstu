<div class="text-right">
	<a href="?a=blog.index">[Blog index]</a>
	<a href="?a=blog.create">[new record]</a>
</div>

<h3>Edit record</h3>

<?php if (isset($success)):?>
<h4>
	<em>The record has been updated!</em>
</h4>
<?php endif;?>

<form method="post" action="?a=blog.edit&id=<?php echo $row['id']?>">
	<label>
		Title<br />
		<input name="title" type="text" value="<?php echo $row['title']?>"/>
	</label>
	<br />
	<br />
	<textarea name="text" cols="50" rows="10"><?php echo str_replace(array('<br />', '<br/>'), "\r\n", $row['text'])?></textarea>
	<br />
	<button type="submit" name="updateBlogR">Update</button>
	<button type="button" onclick="history.go(-1);">Cancel</button>
</form>