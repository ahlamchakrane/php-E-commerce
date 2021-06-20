<?php
session_start();

$total_price = 0;
$total_item = 0;

$output = '
<div class="table-responsive" id="order_table">
	<table class="table table-bordered table-striped">
		<tr>  
            <th width="20%">Product Name</th> 
            <th width="20%">Product Image</th> 
            <th width="10%">Quantity</th>  
            <th width="20%">Price</th>  
            <th width="10%">Total</th>  
            <th width="10%">Action</th>  
        </tr>
';
if(!empty($_SESSION["shopping_cart"]))
{
	foreach($_SESSION["shopping_cart"] as $keys => $values)
	{
		$quantity=$values["product_quantity"];
		$output .= '
		<tr id="'.$values["product_id"].'">
			<td>'.$values["product_name"].'</td>
			<td><img src='.$values["product_image"].'></td>

			<td><input type="number" class="carte_Quantity" value="'.$quantity.'"></td> 
			<td align="right">'.$values["product_price"].' MAD</td>
			<td align="right">'.number_format($values["product_quantity"] * $values["product_price"], 2).' MAD</td>
			<td><button name="delete" class="btn btn-danger delete" id="'.$values["product_id"].'">Remove</button><br>
			</td>
		</tr>
		';
		$total_price = $total_price + ($values["product_quantity"] * $values["product_price"]);
		$_SESSION['total']=$total_price;
		$total_item = $total_item + 1;
	}
	$output .= '
	<tr>  
        <td colspan="3" align="right">Total</td>  
        <td align="right">$ '.number_format($total_price, 2).'</td>  
        <td></td>  
    </tr>
	';
}
else
{
	$output .= '
    <tr>
    	<td colspan="5" align="center">
    		You don\' have any article!
    	</td>
    </tr>
    ';
}
$output .= '</table></div>';
$data = array(
	'cart_details'		=>	$output,
	'total_price'		=>	number_format($total_price, 2).' MAD',
	'total_item'		=>	$total_item
);	

echo json_encode($data);


?>