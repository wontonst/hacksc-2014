<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>BETTY</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<body>
	<div class="navbar navbar-fixed-top">
	 <div class="navbar-inner">
	    <div class="container">
		<ul class="nav">
	  <li class="active">
	    <a class="brand" href="index.html">BETty</a>
	  </li>
	</ul>
	  </li>
	</ul> 
	
	<?php
	if (!$checked) { 
	  ?>
	<form class="navbar-form navbar-left" role="search" method="post" action="/index.php/auth/login">
	  <div class="form-group">
	    <input type="text" name="identity" class="form-control" placeholder="Email Address">
	    <input type="password" name="password" class="form-control" placeholder="Password">
	    <button type="submit" class="btn btn-default">Login</button>
	    <input type="checkbox"> <font size=1><b>Remember My Login</b></font></div></div>
	  </div>
	  </form>
	<?php
	}
	else{
	  ?>
	   <form class="navbar-form navbar-left" role="search">
	  <div class="form-group">
	    <button class="btn btn-default"><a href="/index.php/auth/logout">Logout</a></button>
	  </div>
	  </form>
	<?php
	}
	?>
    </div>
  	</div>
	</div> 

	<div class="container-fluid">
		<div class="row-fluid">
			<?php foreach ($events as $event): ?>
			<div class="span6">
				<?php echo $event->name; ?>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/2.4.1/lodash.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/handlebars.js/1.3.0/handlebars.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/backbone.marionette/1.5.1-bundled/backbone.marionette.js"></script>
</body>
</html>
