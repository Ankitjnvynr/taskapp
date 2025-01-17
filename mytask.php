<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
	header("location: index.php");
	exit;
}
$success = true;
?>
<?php
date_default_timezone_set("Asia/Kolkata");

?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>My Task :
		<?php echo $_SESSION['user'] ?>
	</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
	integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
	integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
	crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
	integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
	crossorigin="anonymous" referrerpolicy="no-referrer" />
	<style>
		.myinout {
			display: inline-block !important;
		}
	</style>
</head>

<body class="bg-light rounded-4">

	<!-- ---------------toast notificaton start----------- -->


	<div class="toast-container position-fixed bottom-0 end-0 p-3">
		<div id="liveToast" class="toast " role="alert" aria-live="assertive" aria-atomic="true">
			<div class="toast-header bg-primary-success">
				<span class="fs-4"><i
					class="rounded <?php echo $success ? 'text-success' : 'text-danger' ?> me-2 fa-solid fa-circle-check"></i>
				</span>
				<strong class="me-auto">
					<?php echo $success ? 'Success' : 'Warning' ?>
				</strong>
				<small>Just Now</small>
				<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
			</div>
			<div id="toastBody" class="toast-body bg-primary-subtle">
				Hello, world! This is a toast message.
			</div>
		</div>
	</div>
	<!-- ---------------toast notificaton end ----------- -->
	<!-- ---------------update modall start----------- -->

	<div class="modal fade" id="UpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<form id="UpdateForm">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="exampleModalLabel">Updating....</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

					<div class="modal-body">

						<div class="row mb-2">
							<input type="hidden" id="updateID">
							<div class=" py-2 d-flex flex-column gap-2 justify-content-center align-items-center">
								<textarea name="task" id="updateTask"
									class="form-control  border border-primary text-primary" required rows="2">
								</textarea>
								<input name="ufromTime" placeholder="--:--" id="ufromTime" type="time"
								class="myinout form-control border border-primary text-primary" required>

								<input name="utoTime" placeholder="--:--" id="utoTime" type="time"
								class="myinout form-control border border-primary text-primary" required>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-----update modall end----------- -->



	<div style="backdrop-filter:blur(3px)"
		class="container sticky-top  d-flex justify-content-between align-items-center gap-2 py-2">
		<a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
			aria-controls="offcanvasExample">
			<i class="fa-solid fa-bars"></i>
		</a>
		<h4 class=" p-0 m-0 text-center text-primary">Welcome -
			<?php echo $_SESSION['user'] ?>
		</h4>
	</div>

	<div class="container">


		<div style="max-width:250px;" class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
			aria-labelledby="offcanvasExampleLabel">
			<div class="offcanvas-header">
				<h5 class="offcanvas-title text-primary" id="offcanvasExampleLabel"> Profile</h5>
				<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
			</div>
			<div class="offcanvas-body d-flex flex-column justify-content-between">
				<div>
					<div class="d-flex flex-column justify-content-center align-items-center ">
						<div id="uPic" class="border border-primary rounded-circle overflow-hidden shadow mb-2"
							style="width:100px"></div>
						<h6 class="fs-4 fw-3">
							<?php echo $_SESSION['user'] ?>
						</h6>

					</div>
					<div class="accordion accordion-flush" id="accordionFlushExample">
						<div class="accordion-item">
							<h2 class="accordion-header">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
									data-bs-target="#flush-collapseTwo" aria-expanded="false"
									aria-controls=" flush-collapseTwo ">
									Change Picture
								</button>
							</h2>
							<div id="flush-collapseTwo" class="accordion-collapse collapse"
								data-bs-parent="#accordionFlushExample">
								<div class="accordion-body">
									<div>
										<div class="form-floating my-2">
											<input type="file" class="myinout form-control" id="updatePic"
											accept="image/*" capture="camera" onchange="validateImage()" required>
											<label for="updatePassword">Choose Image</label>
										</div>
										<button class="btn btn-primary" id="uploadImage">Update Image</button>

									</div>

								</div>
							</div>
						</div>
						<div class="accordion-item">
							<h2 class="accordion-header">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
									data-bs-target="#flush-collapseOne" aria-expanded="false"
									aria-controls=" flush-collapseOne ">
									Change Password
								</button>
							</h2>
							<div id="flush-collapseOne" class="accordion-collapse collapse"
								data-bs-parent="#accordionFlushExample">
								<div class="accordion-body">
									<div>
										<form id="updatePass" method="POST">
											<div class="form-floating my-2">
												<input type="password" class="myinout form-control" id="updatePassword"
												placeholder="Enter new Password" required>
												<label for="updatePassword">Enter New Password</label>
											</div>
											<div class="form-floating my-1">
												<button class="btn btn-primary">change</button>

											</div>

										</form>
									</div>

								</div>
							</div>
						</div>

					</div>
				</div>
				<div class="mb-3">
					<a href="logout.php" class="btn btn-danger">Logout</a>
				</div>

			</div>
		</div>



	</div>
	<div class="container">
		<form id="myForm">
			<div class="row mb-2">
				<div class="col-md-11  py-2 d-flex justify-content-center align-items-center">
					<textarea name="task" id="task" class="form-control  border border-primary text-primary" required
						rows="2" placeholder="Enter your task here"></textarea>
				</div>
				<?php
				// <label class="border p-1 px-3" for="toTime">Enter The Last Time</label>
				// <label class="border p-1 px-3" for="fromTime">Enter The Start Time</label>
				?>
				<div class="col-md-11  py-2 d-flex gap-3">

					<input name="fromTime" id="fromTime" type="time"
					class="myinout form-control border border-primary text-primary" placeholder="ndksjfkshkjd"
					required>

					<input name="toTime" id="toTime" type="time"
					class="myinout form-control border border-primary text-primary" required>
				</div>
				<div class="col-md-1 d-flex justify-content-center align-items-center">
					<button class="btn btn-primary">Add</button>
				</div>
			</div>
		</form>
	</div>
	<div class="container my-2">
		Task of the day
	</div>
	<div class="container allTask">
	</div>

	<div class="container ">
		<p class=" my-0 mt-2">
			<span class="d-flex flex-column">
				<label for="filterDate">Select a Date to view past Task</label>
				<input id="filterDate" onchange="loadpast()" style="max-width:200px;"
				class="myinout form-control border border-primary" type="date">
			</span>
		</p>
	</div>
	<div class="container " id="Past"></div>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
		integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
		crossorigin="anonymous" referrerpolicy="no-referrer">
	</script>

		<script src="js/push.min.js"></script>
	<script src="js/serviceWorker.min.js" ></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/1.0.8/push.min.js" integrity="sha512-eiqtDDb4GUVCSqOSOTz/s/eiU4B31GrdSb17aPAA4Lv/Cjc8o+hnDvuNkgXhSI5yHuDvYkuojMaQmrB5JB31XQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/1.0.8/serviceWorker.min.js" integrity="sha512-gZN7SatPzB7LiGjOd4Sree/ecjktoLPgWt22wfApKrzuCpS9KsK7uKEDB+AAGY96NHCW1sAEm1JdaHDDP4MsIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
	
	
	<script src="js/script.js"></script>

	
</body>

</html>