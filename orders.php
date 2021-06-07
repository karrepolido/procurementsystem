<?php
	
	include 'config.php';

	session_start();

	$empName = $_SESSION["eName"];
	
	$sql = "SELECT materials.orderID, orders.totalAmount, materials.dateSubmitted, employee.employeeName 
		FROM materials 
		INNER JOIN orders ON  materials.orderID = orders.orderID
		INNER JOIN employee ON materials.employeeID = employee.employeeID";
	$result = mysqli_query($con, $sql);
	$displayOrders = "";
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_array($result)) {
			$displayOrders .= "<tr><td>" .$row['orderID']. "</td><td>" .$row['totalAmount']. "</td><td>" .$row['employeeName']. "</td><td>" .$row['dateSubmitted']. "</td></tr>";
		}
	}

	if (isset($_POST['query'])) {
		$query = $_POST['query'];
		$min_legth = 1;

		if (strlen($query) >= $min_legth) {
			$query = htmlspecialchars($query);
			$query = mysqli_real_escape_string($con, $query);

			$sqlSearch = "SELECT * FROM materials 
			WHERE orderID LIKE '%$query%'
			OR productID LIKE '%$query%'";
			;
			$raw_results = mysqli_query($con, $sqlSearch) or die(mysql_error()); 
				if (mysqli_num_rows($raw_results) > 0) {
					while ($row = mysqli_fetch_array($raw_results)) {
						echo "<p>" .$row['orderID']. "-" .$row['productID']. "-" .$row['quantity']."</p>";
					}
				}
				else {
					echo "No results";
				}
		}
	}
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
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
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
		margin-bottom: 30px;
		font-family: 'Roboto', sans-serif;
		color: #362F37;
	}

	/** footer section **/
	.copyright {
		background-color: #005E66;
		padding: 10px 0 2px 0;
		margin-top: 50px;
		position: fixed;
  		left: 0;
  		bottom: 0;
  		width: 100%;
  		text-align: center;
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
        width: 100%;
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
		background-color: #83c5be; 
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

	<script type="text/javascript">
		$(document).ready(function () {
  		$('#tablelist').DataTable();
  		$('.dataTables_length').addClass('bs-select');
		});
	</script>

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
      <div class="main">
      	<h1><b>PO Details</b></h1>
        <table id="tablelist" class="table table-striped table-bordered" data-order='[[ 0, "desc" ]]'>
        	<thead>
				<tr>
		            <th>P.O. ID</th>
		            <th>Amount</th>
		            <th>Requested by</th>
		            <th>Date Request</th>
		        </tr>
		    </thead>
		        	<?php echo $displayOrders; ?>
		</table>
    </div>
  </form>
</div>

  	<footer class="copyright">
  		<p>Copyright &#169; 2020 RYCK Construction. All Rights Reserved.</p>
  	</footer>

</body>
</html>