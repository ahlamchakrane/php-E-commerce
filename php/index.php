<?php
session_start();
include('database_connection.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>My E-commerce web site</title>
		<script src="js/jquery.min.js"></script>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<script src="js/bootstrap.min.js"></script>
		<style>
		.popover
		{
		    width: 100%;
		    max-width: 800px;
		}
		*{
			font-size: 16px;
		}
		</style>
	</head>
	<body>
		<div class="container">
			<br />
			<br />
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Menu</span>
						<span class="glyphicon glyphicon-menu-hamburger"></span>
						</button>
					</div>
					
					<div id="navbar-cart" class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li>
								<a id="cart-popover" class="btn" data-placement="bottom" title="Shopping Cart">
									<span class="glyphicon glyphicon-shopping-cart"></span>
									<span class="badge" style="color: #fff; background: orange; size: 18px;"></span>
									<span class="product_quantity"></span>
								</a>
								<?php if(isset($_SESSION['user'])){echo '<p><strong>'.$_SESSION['user']['username'] .'|</strong><a href="Logout.php" style="text-decoration:none;"> Logout </a></p>';} ?>
							</li>
						</ul>
					</div>
					
				</div>
			</nav>
			<div id="popover_content_wrapper" style="display: none; ">
				<span id="cart_details"></span>
				<div align="right">
					<a href="Login.php" class="btn btn-primary" id="check_out_cart">
					<span class="glyphicon glyphicon-shopping-cart"></span> Check out
					</a>
					<a href="#" class="btn btn-danger" id="clear_cart">
					<span class="glyphicon glyphicon-trash"></span>Clear
					</a>
				</div>
			</div>

			<div id="display_item">


			</div>
			
		</div>
	</body>
</html>

<script>  
$(document).ready(function(){

	load_product();

	load_cart_data();
    
	function load_product()
	{
		var url= new URLSearchParams(window.location.search)
		var category=url.get('id')
			$.ajax({
			url:"fetch_item.php",
			method:"POST",
			data:{category:category}, //envoyer l'id
			success:function(data)
			{
				$('#display_item').html(data);
			}
		});
	}

	function load_cart_data(status) //on l'appel meme si le popover n'est pas ouvert
	{
		$.ajax({
			url:"fetch_cart.php",
			method:"POST",
			dataType:"json",
			success:function(data)
			{	
				if(status){
					$('.popover #cart_details').html(data.cart_details);
					$('.popover .total_price').text(data.total_price);
					$('.popover .badge').text(data.total_item);
				}

				$('#cart_details').html(data.cart_details);
				$('.total_price').text(data.total_price);
				$('.badge').text(data.total_item);
				
			}
		});
	}

	$('#cart-popover').popover({
		html : true,
        container: 'body',
        content:function(){
        	return $('#popover_content_wrapper').html();
        }
	});

	$(document).on('click', '.add_to_cart', function(){
		var product_id = $(this).attr("id");
		var product_name = $('#name'+product_id+'').val();
		var product_image = $('#image'+product_id+'').val();
		var product_price = $('#price'+product_id+'').val();
		var product_quantity = $('#quantity'+product_id+'').val();
		var action = "add";
		if(product_quantity > 0)
		{
			$.ajax({
				url:"action.php",
				method:"POST",
				data:{product_id:product_id, product_name:product_name, product_image:product_image, product_price:product_price, product_quantity:product_quantity, action:action},
				success:function(data)
				{
					load_cart_data();
					
				}
			});
		}
		
	});

	$(document).on('click', '.delete', function(){
		var product_id = $(this).attr("id");
		var action = 'remove';
	
			$.ajax({
				url:"action.php",
				method:"POST",
				data:{product_id:product_id, action:action},
				success:function(data)
				{

					load_cart_data(true);
					
				}
			})
		
		
	});

	$(document).on('click', '#clear_cart', function(){
		var action = 'empty';
		$.ajax({
			url:"action.php",
			method:"POST",
			data:{action:action},
			success:function(data)
			{

				load_cart_data(true);
				
				
			}
		});
	});
	
	// $('.carte_Quantity').change(function(){  ne fonctionne pas 
	// 	console.log('event');
	// })

	$(document).on('change','.carte_Quantity', function(){
	 	var product_id = $(this).closest('tr').attr('id');
	 	var quantity=$(this).val();
	 	$.ajax({
			url:"action.php",
			method:"POST",
			data:{action:'update',product_id:product_id,quantity:quantity},
			success:function(data)
			{
				load_cart_data(true);
				
				
			}
		});
	})

});


</script>