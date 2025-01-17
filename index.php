<?php


$scrr = false;

session_start();

if (isset($_SESSION['loggedin'])) {

	//	header('location : dashboard.php');

	header("location: mytask.php");



	exit;

}

include("assest/_db.php");

$msg = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if (isset($_POST['login'])) {

		$username = $_POST['loginName'];

		$password = $_POST['loginPwd'];



		$sql = "SELECT * FROM users WHERE  username = '$username'";

		$result = mysqli_query($conn, $sql);

		$num = mysqli_num_rows($result);

		if ($num == 1) {

			while ($row = mysqli_fetch_assoc($result)) {

				if (password_verify($password, $row['password'])) {

					$logged = true;

					session_start();

					$_SESSION['loggedin'] = true;

					$_SESSION['user'] = $row['name'];

					$_SESSION['userId'] = $row['user_id'];
					$_SESSION['userpic'] = $row['pic'];

					$_SESSION['username'] = $username;

					$_SESSION['intro'] = true;

					header("location: mytask.php");

					exit;

				} else {

					$msg = "Password not match";

				}

			}

		} else {

			$msg = "User not found";

		}

	}

	if (isset($_POST["signup"])) {

		$sname = $_POST["sname"];

		$smail = $_POST["smail"];

		$spwd = $_POST["spwd"];



		$hash = password_hash($spwd, PASSWORD_DEFAULT);

		$sql = "INSERT INTO `users`( `name`, `username`, `password`) VALUES ('$sname','$smail','$hash')";

		try {

			$result = $conn->query($sql);

			if ($result) {

				$scrr = false;

				$msg = "Successfully Signup : Login Now";

			} else {

				$scrr = true;

				$msg = "Email already exsist";

			}

		} catch (\Throwable $th) {

			//throw $th;

			$scrr = true;

			$msg = "Email already exsist";

		}

	}

}

// echo password_hash('ankit', PASSWORD_DEFAULT);

?>

<head>
	<!DOCTYPE html>
	<html lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>My Task</title>
	<style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");


		* {
			padding: 0;
			margin: 0;
			font-family: "Poppins", sans-serif;
			box-sizing: border-box;
			color: #162938;
			transition: all 1s ease-in-out;
		}

		body {
			display: flex;
			justify-content: center;
			align-items: center;
			min-height: 100vh;
			user-select: none;
			background-image: url(imgs/bg.jpg);
			background-size: cover;
			background-repeat: none;
		}

		#form {
			width: 400px;
			height: 440px;
			border: 2px solid rgba(255, 255, 255, 0.5);
			border-radius: 20px;
			box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
			overflow: hidden;
			transition: transform 0.5s ease, height 0.2s ease;
		}

		#form.active {
			height: 520px;
		}

		#form.active-btn {
			transform: scale(1);
		}

		.wrapper {
			position: relative;
			-webkit-backdrop-filter: blur(5px);
			backdrop-filter: blur(5px);
			display: flex;
			justify-content: center;
			align-items: center;
			overflow: hidden;
			transition: transform 0.5s ease, height 0.2s ease;
		}

		.wrapper.active-btn {
			transform: scale(1);
		}

		.wrapper.active {
			height: 520px;
		}

		.wrapper .form-box {
			width: 100%;
			padding: 40px;
		}

		.wrapper .form-box.register {
			position: absolute;
			transition: none;
			transform: translatex(400px);
		}

		.wrapper .form-box.login {
			transition: trasform 0.18s ease;
			transform: translateX(0);
		}

		.wrapper.active .form-box.login {
			transition: none;
			transform: translateX(-400px);
		}

		.wrapper.active .form-box.register {
			transition: trasform 0.18s ease;
			transform: translateX(0);
		}

		.form-box h2 {
			font-size: 2em;
			text-align: center;
		}

		.input-box {
			position: relative;
			width: 100%;
			height: 50px;
			border-bottom: 2px solid #162938;
			margin: 30px 0;
		}

		.input-box label {
			position: absolute;
			top: 50%;
			left: 5px;
			transform: translateY(-50%);
			font-size: 1em;
			font-weight: 500;
			pointer-events: none;
			transition: 0.5s;
		}

		.input-box input:focus~label,
		.input-box input:valid~label {
			top: -5px;
		}

		.input-box input {
			width: 100%;
			height: 100%;
			background: transparent;
			border: none;
			outline: none;
			font-size: 1em;
			font-weight: 600;
			padding: 0 35px 0 5px;
		}

		.input-box .icon {
			position: absolute;
			right: 8px;
			font-size: 1.2em;
			color: #162938;
			line-height: 57px;
		}

		.register span {
			margin-left: 5px;
		}

		.register-link span:hover,
		.login-link span:hover {
			text-decoration: underline;
		}

		.register {
			font: 0.9em;
			text-align: center;
			font-weight: 500;
			margin: 25px 0 10px;
		}

		.error-msg {
			font: 0.9em;
			text-align: center;
			font-weight: 500;
			color: #8f0606;
			/* margin: 25px 0 10px; */
		}

		.submit-btn {
			width: 100%;
			height: 45px;
			background: #162938;
			border: none;
			outline: none;
			border-radius: 25px;
			color: #fff;
			font-size: 1em;
			font-weight: 500;
			cursor: pointer;
		}
		.btn {
			cursor: pointer;
		}

		/* form css */
	</style>
