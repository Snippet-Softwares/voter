<?php
	$conn = mysqli_connect('localhost', 'root', 'Nokia5.1+', 'poll') or die(mysql_error());
	$result = mysqli_query($conn, "select * from users order by number asc") or die(mysqli_error($conn));
	if (isset($_POST['btnSubmit'])) {
		$array = array();
		$id = $_POST['txtid'];
		$name = $_POST['txtname'];
		$res = mysqli_query($conn, "select * from users") or die(mysqli_error($conn));
		if (mysqli_num_rows($res) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$array[] = $row['number'];
			}
			do {
			    $rand = rand(1, 100);
			} while(in_array($rand, $array));
			$query = mysqli_query($conn, "insert into users (name,id,number) values ('".$name."','".$id."','".$rand."')") or die(mysqli_error($conn));
			if ($query) {
				echo "<script>window.alert('Success! Dear $name, you are welcome')</script>";
			}
			else {
				echo "<script>window.alert('Failed! Try again later')</script>";
			}
			echo '<META HTTP-EQUIV="refresh" content="0;URL=index.php">';
		}
		else {
			$rand = rand(1, 100);
			$query = mysqli_query($conn, "insert into users (name,id,number) values ('".$name."','".$id."','".$rand."')") or die(mysqli_error($conn));
			if ($query) {
				echo "<script>window.alert('Success! Dear $name, you are welcome')</script>";
			}
			else {
				echo "<script>window.alert('Failed! Try again later')</script>";
			}
			echo '<META HTTP-EQUIV="refresh" content="0;URL=index.php">';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Chama Voter</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<main class="main">
		<div class="container">
			<div class="row mt-5">
				<div class="col-md-4">
					<table class="table bordered table-hover">
						<thead class="text-center">
							<th>Allocated #</th>
							<th>Full Name</th>
							<th>Randm #</th>
						</thead>
						<tbody class="text-center">
							<?php
								$count = 1;
								while ($row = mysqli_fetch_assoc($result)) { ?>
									<tr>
										<td><?php echo $count; ?></td>
										<td><?php echo $row['name']; ?></td>
										<td><?php echo $row['number']; ?></td>
									</tr><?php
									$count++;
								}
							?>
						</tbody>
					</table>
				</div>
				<div class="col-md-8">
					<div class="container">
						<div class="row">
				            <div class="card h-100 shadow border border-3 p-5">
				            	<form method="POST">
					            	<div class="row">
						                <label>Full Name</label>
						                <input type="text" class="form-control mt-2 mb-3" name="txtname" placeholder="Full Name" required>
						                <label>National ID</label>
						                <input type="text" class="form-control mt-2" name="txtid" placeholder="ID/Passport number" required>
						            </div>
						            <div class="row mt-4">
						                <button type="submit" name="btnSubmit" class="btn btn-info btn-block">Poll</button>
						            </div>
						        </form>
				            </div>
				        </div>
			        </div>
			    </div>
			</div>
		</div>
	</main>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>