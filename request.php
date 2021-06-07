<?php
	
	include 'config.php';

	session_start();

	$empName = $_SESSION["eName"];
	$empID = $_SESSION["eID"];

	$sqlProduct = "SELECT * FROM products GROUP BY productDescription";
	$resultProduct = mysqli_query($con, $sqlProduct);
	$displayProduct = "";
	while ($row = mysqli_fetch_array($resultProduct)) {
		$displayProduct .= "<option value='".$row[0]."'>".$row[2]."</option>";
	}

	$sessionRequest = mysqli_query($con, "SELECT MAX(orderID) + 1 FROM orders");
	$_SESSION["id"] = mysqli_fetch_row($sessionRequest)[0];
	$orderID = $_SESSION["id"];

	function function_alert($message) {
    	echo "<script>alert('$message');</script>";
    }

	if (isset($_POST["request"])) {
        $productID = $_POST["productDescription"];
        $quantity = $_POST["quantity"];

        $sqlRequest = "INSERT INTO orders (orderID, totalAmount) VALUES ('$orderID',0)"; 
        mysqli_query($con, $sqlRequest);

        for ($i = 0; $i < count($_POST["productDescription"]); $i++) {
        	$sql = "INSERT INTO materials (orderID, employeeID, productID, quantity) VALUES ('$orderID', '$empID', '" . $productID[$i] . "', " . $quantity[$i] . ")";
            if (mysqli_query($con, $sql)) {
                //echo "Material request saved";
            } else {
                //echo "Error: " .$sql . "<br>" . mysqli_error($con);
            }
        }

        $sqlAmount = "SELECT SUM(quantity * price) FROM materials INNER JOIN products ON materials.productID = products.productID WHERE materials.orderID = $orderID";
        $resultAmount = mysqli_query($con, $sqlAmount);
        $displayAmount = mysqli_fetch_row($resultAmount)[0];

        $sqlUpdate = "UPDATE orders SET totalAmount = $displayAmount WHERE orderID = $orderID";
        
        $updated = False;
        if (mysqli_query($con, $sqlUpdate)) {

        	$updated = True;

        }

        if (is_null($productID) || is_null($quantity)) {
    		//echo function_alert("Oops! Please fill in the table with correct data.");
    		header("Location: request.php");
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

    #list-request {
        width: 80%;
        border-collapse: collapse;
        margin-left: auto;
  		margin-right: auto;
    }

    .table-request {
    	width: 25%;
  		margin-left: auto;
  		margin-right: auto;
	}


	.table-reqmat {
		table-layout: fixed;
    	width: 100%;
  		margin-left: auto;
  		margin-right: auto;
	}

	.thead-light {
		background-color: #005E66; 
		color: white;
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

	.alert {
		padding: 8px;
		background-color: #5cb85c;
		color: white;
		margin-left: auto;
  		margin-right: auto;
  		width: 25%;
	}
	</style>

	<script>
	    function addItem() {
	 
	        var html = "<tr>";
	            html += "<td><select name='productDescription[]' id='productDescription'><option value='0' alignment='center'> Select Product </option><?php echo $displayProduct; ?></select></td>";
	            html += "<td><input type='number' name='quantity[]' min='1' max='10000'></td>";
	            html +="<td><button type='button'  onclick='deleteItem()' class='btn btn-danger btn-sm remove'><span class='glyphicon glyphicon-minus'></span> Remove Item</button></td>";
	        	html += "</tr>";
	 
	        var row = document.getElementById('tbody').insertRow();
	        row.innerHTML = html;
	    }
	</script>
	<script>
		function deleteItem() {
		 	document.getElementById('tbody').deleteRow(-1);
		}
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
      	<h1><b>Material Request Form</b></h1>
	      	<?php if (isset($_POST['request']) && $updated == True) {
	                echo "<div class='alert'><center><strong>Your transaction has been saved.</strong></center></div>"; 
	            } ?>
        <form method="POST">
			<table class="table-reqmat table-striped table-bordered">
				<thead>
					<tr>
		            	<th>Item Description</th>
		            	<th>Quantity</th>
		            	<th><button type="button" onclick="addItem()" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span> Add Items</button></th>
		        	</tr>
		    	</thead>
        			<tbody id="tbody"></tbody>
			</table>
			
			<table class="table-request">
				<tr>
					<td><input type="submit" name="request" class="btn btn-primary" value="Request Materials"></td>
					<td><button onclick="document.getElementById('id01').style.display='block'" class="btn btn-primary">Cancel Request</button></td>
				</tr>
			</table>
		</form>
    </div>

  	<footer class="copyright">
  		<p>Copyright &#169; 2020 RYCK Construction. All Rights Reserved.</p>
  	</footer>

</body>
</html>
