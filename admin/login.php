<html>

<head>
	<meta charset="utf-8">
	<title>Form</title>
	<link href="css/style.css" type="text/css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
	<!-- Body of Form starts -->
	<div class="container">
		<?php
		include("oop.php");
		// include("registration.php");
		$db = new DB();
		$db->_get();
		if (isset($_POST['Submit'])) {
			$error = [];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$data = $db->select("*", "users", "email='$email'");
			$row = $data->fetch(PDO::FETCH_ASSOC);
			if ($row) {
				if ($row['password'] == $password) {
					// session_start();
					// $_SESSION['fname']=$fname. $sname;
					header("location:meals.php");
				} else {
					$error['pass'] = "enter vaild pass";
				}
			} else {
				$error['email'] = "email not found";
			}
			session_start();
			$_SESSION['firstName'] = $row['firstName'];
		}

		?>
		<form method="post" autocomplete="on" action="<?php echo $_SERVER['PHP_SELF'] ?>">
			<!---Email ID---->
			<div class="box">
				<label for="email" class="fl fontLabel"> Email ID: </label>
				<div class="fl iconBox"><i class="fa fa-envelope" aria-hidden="true"></i></div>
				<div class="fr">
					<input type="email" name="email" placeholder="Email Id" class="textBox">
					<p style="color: white;"><?php if (isset($error['email'])) {
													echo $error['email'];
												} ?></p>

				</div>
				<div class="clr"></div>
			</div>
			<!--Email ID----->

			<!---Password------>
			<div class="box">
				<label for="password" class="fl fontLabel"> Password </label>
				<div class="fl iconBox"><i class="fa fa-key" aria-hidden="true"></i></div>
				<div class="fr">
					<input type="Password" name="password" placeholder="Password" class="textBox">
					<p style="color: white;"><?php if (isset($error['pass'])) {
													echo $error['pass'];
												} ?></p>

				</div>
				<div class="clr"></div>
			</div>
			<!---Password---->

			<!---Submit Button------>
			<div class="box" style="background: #2d3e3f">
				<input type="Submit" name="Submit" class="submit" value="Login">
			</div>
			<!---Submit Button----->
		</form>
	</div>
	<!--Body of Form ends--->
</body>

</html>