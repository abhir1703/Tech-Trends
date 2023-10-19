<?php
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>TechTrends</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Colo Shop Template">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
	<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
	<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
	<link rel="stylesheet" type="text/css" href="styles/responsive.css">
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

</head>

<body>

	<div class="super_container">

		<!-- Header -->

		<header class="header trans_300">

			<!-- Top Navigation -->

			<div class="top_nav">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<div class="top_nav_left">free shipping on all u.s orders over $50</div>
						</div>
						<div class="col-md-6 text-right">
							<div class="top_nav_right">
								<ul class="top_nav_menu">

									<!-- Currency / Language / My Account -->

									<li class="currency">
										<a href="#">
											usd
											<i class="fa fa-angle-down"></i>
										</a>
										<ul class="currency_selection">
											<li><a href="#">cad</a></li>
											<li><a href="#">aud</a></li>
											<li><a href="#">eur</a></li>
											<li><a href="#">gbp</a></li>
										</ul>
									</li>
									<li class="language">
										<a href="#">
											English
											<i class="fa fa-angle-down"></i>
										</a>
										<ul class="language_selection">
											<li><a href="#">French</a></li>
											<li><a href="#">Italian</a></li>
											<li><a href="#">German</a></li>
											<li><a href="#">Spanish</a></li>
										</ul>
									</li>
									<li class="account">
										<a href="#">
											My Account
											<i class="fa fa-angle-down"></i>
										</a>
										<ul class="account_selection">
											<li><a href="login.php"><i class="fa fa-sign-in" aria-hidden="true"></i>Sign
													In</a></li>
											<li><a href="register.php"><i class="fa fa-user-plus"
														aria-hidden="true"></i>Register</a></li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Main Navigation -->

			<div class="main_nav_container">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 text-right">
							<div class="logo_container">
								<a href="index.php">Tech<span>Trends</span></a>
							</div>
							<nav class="navbar">
								<ul class="navbar_menu">
									<li><a href="index.php">home</a></li>
									<li><a href="shop.php">shop</a></li>
									<li><a href="#">promotion</a></li>
									<li><a href="#">pages</a></li>
									<li><a href="#">blog</a></li>
									<li><a href="contact.html">contact</a></li>
								</ul>
								<ul class="navbar_user">
									<li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>
									<?php
									
									// if(isset($count_cart) && $count_cart>0){
									// 	?>
									<?php
									if(isset($_SESSION['user_id'])){
										$user_id=$_SESSION['user_id'];
									}else{}
										// $res=$admin_obj->viewcart($user_id);
										// if(mysqli_num_rows($res)){
										// 	$count_cart=0;
										// 	while($row=mysqli_fetch_assoc($res)){
										// 		$count_cart++;
										// 	}
										// }

									?>
									<li class="checkout">
										<a href="cart.php">
											<i class="fa fa-shopping-cart" aria-hidden="true"></i>
											<span id="checkout_items" class="checkout_items">3
												<!-- <?php echo $count_cart; ?> -->
											</span>
										</a>
									</li>
									<?php
									// }
									?>
									<li><a href="user_detail.php"><i class="fa fa-user" aria-hidden="true"></i></a>
										<div style='margin-left:0px;'>


										</div>
									</li>


								</ul>
								<a href="user_detail.php">
									<div style='margin-left:-14px;margin-right:5px; color:black;'>
										<?php
										if (isset($_SESSION['name'])) {
											echo $_SESSION["name"];
										} ?>
									</div>
								</a>

								<!-- logout -->
								<?php
								if (isset($_SESSION['user_id'])) {
									?>

									<a href="code.php?logoutid=<?php echo $_SESSION['user_id']; ?>"
										class='btn btn-danger'>Log Out</a>
									<!-- <script>
									window.location.href='index.php'
								</script> -->
									<?php

								} else {
									?>
									<a href="login.php" class='btn btn-success'>Log In</a>

									<?php
								}
								?>

								<div class="hamburger_container">
									<i class="fa fa-bars" aria-hidden="true"></i>
								</div>
							</nav>
						</div>
					</div>
				</div>
			</div>

		</header>