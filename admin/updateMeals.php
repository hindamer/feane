<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Update Post</title>
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
			$data = $db->select("*", "meal", "id='$id'");
			$row = $data->fetch(PDO::FETCH_ASSOC);
		}
		if (isset($_POST['update'])) {
			$id = $_POST['id'];
			$title = $_POST['title'];
			$content = $_POST['content'];
			$price = $_POST['price'];
			if (isset($_POST['family'])) {
				$family = $_POST['family'];
			} else {
				$family = 0;
			}
			if (isset($_POST['size'])) {
				$size = $_POST['size'];
			} else {
				$size = "null";
			}
			$image = $_FILES['image']['name'];
			$temp = $_FILES['image']['tmp_name'];
			if (isset($_FILES['image']['tmp_name'])) {
				move_uploaded_file($temp, 'C:\\xampp\\htdocs\\final\\admin\\images' . $image);
			} else {
				$image = "no image";
			}
			$db->edit("meal", "title='$title',content='$content',price='$price',family='$family',size='$size',image='$image'", "id='$id'");
			header("location:meals.php");
		}

		?>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="m-auto" style="max-width:600px" enctype="multipart/form-data">
			<h3 class="my-4">Update Post</h3>
			<hr class="my-4" />
			<div class="form-group mb-3 row"><label for="title2" class="col-md-5 col-form-label">Post Title</label>
				<div class="col-md-7"><input type="text" class="form-control form-control-lg" id="title2" name="title" value="<?php echo $row['title'] ?>" placeholder="Enter Post Title"></div>
			</div>

			<hr class="bg-transparent border-0 py-1" />
			<input type="hidden" name="id" value="<?php echo $row['id'] ?>">
			<div class="form-group mb-3 row"><label for="content4" class="col-md-5 col-form-label">Content</label>
				<div class="col-md-7"><textarea class="form-control form-control-lg" id="content4" name="content" placeholder="Enter Content">
						<?php echo $row['content'] ?>
					</textarea></div>
			</div>

			<hr class="my-4" />
			<div class="form-group mb-3 row"><label for="featured" class="col-md-5 col-form-label">family</label>
				<div class="col-md-7"><input type="checkbox" id="featured" name="family" value="1" <?php
																									if (isset($row['family'])) {
																										if ($row['family'] == 1) {
																											echo 'checked';
																										}
																									}
																									?>></div>
			</div>

			<hr class="my-4" />
			<div class="form-group mb-3 row"><label for="size" class="col-md-5 col-form-label">Size</label>
				<div class="col-md-7"><input type="radio" id="size" name="size" value="small" <?php
																								if (isset($row['size'])) {
																									if ($row['size'] == "small") {
																										echo 'checked';
																									}
																								}
																								?>>small
					<input type="radio" id="size" name="size" value="large" <?php
																			if (isset($row['size'])) {
																				if ($row['size'] == "large") {
																					echo 'checked';
																				}
																			}
																			?>>large
				</div>
			</div>
			<hr class="my-4" />
			<div class="form-group mb-3 row"><label for="featured" class="col-md-5 col-form-label">Price</label>
				<div class="col-md-7"><input id="price" name="price" value="<?php echo $row['price'] ?>"></div>
			</div>

			<hr class="my-4" />
			<img src="./images/<?php echo $row['image'] ?>" alt="" style="width:100px; height:100px;">
			<div>
				<label for="image" class="col-md-5 col-form-label">Select Image</label>
				<input type="file" id="image" name="image" accept="image/*">
			</div>

			<hr class="my-4" />
			<div class="form-group mb-3 row"><label for="insert10" class="col-md-5 col-form-label"></label>
				<div class="col-md-7"><button class="btn btn-primary btn-lg" type="submit" name="update">Update</button></div>
			</div>
		</form>
	</div>
</body>

</html>