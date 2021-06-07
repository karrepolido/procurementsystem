<?php
	
	include 'config.php';

	session_start();

	$empName = $_SESSION["eName"];
	//$sql = "INSERT INTO orders (orderID, totalAmount) 
	//		SELECT SUM (price)
	//		FROM
	//		VALUES ('$orderID',0)"; 
	$sql = "SELECT supplierName, supplierAddress, supplierContact FROM enterprises";
	$displaySuppliers = "";

	if ($result = mysqli_query($con, $sql)) {
		while ($row = mysqli_fetch_assoc($result)) {
			$displaySuppliers .= "<tr><td>".$row['supplierName']."</td><td>".$row['supplierAddress']."</td><td>".$row['supplierContact']."</td>";
		}
		mysqli_free_result($result);
	}
    
    mysqli_close($con);

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
		padding: 2px;
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
		background-image: url('header.jpg');
		background-size: cover;
		background-position: center;
		background-repeat: no-repeat;
	}

	.lead {
		text-transform: uppercase !important;
	}
	</style>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#tablelist').DataTable();
		} );
	</script>
</head>
<body>

      <nav class="navbar navbar-custom navbar-fixed-top">
      	<div class="container-fluid">
    	<ul class="nav navbar-nav">
    		<li class="active"><a href="home.php">Home</a></li>
      		<li><a href="request.php">Request</a></li>
      		<li><a href="orders.php">Orders</a></li>
      		<li><a href="suppliers.php">Suppliers</a></li>
      		<li><a href="materials.php">Materials</a></li>
    	</ul>
    	<ul class="nav navbar-nav navbar-right">
     		<li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $empName; ?></a></li>
    		<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    	</ul>
  		</div>
	</nav>
      <div class="main">
      	<h1><b>LIST OF SUPPLIERS</b></h1>
        <table id="tablelist" class="table table-striped table-bordered">
        	<thead class="thead-light">
				<tr>
		            <th>SUPPLIERS NAME</th>
		            <th>ADDRESS</th>
		            <th>CONTACT NUMBER</th>
		        </tr>
		    </thead>

		        	<?php echo $displaySuppliers; ?>
		</table>
    </div>
  </form>
</div>

  	<footer class="copyright">
  		<p>Footer Text</p>
  	</footer>

</body>
</html>