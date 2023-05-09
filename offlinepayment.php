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
	.box_left{
		width: 55%;
		border: 1px solid #666;
		float: left;
		padding: 3px;
	}	

	.box_right{
		width: 42%;
		border: 1px solid #666;
		float: right;
		padding: 4px;
	}

	a.a_order{
		padding: 10px 70px;
		border: none;
		background: red;
		font-size: 30px;
		color: #fff;
		border-radius: 5px;
		margin: 10px;
		cursor: pointer;
	}
</style>

<form action="" method="POST">
	<div class="main">
	    <div class="content">
	    	<div class="section group">
	    		<div class="heading">
		    		<h3>THANH TOÁN NGOẠI TUYẾN</h3>
		    	</div>
		    		
		    	<div class="clear"></div>
		    	<div class="box_left">
		    		<div class="cartpage">

				    	<?php
				    		if(isset($upadte_quantity_cart)){
				    			echo $upadte_quantity_cart;
				    		}
				    	?>
				    	<?php
				    		if(isset($delcart)){
				    			echo $delcart;
				    		}
				    	?>
							<table class="tblone">
								<tr>
									<th width="5%">ID</th>
									<th width="25%">Tên sản phẩm</th>
									<th width="25%">Giá</th>
									<th width="10%">Số lượng</th>
									<th width="25%">Tổng giá</th>
								</tr>

								<?php
									$get_product_cart = $ct->get_product_cart();
									if($get_product_cart){
										$subtotal = 0;
										$i = 0;
										while($result = $get_product_cart->fetch_assoc()){
											$i++;	
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $result['productName'] ?></td>
									<td><?php echo $fm->format_currency($result['price']).' '.'VND' ?></td>
									<td>	
										<?php echo $result['quantity'] ?>
									</td>
									<!-- tổng giá -->
									<td>
										<?php
											$total = $result['price'] * $result['quantity'];
											echo $fm->format_currency($total).' '.'VND';
										?>
									</td>
								</tr>
								<?php
										$subtotal += $total;

										}
									}
								?>
								
							</table>

							<?php
								$check_cart = $ct->check_cart();
									if($check_cart){
									
							?>
							<table style="text-align:left;margin-left: 270px;" width="50%">
								<tr>
									<th>Tổng tiền hàng : </th>
									<td>
										<?php	
											echo $fm->format_currency($subtotal).' '.'VND';
											Session::set('sum',$subtotal);
										?>
									</td>
								</tr>
								<tr>
									<th>Giảm giá : </th>
									<td>2% (<?php echo $vat = $subtotal * 0.02; ?>)</td>
								</tr>
								<tr>
									<th>Tổng tiền phải trả :</th>
									<td>
										<?php
											$vat = $subtotal * 0.02;
											$gtotal = $subtotal - $vat;
											echo $fm->format_currency($gtotal).' '.'VND';
										?>
									</td>
								</tr>
						   </table>
						   <?php
						   	}else{
						   		echo 'Giỏ hàng của bạn trống!';
						   	}
						   ?>
						</div>
		    	</div>
		    	<div class="box_right">
		    		<table class="tblone">
	    			<?php
	    				$id = Session::get('customer_id');
	    				$get_customers = $cs->show_customers($id);
	    				if($get_customers){
	    					while($result = $get_customers->fetch_assoc()){
	    				
	    			?>
	    			<tr>
	    				<td>Tên</td>
	    				<td>:</td>
	    				<td><?php echo $result['name']?></td>
	    			</tr>
	    			<!-- <tr>
	    				<td>Tỉnh/Thành phố</td>
	    				<td>:</td>
	    				<td><?php echo $result['city']?></td>
	    			</tr> -->
	    			<tr>
	    				<td>Số điện thoại</td>
	    				<td>:</td>
	    				<td><?php echo $result['phone']?></td>
	    			</tr>
	    			<!-- <tr>
	    				<td>Quốc tịch</td>
	    				<td>:</td>
	    				<td><?php echo $result['country']?></td>
	    			</tr> -->
	    			<tr>
	    				<td>Mã</td>
	    				<td>:</td>
	    				<td><?php echo $result['zipcode']?></td>
	    			</tr>
	    			<tr>
	    				<td>email</td>
	    				<td>:</td>
	    				<td><?php echo $result['email']?></td>
	    			</tr>
	    			<tr>
	    				<td>Địa chỉ</td>
	    				<td>:</td>
	    				<td><?php echo $result['address']?></td>
	    			</tr>
	    			<tr>
	    				<td colspan="3"><a href="editprofile.php">Cập nhật hồ sơ</a></td>
	    			</tr>
	    			<?php
	    					}
	    				}
	    			?>

	    		</table>
		    	</div>
			</div>
	 	</div>

	 	<center><a href="?orderid=order" class="a_order">Đặt hàng</a></center><br>

	</div>
</form>
<?php
	include 'inc/footer.php';
?>
