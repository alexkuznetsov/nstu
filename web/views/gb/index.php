<form method="POST" action="?a=gb.addMessage">
	<div>
		<label>
			Put your name <br />
			<input type="text" name="name" />
		</label><br />

		<label>
			Like PHP
			<input type="checkbox" name="likes[]" value="PHP" />
		</label>

		<label>
			Like ASP
			<input type="checkbox" name="likes[]" value="ASP" />
		</label>

		<label>
			Like Java
			<input type="checkbox" name="likes[]" value="Java" />
		</label>
	</div>

	<div>
		<label>
			Add message <br />
			<textarea name="message" cols="50" rows="10"></textarea>
		</label>
	</div>

	<button type="submit" name="add">Add message</button>
	<button type="submit" name="clear">Clear</button>
</form>

<?php if (isset($messages) AND count($messages) > 0): ?>
	<ul>
		<li><?php echo implode('</li><li>', $messages)?></li>
	</ul>
<?php endif;?>

<a href="?a=index">[Go index]</a>
