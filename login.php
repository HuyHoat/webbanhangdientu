<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>

<?php
	$login_check = Session::get('customer_login');
	if($login_check){
		header('Location:order.php');
	}
?>

<?php

 	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){

     	$insertCustomers = $cs->insert_customers($_POST);
   }
?>

<?php

   if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){

      $login_Customers = $cs->login_customers($_POST);
   }
?>

<div class="main">
   <div class="content">

    	<!-- Dang nhap -->
    	<div class="login_panel">
        	<h3>Khách hàng hiện tại</h3>
        	<p>Đăng nhập bằng mẫu dưới đây.</p>
        	<?php
    			if(isset($login_Customers)){
    				echo $login_Customers;
    			}
    		?>
        	<form action="" method="POST">
          	<input type="text" name="email" class="field" placeholder="Nhập tài khoản hoặc email... " >
            <input type="password" name="password" class="field" placeholder="Nhập mật khẩu... " >
 
           	<p class="note">Nếu bạn quên mật khẩu, chỉ cần nhập email của bạn và nhấp vào <a href="#">đây</a></p>
            <div class="buttons"><div><input type="submit" name="login" class="grey" value="Đăng nhập"></div></div>
         </form>
      </div>
      <?php?>


      <!-- Dang ky -->
    	<div class="register_account">
    		<h3>Đăng ký tài khoản mới</h3>
    		<?php
    			if(isset($insertCustomers)){
    				echo $insertCustomers;
    			}
    		?>
    		<form action="" method="POST">
   			<table>
   				<tbody>
					<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Nhập tên ...">
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="Nhập tỉnh/thành phố ...">
							</div>
							
							<div>
								<input type="text" name="zipcode" placeholder="Nhập mã ...">
							</div>
							<div>
								<input type="text" name="email" placeholder="Nhập email ...">
							</div>
		    			</td>

		    			<td>
							<div>
								<input type="text" name="address" placeholder="Nhập địa chỉ ...">
							</div>
				    		<div>
								<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
									<option value="null">Quốc tịch</option>

									<option value="VietNam">Việt Nam</option>
									<option value="China">Trung Quốc</option>
									<option value="Korea">Hàn Quốc</option>
									<option value="Japan">Nhật Bản</option>

				         	</select>
						 	</div>		        

				         <div>
				          	<input type="text" name="phone" placeholder="Nhập SĐT ...">
				         </div>
						  	<div>
								<input type="text" name="password" placeholder="Nhập mật khẩu ...">
							</div>
		    			</td>
	    			</tr> 
	    			</tbody>
	 			</table> 
			   <div class="search"><div><input type="submit" name="submit" class="grey" value="Tạo tài khoản"></div></div>
			   <p class="terms">Bằng cách nhấp vào 'Tạo tài khoản', bạn đồng ý với <a href="#">Điều khoản &amp; Điều kiện</a>.</p>
			   <div class="clear"></div>
		   </form>
    	</div>  	
       	<div class="clear"></div>
   </div>
</div>
<?php
	include 'inc/footer.php';
?>