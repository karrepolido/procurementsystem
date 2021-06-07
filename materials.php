<?php
	
	include 'config.php';

	session_start();

	$empName = $_SESSION["eName"];

	$resultSupplierName = mysqli_query($con, "SELECT supplierID, supplierName FROM enterprises ORDER BY supplierName");
	$displaySupplierName = "";
	while ($row = mysqli_fetch_array($resultSupplierName)) {
		$displaySupplierName .= "<option value='".$row[0]."'>".$row[1]."</option>";
	}

	$resultProductName = mysqli_query($con, "SELECT DISTINCT productName FROM products ORDER BY productName");
	$displayProductName = "";
	while ($row = mysqli_fetch_array($resultProductName)) {
		$displayProductName .= "<option value='".$row[0]."'>".$row[0]."</option>";
	}


	if (isset($_POST["btnSearch"])) {
		$supplierID = $_POST['selSupplier'];
		$productName = $_POST['selProduct'];
		
		$sql = "SELECT supplierName, supplierAddress, supplierContact, productID, productName, productDescription, price 
				FROM products 
				INNER JOIN enterprises 
				ON enterprises.supplierID = products.supplierID";

		if ( ($supplierID != "-- Select Supplier --") && ($productName != "-- Select Product --")) { 
			$sql .= " WHERE products.productName = '$productName' AND products.supplierID = $supplierID";
		}

		elseif ($supplierID == "-- Select Supplier --") { 
			$sql .= " WHERE products.productName = '$productName'";
		}

		elseif ($productName == "-- Select Product --") {
			$sql .= " WHERE enterprises.supplierID = $supplierID";
		}


		$displayEmpty =  "No result/s found. Please try another.";

		$displaySuppliers = "";

		if ($result = mysqli_query($con, $sql)) {
			while ($row = mysqli_fetch_assoc($result)) {
				$displaySuppliers .= "<tr>
										<td>".$row['supplierName']."</td>
										<td>".$row['supplierAddress']."</td>
										<td>".$row['supplierContact']."</td>
										<td>".$row['productID']."</td>
										<td>".$row['productName']."</td>
										<td>".$row['productDescription']."</td>
										<td>".$row['price']."</td>
									  </tr>";
			}
			
		}

		$resultEmpty = mysqli_num_rows($result);

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

    .table-request {
    	width: 30%;
  		margin-left: auto;
  		margin-right: auto;
	}

	 .thead-light {
		background-color: #489199; 
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

      <div class="main">
      	<h1><b>Product Directory</b></h1>
      	<form method="POST">
      		<h5><b>Search By:</b></h5>
      		<label for="selSupplier"> Supplier Name </label>
      		<select name="selSupplier" id="selSupplier">
      			<option>-- Select Supplier --</option>
      			<?php echo $displaySupplierName; ?>
      		</select>
      		&nbsp; 
      		<label for="selProduct">Product Name</label>
      		<select name="selProduct" id="selProduct">
      			<option> -- Select Product -- </option>
      			<?php echo $displayProductName; ?>
      		</select>
      		&nbsp; 
      		<input type="submit" name="btnSearch" value="Search">
      	</form>
      	<br>
        <table class="table table-striped table-bordered">

		        	<?php if (isset($_POST["btnSearch"])) {
			        		if ($resultEmpty == 0) {
			        			echo "<tr>
										<td colspan='7'>".$displayEmpty."</td>
									</tr>";
			        		}
			        		else {

			        			echo "<tr>
										<th>Supplier</th>
										<th>Address</th>
										<th>Contact</th>
							            <th>Product ID</th>
							            <th>Name</th>
							            <th>Description</th>
							            <th>Price</th>
		        					</tr> ".$displaySuppliers; 
			        		}
		        	}?>
		</table>
    </div>
  </form>
</div>
  	<footer class="copyright">
  		<p>Copyright &#169; 2020 RYCK Construction. All Rights Reserved.</p>
  	</footer>

</body>
</html>