</head>

<body>

	<section id="form">
		<div class="wrapper">
			<div class="form-box login">

				<h2>Login</h2>

				<form action="" method="post">

					<div class="input-box">

						<span class="icon"><ion-icon name="mail"></ion-icon></span>

						<input type="email" name="loginName" required />

						<label>Email</label>

					</div>

					<div class="input-box">

						<span class="icon"><span class="btn" id="showHide" onclick="showHidePwd()">Show</span><ion-icon name="lock-closed"></ion-icon></span>

						<input type="password" name="loginPwd" 
						id="loginPwd" required />

						<label>Password</label>

					</div>

					<div class="error-msg">

						<p>
							<?php echo $msg ?>
						</p>

					</div>

					<button type="submit" name="login" class="btn submit-btn">Login</button>

					<div class="register">

						<p>
							Don't have a account?<a href="#" class="register-link"><span>Sign Up</span></a>
						</p>

					</div>

				</form>
			</div>

			<div class="form-box register">

				<h2>Sign Up</h2>

				<form action="" method="post">

					<div class="input-box">

						<span class="icon"><ion-icon name="person"></ion-icon></span>

						<input type="text" name="sname" required />

						<label>First Name</label>

					</div>

					<div class="input-box">

						<span class="icon"><ion-icon name="mail"></ion-icon></span>

						<input type="email" name="smail" required />

						<label>Email</label>

					</div>
                    <div class="input-box">

						<span class="icon"><span class="btn" id="showHide2" onclick="showHidePwd2()">Show</span><ion-icon name="lock-closed"></ion-icon></span>

						<input type="password" name="spwd" 
						id="loginPwd2" required />

						<label>Password</label>

					</div>

					

					<div class="error-msg">

						<p>
							<?php echo $msg ?>
						</p>

					</div>

					<button type="submit" name="signup" class="submit-btn">Sign Up</button>

					<div class="register">

						<p>
							Already have a account?<a href="#" class="login-link"><span>Login</span></a>
						</p>

					</div>

				</form>

			</div>
		</div>
	</section>

	<!-- js -->
	<script>

		const wrapper = document.querySelector('.wrapper');
		const form = document.querySelector('#form');
		const loginLink = document.querySelector('.login-link');
		const registerLink = document.querySelector('.register-link');

		registerLink.addEventListener('click', () => {
			wrapper.classList.add('active');
		});

		registerLink.addEventListener('click', () => {
			form.classList.add('active');
		});

		loginLink.addEventListener('click', () => {
			wrapper.classList.remove('active');
		});

		loginLink.addEventListener('click', () => {
			form.classList.remove('active');
		});

	</script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

	<script>
		let showtxt = document.getElementById('showHide');
		let loginPwd = document.getElementById('loginPwd');
			let showtxt2 = document.getElementById('showHide2');
		let loginPwd2 = document.getElementById('loginPwd2');

		showHidePwd = () => {

			if (showtxt.innerText == 'Show') {
				showtxt.innerText = 'Hide';
				loginPwd.type = 'text';
				console.log()
			} else {
				showtxt.innerText = 'Show';
				loginPwd.type = 'password';
			}
		}
			showHidePwd2 = () => {

			if (showtxt2.innerText == 'Show') {
				showtxt2.innerText = 'Hide';
				loginPwd2.type = 'text';
				console.log()
			} else {
				showtxt2.innerText = 'Show';
				loginPwd2.type = 'password';
			}
		}
	</script>
	<!-- js -->
</body>

</html>