<?php
if (isset($_COOKIE['user'])) : ?>
	<p>Hi <?php echo $_COOKIE['user']?> </p>
	<p>Date: <?php echo $_COOKIE['date']?></p>
<?php else:?>
	<p>Hello, anonymous!</p>
<?php endif ?>

<form method="POST" action="?a=cookie">
	<p>
		<input type="text" name="name" value="" />
	</p>
	<p>
		<button type="submit" name="save">Send</button>
		<button type="submit" name="del">Del</button>
	</p>
</form>

<a href="?a=index">[Go index]</a>