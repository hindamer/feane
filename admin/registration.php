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
		$db = new DB();
		$db->_get();
		if (isset($_POST['Submit'])) {
			$error = [];
			if (isset($_POST['firstName']) && empty($_POST['firstName'])) {
				$error['ferror'] = "enter your first name";
			} else {
				$fname = $_POST['firstName'];
			}
			if (isset($_POST['secondName']) && empty($_POST['secondName'])) {
				$error['serror'] = "enter your sec name";
			} else {
				$sname = $_POST['secondName'];
			}
			if (isset($_POST['phoneNo']) && empty($_POST['phoneNo'])) {
				$error['perror'] = "enter your phoneNum";
			} else {
				$phone = $_POST['phoneNo'];
			}
			if (isset($_POST['Gender'])) {
				$Gender = $_POST['Gender'];
			} else {
				$Gender = "null";
			}
			if (isset($_POST['Terms'])) {
				$Terms = $_POST['Terms'];
			} else {
				$Terms = 0;
			}
			$email = $_POST['email'];
			$password = $_POST['password'];
			$upp = preg_match('@[A-Z]@', $password);
			$low = preg_match('@[a-z]@', $password);
			$num = preg_match('@[0-9]@', $password);
			$char = preg_match('@[^\w]@', $password);
			if (isset($_POST['email']) && empty($_POST['email'])) {
				$error['emailer'] = 'enter your email';
			} else {
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$error['email'] = "enter validate email";
				} elseif (isset($_POST['password']) && empty($_POST['password'])) {
					$error['passerror'] = "enter your pass";
				} else if (!$upp || !$low || !$num || !$char || strlen($password) < 8) {
					$error['pass'] = "enter valid pass";
				} else {
					if (count($error) <= 0) {
						$db->insert("users", "firstName,secondName,phoneNo,Gender,Terms,email,password", "'$fname','$sname','$phone','$Gender','$Terms','$email','$password'");
						session_start();
						$_SESSION['fname'] = $fname . $sname;
						header("location:meals.php");
					}
				}
			}
		}
		?>
		<form method="post" autocomplete="on" action="<?php echo $_SERVER['PHP_SELF'] ?>">
			<!--First name-->
			<div class="box">
				<label for="firstName" class="fl fontLabel"> First Name: </label>
				<div class="new iconBox">
					<i class="fa fa-user" aria-hidden="true"></i>
				</div>
				<div class="fr">
					<input type="text" name="firstName" placeholder="First Name" class="textBox" autofocus="on">
					<p style="color: white;"><?php if (isset($error['ferror'])) {
													echo $error['ferror'];
												} ?></p>
				</div>
				<div class="clr"></div>
			</div>
			<!--First name-->


			<!--Second name-->
			<div class="box">
				<label for="secondName" class="fl fontLabel"> Seconed Name: </label>
				<div class="fl iconBox"><i class="fa fa-user" aria-hidden="true"></i></div>
				<div class="fr">
					<input type="text" name="secondName" placeholder="Last Name" class="textBox">
					<p style="color: white;"><?php if (isset($error['serror'])) {
													echo $error['serror'];
												} ?></p>

				</div>
				<div class="clr"></div>
			</div>
			<!--Second name-->


			<!---Phone No.------>
			<div class="box">
				<label for="phone" class="fl fontLabel"> Phone No.: </label>
				<div class="fl iconBox"><i class="fa fa-phone-square" aria-hidden="true"></i></div>
				<div class="fr">
					<input type="text" name="phoneNo" maxlength="10" placeholder="Phone No." class="textBox">
					<p style="color: white;"><?php if (isset($error['perror'])) {
													echo $error['perror'];
												} ?></p>

				</div>
				<div class="clr"></div>
			</div>
			<!---Phone No.---->


			<!---Email ID---->
			<div class="box">
				<label for="email" class="fl fontLabel"> Email ID: </label>
				<div class="fl iconBox"><i class="fa fa-envelope" aria-hidden="true"></i></div>
				<div class="fr">
					<input type="text" name="email" placeholder="Email Id" class="textBox">
					<p style="color: white;"><?php if (isset($error['emailer'])) {
													echo $error['emailer'];
												} ?></p>
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
					<p style="color: white;"><?php if (isset($error['passerror'])) {
													echo $error['passerror'];
												} ?></p>
					<p style="color: white;"><?php if (isset($error['pass'])) {
													echo $error['pass'];
												} ?></p>


				</div>
				<div class="clr"></div>
			</div>
			<!---Password---->

			<!---Gender----->
			<div class="box radio">
				<label for="gender" class="fl fontLabel"> Gender: </label>
				<input type="radio" name="Gender" value="Male"> Male &nbsp; &nbsp; &nbsp; &nbsp;
				<input type="radio" name="Gender" value="Female"> Female
			</div>
			<!---Gender--->


			<!--Terms and Conditions------>
			<div class="box terms">
				<input type="checkbox" name="Terms" value="1"> &nbsp; I accept the terms and conditions
			</div>
			<!--Terms and Conditions------>



			<!---Submit Button------>
			<div class="box" style="background: #2d3e3f">
				<input type="Submit" name="Submit" class="submit" value="SUBMIT">
			</div>
			<!---Submit Button----->
		</form>
	</div>
	<!--Body of Form ends--->
</body>

</html>