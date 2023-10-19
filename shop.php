<?php 
include("header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .box{
            margin-top: 100px;
            display: ;
        }
    </style>
</head>
<body>
<div class="box">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
				
	</div>

	<!-- New Arrivals -->

	<div class="new_arrivals">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_title new_arrivals_title">
						<h2>New Arrivals</h2>
					</div>
				</div>
			</div>
			<div class="row align-items-center">
				<div class="col text-center">
					<div class="new_arrivals_sorting">
						<ul class="arrivals_grid_sorting clearfix button-group filters-button-group">
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center active is-checked" data-filter="*">all</li>
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".women">women's</li>
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".accessories">accessories</li>
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".men">men's</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>

						<!-- Product 1 -->
						<?php
							$res=$admin_obj->viewproduct();
							if(mysqli_num_rows($res)>0){
								while($p1=mysqli_fetch_assoc($res)){
                                    
                        ?>

						<div class="product-item men">
							<div class="product discount product_filter">
								<div class="product_image">
                                    
									<a href="product_details.php?id=<?php echo $p1['code'];?>">
										<img src="admin/<?php echo $p1['pic'];?>" alt="<?php echo $p1['title'];?>" class='' style="width:80%; height:80%; aspect-ratio: 1:1;">
									</a>
								</div>
								<div class="favorite favorite_left"></div>
								<div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><span>-20%</span></div>
								<a href="product_details.php?id=<?php echo $p1['code'];?>">
									<div class="product_info">
										<h6 class="product_name"><?php echo $p1['title'];?></h6>
										<div class="product_price">₹<?php  echo $p1['original_price'];?><span>₹<?php echo $p1['original_price'];?> </span></div>
									</div>
								</a>
							</div>
							<div >
								
									<form id="addtocart<?php echo $p1['code'];?>">
									<input type="hidden" name="userid" value="<?php if(isset($_SESSION['user_id'])){ echo $_SESSION['user_id']; } ?>">	
									<input type="hidden" name="pid" value="<?php echo $p1['code'];?>">
									<input type="hidden" name="qty" value=1>
									<input type="hidden" name='addcart' value="addcart"> 

									<button type='submit' style='border:none;'class="red_button add_to_cart_button">Add to Cart</button>


									</form>
									<script src="js/jquery-3.2.1.min.js"></script>
									<script>
										$(function(){
											$("#addtocart<?php echo $p1['code'];?>").submit(function(e){
												// e.preventDefault();
												alert('Added')
												$.ajax({
													url: "code.php",
													type: "POST",
													data: new FormData(this),
													contentType: false,
													processData: false,
													success: function(res){
														
													}
												})
											})
											
										})
									</script>
								
							</div>
						</div>

						<?php
								}
							}
						?>

					

						<!-- Product 3 -->

			

							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
