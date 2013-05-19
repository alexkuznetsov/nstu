<div class="text-right">
	<a href="?a=blog.index">[Blog index]</a>
	<a href="?a=blog.create">[new record]</a>
</div>

<?php if ($record->count() == 1): ?>

	<?php $row = $record->current();?>
	<div class="blog">
		<h3 class="post-title">
			<?php echo stripslashes($row['title']) ?>
		</h3>

		<div class="post-content">
			<?php echo stripslashes($row['text']);?>
		</div>

		<div class="post-meta post-footer">
			added <?php echo $row['date']?>
		</div>
	</div>

	<div class="comments">
		<?php if ($comments->count() > 0) :?>
			<dl>
				<?php foreach($comments as $comment):?>
					<dt><?php echo $comment['name']?> <?php echo $comment['date']?> wrote:</dt>
					<dd><?php echo $comment['text']?></dd>

				<?php endforeach?>
			</dl>
		<?php endif?>

		<hr />

		<form method="post" action="?a=blog.show&id=<?php echo $row['id']?>">
			<div>
				<label>
					Name:<br />
					<input name="name" type="text"/>
				</label>
			</div>

			<div>
				<label>
					Comment:<br />
					<textarea name="text" cols="50" rows="10"></textarea>
				</label>
			</div>

			<button name="addComment">Add comment</button>
		</form>
	</div>

<?php else : ?>
	<div class="label-info">
		<h3>There is nothing to display. Move along.</h3>
	</div>
<?php endif ?>