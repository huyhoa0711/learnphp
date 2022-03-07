<?php 
	function user (){
		$ten = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$address = $_POST['address'];
		
		if(empty($_POST))return ;
		if(empty($_POST['name'])){
			$ten = $_POST['name'];
		}
		if(empty($_POST['email'])){
			$email = $_POST['email'];
		}
		if(empty($_POST['phone'])){
			$phone = $_POST['phone'];
		}
		if(empty($_POST['address'])){
			$address = $_POST['address'];
		}
		insert($ten, $email, $phone, $address);
	}
	user();
	function getAll(){
		$mysqli = new mysqli("localhost","root","","qlhs");

		// Check connection
		if ($mysqli -> connect_errno) {
		  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
		  exit();
		}

		// Perform query
		if ($result = $mysqli -> query("SELECT * FROM inputt")) {
		  echo "Returned rows are: " . $result -> num_rows;
		  // Free result set
		   $bien = $result -> fetch_all();
		}
		$mysqli -> close();
		return $bien;
	}

	$layDuLieu = getall();
	function insert($ten, $email, $phone, $address){
		$mysqli = new mysqli("localhost","root","","qlhs");

		// Check connection
		if ($mysqli -> connect_errno) {
		  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
		  exit();
		}

		$stmt = $mysqli -> prepare("INSERT INTO inputt (ten, email, phone, address) VALUES (?, ?, ?,?)");
		$stmt -> bind_param("ssis", $ten, $email, $phone,$address);

		// set parameters and execute
		$hoa = $stmt -> execute();

		$stmt -> close();
		$mysqli -> close();
	}
?>	
<!DOCTYPE html>
<html>
<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<form method="POST">
		ID:<input type="text" class="form-control" name="id"><br>
		Name:<input type="text" class="form-control" name="name"><br>
		email:<input type="text" class="form-control" name="email"><br>
		phone:<input type="text" class="form-control" name="phone"><br>
		address:<input type="text" class="form-control" name="address"><br>
		<input type="submit" name="form_click" value="Gửi Dữ Liệu"/>
	</form>
	<table class="table table-striped table-dark">

		<tr>
			<td>id</td>
			<td>name</td>
			<td>email</td>
			<td>phone</td>
			<td>address</td>
		</tr>
		<?php foreach($layDuLieu as $key => $value) {?>
			<tr>
				<td><?php echo $value[0]?></td>
				<td><?php echo $value[1] ?></td>
				<td><?php echo $value[2] ?></td>
				<td><?php echo $value[3] ?></td>
				<td><?php echo $value[4] ?></td>
			</tr>	
     	<?php } ?>	
	</table>
</body>
</html>