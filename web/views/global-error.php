<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<title>Application is shutdown</title>

	<meta name="keywords" content="" />
	<meta name="description" content="" />

	<style type="text/css">
		.exception-text pre{
			word-wrap: break-word;
			text-overflow: clip;
			overflow: scroll;
			overflow-style: scrollbar;
			overflow-x: scroll;
			overflow-y:inherit;
		}
	</style>
</head>
<body>
<div style="margin:50px auto; width:900px">
	<div class="error">
		<h1>Dooooh! There is an error :(</h1>
	</div>

	<div class="info">
		Application is terminated. We working on fix.
	</div>

	<?php if (isset($e)):?>
		<div class="exception-text">
			<pre><?php echo $e->getMessage();?></pre>
		</div>

		<ul>
			<?php $trace = $e->getTrace(); $trace = array_reverse($trace, true);
			foreach($trace as $line):?>

				<li>
					<i><?php echo isset($line['class']) ? $line['class'] : "{main}", isset($line['type']) ? $line['type'] : ' &mdash; ', $line['function'];?></i>
					&raquo;
					<?php echo isset($line['file']) ? Debug::path($line['file']) : '<em>internal call</em>', isset($line['line']) ? " ({$line['line']})" : ''?>
				</li>

			<?php endforeach?>
		</ul>
	<?php endif;?>
</div>
</body>
</html>