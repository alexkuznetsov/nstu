<div class="text-right">
	<a href="?a=blog.create">[new record]</a>
	<a href="?a=index">[select lab]</a>
</div>

<?php if ($records->count() > 0): ?>

	<?php foreach($records as $row):?>
		<div class="blog">
			<h3 class="post-title">
				<a href="?a=blog.show&id=<?php echo $row['id']?>">
					<?php echo $row['title'] ?>
				</a>
			</h3>

			<div class="post-content">
				<?php echo Blog::blog_body_trimmed($row['text']);?>
				<a href="?a=blog.show&id=<?php echo $row['id']?>">[read more]</a>
			</div>

			<div class="post-meta post-footer">
				added <?php echo $row['date']?>,
				<a href="?a=blog.edit&id=<?php echo $row['id']?>">[edit]</a>,
				<a href="?a=blog.delete&id=<?php echo $row['id']?>">[delete]</a>.
			</div>
		</div>

	<?php endforeach;?>
<?php else : ?>
	<div class="label-info">
		<h3>There is nothing to display. Move along.</h3>
	</div>
<?php endif ?>