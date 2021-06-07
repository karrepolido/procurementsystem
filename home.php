<?php
	
	include 'config.php';

	session_start();

	$empName = $_SESSION["eName"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>RYCK Construction</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
  	@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;700&display=swap');

    body {margin:0;}

    /** navbar section **/
	.navbar-custom {
		background-color: #005E66;
		font-family: 'Roboto', sans-serif;
	}

	.navbar-custom .navbar-brand,
    .navbar-custom .navbar-text { 
        color: #FDFFFC; 
    } 

	.navbar-custom a {
		color: #FDFFFC;
		text-align: center;
		font-size: 18px;
		padding: 14px 10px;
	}

	.navbar-custom a:hover {
		background: #FDFFFC;
	  	color: #362F37;
	}

	/** main section **/
	.main {
		padding: 16px;
		margin-top: 50px;
		font-family: 'Roboto', sans-serif;
		color: #362F37;
	}

	/** footer section **/
	.copyright {
		background-color: #005E66;
		padding: 10px 0 2px 0;
		margin-top: 50px;
	}

	.copyright p {
		color: #FDFFFC;
		font-size: 15px;
		line-height: 10px;
		text-align: center;
	}

	.copyright a:hover {
		color: #fff;
	}

    table {
        border-collapse: collapse;
        margin-left: auto;
  		margin-right: auto;
    }
    table tr td,
    table tr th {
        padding: 5px;
    }

    .list-request {
        width: 80%;
        border-collapse: collapse;
        margin-left: auto;
  		margin-right: auto;
    }

    .table-request {
    	width: 30%;
  		margin-left: auto;
  		margin-right: auto;
	}

	.thead-light {
		background-color: #489199; 
	}

	.masthead {
	 	padding-top: 180px;
		height: 100vh;
		min-height: 400px;
		background-image: url('images/header.jpg');
		background-size: cover;
		background-position: center;
		background-repeat: no-repeat;
	}

	.lead {
		text-transform: uppercase !important;
	}
	</style>
</head>
<body>

      <nav class="navbar navbar-custom navbar-fixed-top">
      	<div class="container-fluid">
    	<ul class="nav navbar-nav">
    		<li class="active"><a href="home.php">RYCK Construction</a></li>
    		<li><a href="home.php">Home</a></li>
      		<li><a href="request.php">Request</a></li>
      		<li><a href="orders.php">Orders</a></li>
      		<li><a href="materials.php">Materials</a></li>
    	</ul>
    	<ul class="nav navbar-nav navbar-right">
     		 <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $empName; ?></a></li>
    		<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    	</ul>
  		</div>
	</nav>
	<header class="masthead">
	  <div class="container h-100">
	    <div class="row h-100 align-items-center">
	      <div class="col-12 text-center">
	      	<p class="lead">Providing all kinds of construction services</p>
	        <h1 class="font-weight-light">Constructing Spaces For You</h1>
	      </div>
	    </div>
	  </div>
	</header>

	<section class="py-5">
	  <div class="container">
	    <h2 class="font-weight-light">Your Trusted Builder</h2>
	    <p>We continuously strive to innovate, and build sustainable projects that turn your ideas into reality. We make it our mission to create better spaces for future generations. For a great structure, call RYCK Construction. </p>
	    
	    <h2 class="font-weight-light">Mission</h2>
	    <p>To be the leading and preferred contractor of choice in the country that offers unparalleled service and output. Committed to provide safe, quality and efficient services and maintaining the highest level of professionalism in our relationship with our partners, customers and employees to be able to deliver the Best Customer Experience.</p>
	    
	    <h2 class="font-weight-light">Vision</h2>
	    <p>A company that provides the best in the construction industry by being the best at what we do most and respected for our successes.</p>
	  </div>
	</section>
	</div>

  	<footer class="copyright">
  		<p>Copyright &#169; 2020 RYCK Construction. All Rights Reserved.</p>
  	</footer>

</body>
</html>