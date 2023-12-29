<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Update User</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style1.css">
	<link rel="stylesheet" href="css/style2.css">
</head>

<body>
	<!-- Start Navbar -->
	<nav id='menu'>
		<input type='checkbox' id='responsive-menu' onclick='updatemenu()'><label></label>
		<ul>
			<li><a href=''>Home</a></li>
			<li><a class='dropdown-arrow' href=''>Posts</a>
				<ul class='sub-menus'>
					<li><a href=''>Posts List</a></li>
					<li><a href=''>Add Car</a></li>
				</ul>
			</li>
			<li><a class='dropdown-arrow' href='testimonials.php'>Users</a>
				<ul class='sub-menus'>
					<li><a href=''>Users List</a></li>
				</ul>
			</li>
			<li><a href='#'>Contact Us</a></li>
		</ul>
	</nav>
	<!-- End Navbar -->

	<div class="container">
		<?php
		include("oop.php");
		$db = new DB();
		$db->_get();
		if (isset($_POST['id'])) {
			$id = $_POST['id'];
			$data = $db->select("*", "users", "id='$id'");
			$row = $data->fetch(PDO::FETCH_ASSOC);
		}
		if (isset($_POST['update'])) {
			$firstName = $_POST['firstName'];
			$secondName = $_POST['secondName'];
			$phoneNo = $_POST['phoneNo'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$id = $_POST['id'];
			if (isset($_POST['Gender'])) {
				$Gender = $_POST['Gender'];
			} else {
				$Gender = "null";
			}
			if (isset($_POST['active'])) {
				$active = $_POST['active'];
			} else {
				$active = 0;
			}
			$db->edit("users", "firstName='$firstName',secondName='$secondName',phoneNo='$phoneNo',email='$email',password='$password',Gender='$Gender',active='$active'", "id='$id'");
			header("location:users.php");
		}
		?>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="m-auto" style="max-width:600px" enctype="multipart/form-data">
			<h3 class="my-4">Update User</h3>
			<hr class="my-4" />
			<input type="hidden" name="id" value="<?php echo $row['id'] ?>">
			<div class="form-group mb-3 row"><label for="firstName" class="col-md-5 col-form-label">First Name</label>
				<div class="col-md-7"><input type="text" class="form-control form-control-lg" id="firstName" name="firstName" value="<?php echo $row['firstName'] ?>"></div>
			</div>

			<hr class="my-4" />
			<div class="form-group mb-3 row"><label for="lastName" class="col-md-5 col-form-label">Last Name</label>
				<div class="col-md-7"><input type="text" class="form-control form-control-lg" id="secondName" name="secondName" value="<?php echo $row['secondName'] ?>"></div>
			</div>

			<hr class="my-4" />
			<div class="form-group mb-3 row"><label for="phone" class="col-md-5 col-form-label">Phone</label>
				<div class="col-md-7"><input type="text" class="form-control form-control-lg" id="phoneNo" name="phoneNo" value="<?php echo $row['phoneNo'] ?>"></div>
			</div>

			<hr class="my-4" />
			<div class="form-group mb-3 row"><label for="email" class="col-md-5 col-form-label">Email</label>
				<div class="col-md-7"><input type="text" class="form-control form-control-lg" id="email" name="email" value="<?php echo $row['email'] ?>"></div>
			</div>

			<hr class="my-4" />
			<div class="form-group mb-3 row"><label for="password" class="col-md-5 col-form-label">Password</label>
				<div class="col-md-7"><input type="password" class="form-control form-control-lg" id="password" name="password" value="<?php echo $row['password'] ?>"></div>
			</div>

			<hr class="my-4" />
			<div class="box radio">
				<label for="gender" class="fl fontLabel"> Gender:</label>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
				<input type="radio" name="Gender" value="Male" <?php
																if (isset($row['Gender'])) {
																	if ($row['Gender'] == "Male") {
																		echo 'checked';
																	}
																}

																?>>Male &nbsp; &nbsp; &nbsp; &nbsp;
				<input type="radio" name="Gender" value="Female" <?php
																	if (isset($row['Gender'])) {
																		if ($row['Gender'] == "Female") {
																			echo 'checked';
																		}
																	}
																	?>>Female
			</div>

			<hr class="my-4" />
			<div class="form-group mb-3 row"><label for="active" class="col-md-5 col-form-label">Active</label>
				<div class="col-md-7"><input type="checkbox" id="active" name="active" value="1" <?php
																									if (isset($row['active'])) {
																										if ($row['active'] == 1) {
																											echo 'checked';
																										}
																									}
																									?> ?></div>
			</div>

			<hr class="my-4" />
			<div class="form-group mb-3 row"><label for="insert10" class="col-md-5 col-form-label"></label>
				<div class="col-md-7"><button class="btn btn-primary btn-lg" name="update" type="submit">Update</button></div>
			</div>
		</form>
	</div>
</body>

</html>