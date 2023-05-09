<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php
	if(isset($_GET['cartid'])){

        $cartid = $_GET['cartid'];
        $delcart = $ct->del_product_cart($cartid);
   }

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){

		$cartId = $_POST['cartId'];
    	$quantity = $_POST['quantity'];
      $upadte_quantity_cart = $ct->upadte_quantity_cart($quantity,$cartId);

      if($quantity<=0){
      	$delcart = $ct->del_product_cart($cartId);
      }
   }
?>
<?php
	if(!isset($_GET['id'])){
		echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
	}
?>
<div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>GIỎ HÀNG</h2>

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
								<th width="20%">Tên sản phẩm</th>
								<th width="10%">Hình ảnh</th>
								<th width="15%">Giá</th>
								<th width="25%">Số lượng</th>
								<th width="20%">Tổng giá</th>
								<th width="10%">Hành động</th>
							</tr>

							<?php
								$get_product_cart = $ct->get_product_cart();
								if($get_product_cart){
									$subtotal = 0;
									while($result = $get_product_cart->fetch_assoc()){	
							?>
							<tr>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
								<td><?php echo $fm->format_currency($result['price']).' '.'VND' ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>"/>
										<input type="number" name="quantity" min="0" value="<?php echo $result['quantity'] ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<!-- tổng giá -->
								<td>
									<?php
										$total = $result['price'] * $result['quantity'];
										echo $fm->format_currency($total).' '.'VND';
									?>
								</td>
								<td>
									<a onclick="return confirm('Bạn có muốn xóa không?');" href="?cartid=<?php echo $result['cartId'] ?>">Xóa</a>
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
						<table style="float:right;text-align:left;" width="40%">
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
								<td>2%</td>
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

					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php
	include 'inc/footer.php';
?>