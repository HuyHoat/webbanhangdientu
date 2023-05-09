<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>

<?php
	if(isset($_GET['orderid']) && $_GET['orderid'] == 'order'){
        
        $customer_id = Session::get('customer_id');
        $insertOrder = $ct->insertOrder($customer_id);
        $delCart = $ct->del_all_data_cart();

        header('Location:success.php');
    }

?>

<style>
	h2.success_order{
		text-align: center;
		color: green;
	}

	.success_note{
		text-align: center;
		padding: 10px;
		font-size: 18px;
	}
</style>

<form action="" method="POST">
	<div class="main">
	    <div class="content">
	    	<div class="section group">

	    		<h2 class="success_order">Đặt hàng thành công</h2>

	    		<?php
	    			$customer_id = Session::get('customer_id');
	    			$get_amount = $ct->getAmountPrice($customer_id);
	    			if($get_amount){
	    				$amount = 0;
	    				while($result = $get_amount->fetch_assoc()){
	    					$price = $result['price'];
	    					$amount += $price;
	    				}
	    			}
	    		?>
	    		<p class="success_note">
	    			Tổng tiền bạn đã mua từ cửa hàng: 
	    			<?php
	    			$vat = $amount * 0.02; 
	    			$total = $vat + $amount; 
	    			echo $fm->format_currency($total).' '.'VND'; 
	    			?>
	    		</p>
	    		<p class="success_note">
	    			Chúng tôi sẽ liên hệ với bạn sớm nhất. Hãy để ý điện thoại.<br><br> 
	    			<a style="color: red; text-decoration:underline;" href="orderdetails.php">Bấm vào đây để xe, chi tiết đơn hàng</a>
	    		</p>

			</div>
	 	</div>

	</div>
</form>
<?php
	include 'inc/footer.php';
?>
