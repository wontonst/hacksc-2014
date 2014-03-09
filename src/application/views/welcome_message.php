<!DOCTYPE html>   
<html lang="en">   
<head>   
<meta charset="utf-8">   
<title>BETTY</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">   
<link href="/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Swanky+and+Moo+Moo' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Rock+Salt' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
 <script type="text/javascript">
 		var yes = 9;
 		var no = 3;
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Option', 'Percent of Votes'],
          ['Yes',     yes],
          ['No',      no]]);

        var options = {
          title: 'Will There Be Another Cold War?',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>   
</head>  
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
if(!$checked){ 
  ?>
<form class="navbar-form navbar-left" role="search" method="post" action="/index.php/auth/login">
  <div class="form-group">
    <input type="text" name="identity" class="form-control" placeholder="Email Address">
    <input type="password" name="password" class="form-control" placeholder="Password">
    <button type="submit" class="btn btn-default">Login</button>
  </div>
  </form>
<?php
}
else{
  ?>
   <form class="navbar-form navbar-left" role="search" style = "display:none">
  <div class="form-group">
    <a href="/index.php/auth/logout"><button class="btn btn-default">Logout</button></a>
  </div>
  </form>
<?php
}
?>
    </div>
  </div>
</div> 
<br>
<br>
<br>
<div class="container-fluid">
<div class="row-fluid">
    
    <div class="span4" style="border:1px solid gray;">
      <!--Sidebar content-->
      <p style= "font-family: 'Swanky and Moo Moo', cursive; font-size = 40px">
      	Bet of the Week
      </p>
      <div class="row-fluid"> <div class="span12" style = " background: url('/img/putin.jpg')">
         <div class="row-fluid"><div class = "span12" style = " height: 130px"></div></div>
      	<div class="row-fluid"><div id="piechart" class = "span12" style = "background-color:#ffffff; background: linear-gradient(white, gray); height: 200px;  opacity:0.9;"></div></div>
      	<div class="row-fluid"><div id="vote-area" class ="span6 offset3" style = " height: 150px;">
      		<div class="input-group">
  				<br>
  				<input type="text" class="form-control" placeholder="$0.00">
  				
				<button type="button" class="btn btn-default btn-lg">
  				<i class="icon-thumbs-up"></i> Yes
				</button>
				<button type="button" class="btn btn-default btn-lg">
  				<i class="icon-thumbs-down"></i> No
				</button>
			</div>
		</div>
		</div>
	</div></div>
  	</div>
    

 	<div class="span8" style = "border: 1px solid gray">
      <!--Body content-->
        <p style= "font-family: 'Swanky and Moo Moo', cursive; font-size = 40px">
      		Register Now
      		</p>

     <!--Moving Banner DIV-->  
  		<div class="row-fluid"><div class="span12" style = " height: 300px; background: url('/img/money.jpg')">
  		<div class = "row-fluid"><div class="span6 offset3" style = "background-color:#ffffff; background: linear-gradient(white, gray); border: 1px solid gray; height: 300px;  opacity:0.9;"><div class= "row-fluid">
  	 		<div class = "span6 offset2"><br>
  			<font size=3><b>Sign Up</b></font></div></div><br>
  	 <div class="form-group">
  	 	<div class= "row-fluid">
  	 		<div class = "span6 offset2">
    <input type="text" class="form-control" placeholder="First Name"></div></div>
    <div class= "row-fluid">
  	 		<div class = "span6 offset2">
    <input type="text" class="form-control" placeholder="Last Name"></div></div>
    <div class= "row-fluid">
  	 		<div class = "span6 offset2">
    <input type="text" class="form-control" placeholder="PayPal Email Address"></div></div>
    <div class= "row-fluid">
  	 		<div class = "span6 offset2">
    <input type="text" class="form-control" placeholder="Password"></div></div>

      <div class= "row-fluid">
  	 		<div class = "span6 offset2">
        <input type="checkbox"> <font size=1><b>I verify that I am over 18 years of age</b></font></div></div>
      
    <div class= "row-fluid">
  	 		<div class = "span6 offset3">
    <button type="submit" class="btn btn-default">Register Now</button></div></div>

  </div>
  		</div></div>
  		</div>
  	      </div>
		<div class="row-fluid"><div class="span12" style = "height: 10px"><p style= "font-family: 'Swanky and Moo Moo', cursive; font-size = 40px">
      		Other Popular Bets
      		</p></div></div>
		<div class="row-fluid">
 			<div class="span3" style = "border: 1px solid gray; height: 250px; background: url('/img/mj.jpg')"><div class = "row-fluid"><div class="span12" style = "background-color:#ffffff; background: linear-gradient(white, gray); border: 1px solid gray; height: 25px;  opacity:0.9;"><font size=1><b>Will Marijuana Be Legalized in CA in 2014?</b></font></div></div><div class = "row-fluid"><div class ="span12" style="vertical-align:bottom;"><input type="text" class="form-control" placeholder="$0.00"><button type="button" class="btn btn-default btn-lg"><i class="icon-thumbs-up"></i>
				</button>
				<button type="button" class="btn btn-default btn-lg">
  				<i class="icon-thumbs-down"></i>
				</button></div></div></div>
  			<div class="span3" style = "border: 1px solid gray; height: 250px; background: url('/img/barack.jpeg')"><div class = "row-fluid"><div class="span12" style = "background-color:#ffffff; background: linear-gradient(white, gray); border: 1px solid gray; height: 25px;  opacity:0.9;"><font size=1><b>Will Barack Obama Ease Immigration Laws?</b></font></div></div><div class = "row-fluid"><div class ="span12" style="vertical-align:bottom;"><input type="text" class="form-control" placeholder="$0.00"><button type="button" class="btn btn-default btn-lg"><i class="icon-thumbs-up"></i>
				</button>
				<button type="button" class="btn btn-default btn-lg">
  				<i class="icon-thumbs-down"></i>
				</button></div></div></div>
  			<div class="span3" style = "border: 1px solid gray; height: 250px; background: url('/img/lohan.jpeg')"><div class = "row-fluid"><div class="span12" style = "background-color:#ffffff; background: linear-gradient(white, gray); border: 1px solid gray; height: 25px;  opacity:0.9;"><font size=1><b>Will Lindsey Lohan's New Series Be a Hit?</b></font></div></div><div class = "row-fluid"><div class ="span12" style="vertical-align:bottom;"><input type="text" class="form-control" placeholder="$0.00"><button type="button" class="btn btn-default btn-lg"><i class="icon-thumbs-up"></i>
				</button>
				<button type="button" class="btn btn-default btn-lg">
  				<i class="icon-thumbs-down"></i>
				</button></div></div></div>
  			<div class="span3" style = "border: 1px solid gray; height: 250px; background: url('/img/usc.jpg')"><div class = "row-fluid"><div class="span12" style = "background-color:#ffffff; background: linear-gradient(white, gray); border: 1px solid gray; height: 25px;  opacity:0.9;"><font size=1><b>Will We Finish Our HackSC App?</b></font></div></div><div class = "row-fluid"><div class ="span12" style="vertical-align:bottom;"><input type="text" class="form-control" placeholder="$0.00"> <button type="button" class="btn btn-default btn-lg"><i class="icon-thumbs-up"></i>
				</button>
				<button type="button" class="btn btn-default btn-lg">
  				<i class="icon-thumbs-down"></i>
				</button></div></div></div>
  		</div>
	</div>

</div>
</div>


<script src="bootstrap/js/jsquery-1.11.0.min.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>               
</body>  
</html>   
