<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>BETTY</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<body>
	<div class="container-fluid">
		<ul>
			<?php foreach ($events as $event): ?>
			<li class="row-fluid">
				<?php echo $event->name; ?>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
</body>
</html>
