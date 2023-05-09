<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>

<?php
	$login_check = Session::get('customer_login');
	  	if($login_check == false){
	  		header('Location:login.php');
	  	}

  	$ct = new cart();
  	if(isset($_GET['confirmid'])){
		$id = $_GET['confirmid'];
		$price = $_GET['price'];
		$shifted_confirm = $ct->shifted_confirm($id,$price);
    }
?>

<style>
	.cartpage h2 {
    border-bottom: 1px solid #ddd;
    font-size: 25px;
    margin-bottom: 20px;
    width: 600px;
</style>

<div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">

			    	<h2>THÔNG TIN CHI TIẾT ĐƠN HÀNG CỦA BẠN</h2>

						<table class="tblone">
							<tr>
								<th width="5%">ID</th>
								<th width="20%">Tên sản phẩm</th>
								<th width="10%">Hình ảnh</th>
								<th width="15%">Giá</th>
								<th width="10%">Số lượng</th>
								<th width="10%">Tình trạng</th>
								<th width="15%">Hành động</th>
							</tr>

							<?php

								$customer_id = Session::get('customer_id');
								$get_cart_ordered = $ct->get_cart_ordered($customer_id);

								if($get_cart_ordered){
									$i = 0;									
									while($result = $get_cart_ordered->fetch_assoc()){	
										$i++;
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
								<td><?php echo $fm->format_currency($result['price']).' '.'VND' ?></td>
								<td>
									<?php echo $result['quantity'] ?>
								</td>
								<td>
									<?php
										if($result['status'] == 0){
											echo 'Chưa xử lý';
										}elseif($result['status'] == 1){
									?>
										<span>Đang vận chuyển</span>
										
									<?php
										}elseif($result['status'] == 2){
											echo 'Đã nhận hàng';
										}
									?>
								</td>
								
								<?php
									if($result['status']=='0'){
								?>
									<td><?php echo 'N/A'; ?></td>

								<?php
									}elseif($result['status']==1){
								?>
									<td>
										<a href="?confirmid=<?php echo $customer_id ?>&price=<?php echo $result['price'] ?>">
											Xác nhận nhận hàng
										</a>
									</td>

								<?php
									}else{
								?>
									<td>
										<?php echo 'Đã nhận hàng'; ?>
									</td>

								<?php
									}
								?>		
								
							</tr>
							<?php
									}
								}
							?>
							
						</table>

			</div>

					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       	<div class="clear"></div>
    </div>
</div>
<?php
	include 'inc/footer.php';
?>