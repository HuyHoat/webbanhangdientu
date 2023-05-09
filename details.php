<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>

<?php
	if(!isset($_GET['proid']) || $_GET['proid'] == NULL){
        echo "<script>window.location ='404.php'</script>";
    }else{
        $id = $_GET['proid'];
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){

    	$quantity = $_POST['quantity'];
      	$AddtoCart = $ct->add_to_cart($quantity,$id);
    }
?>
 <div class="main">
    <div class="content">
    	<div class="section group">

    		<?php
    			$get_product_details = $product->get_details($id);
    			if($get_product_details){
    				while($result_details = $get_product_details->fetch_assoc()){
    		?>

				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="admin/uploads/<?php echo $result_details['image'] ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result_details['productName'] ?></h2>
					<p><?php echo $result_details['product_desc'] ?></p>					
					<div class="price">
						<p>Price: <span><?php echo $fm->format_currency($result_details['price'])." "."VND" ?></span></p>
						<p>Category: <span><?php echo $result_details['catName'] ?></span></p>
						<p>Brand:<span><?php echo $result_details['brandName'] ?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1" min="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Mua Ngay"/>
					</form>
					<?php
						if(isset($AddtoCart)){
							echo '<span style="color:red;font-sze:18px">Sản phẩm đã có trong giỏ hàng rồi</span>';
						}
					?>				
				</div>
			</div>

			<style>
				.product-desc p{
					text-indent: 20px;
				}
			</style>
			<div class="product-desc">
			<h2>CHÍNH SÁCH BẢO HÀNH, ĐỔI TRẢ</h2>

			<br>Bảo hành có cam kết trong 12 tháng (chỉ áp dụng cho sản phẩm chính, KHÔNG áp dụng cho phụ kiện kèm theo)<br>
			<p>Bảo hành trong vòng 15 ngày (từ lúc Khách hàng mang sản phẩm đến bảo hành đến lúc nhận lại sản phẩm tối đa 15 ngày).
			Sản phẩm không bảo hành lại lần 2 trong 30 ngày kể từ ngày máy được bảo hành xong.<br>
			Nếu TGDD/ĐMX vi phạm cam kết (bảo hành quá 15 ngày hoặc phải bảo hành lại sản phẩm lần nữa trong 30 ngày kể từ lần bảo hành trước), Khách hàng được áp dụng phương thức Hư gì đổi nấy ngay và luôn hoặc Hoàn tiền với mức phí giảm 50%.
			Từ tháng thứ 13 trở đi, không áp dụng bảo hành có cam kết, chỉ áp dụng bảo hành hãng nếu có.</p><br>
			
			Hư gì đổi nấy ngay & luôn.<br>
			<p>Hư sản phẩm chính: Đổi sản phẩm mới (cùng model, cùng dung lượng, cùng màu sắc) miễn phí tháng đầu tiên, tháng thứ 2 đến tháng 12 chịu phí 10% hoá đơn/tháng. Nếu sản phẩm chính hết hàng thì áp dụng Bảo hành có cam kết hoặc Hoàn tiền với mức phí giảm 50%.<br>
			Hư phụ kiện đi kèm: Đổi miễn phí trong vòng 12 tháng kể từ ngày mua sản phẩm chính bằng hàng phụ kiện TGDĐ/ĐMX đang kinh doanh mới với công năng tương đương. Nếu không có phụ kiện tương đương hoặc Khách hàng không thích thì áp dụng bảo hành hãng.<br>
			Lỗi phần mềm không áp dụng, mà chỉ khắc phục lỗi phần mềm.<br>
			Trường hợp Khách hàng muốn đổi full box (nguyên thùng, nguyên hộp): ngoài việc áp dụng mức phí đổi trả thì Khách hàng sẽ trả thêm phí lấy full box tương đương 20% giá trị hóa đơn.</p><br>
			
			Hoàn tiền
			<p>Tháng đầu tiên kể từ ngày mua: phí 20% giá trị hóa đơn.<br>
			Tháng thứ 2 đến tháng thứ 12: phí 10% giá trị hóa đơn/tháng.</p>
	    </div>			
		</div>
		<?php
				}
    		}
		?>

				<div class="rightsidebar span_3_of_1">
					<h2>THỂ LOẠI</h2>
					<ul>
						<?php
							$getall_category = $cat->show_category_fontend();
							if($getall_category){
								while($result_allcat = $getall_category->fetch_assoc()){


						?>
				      		<li><a href="productbycat.php?catid=<?php echo $result_allcat['catId'] ?>"><?php echo $result_allcat['catName'] ?></a></li>
				      	<?php
				      			} 
							}
				      	?>

					</ul>

					</div>
 		</div>
 	</div>
<?php
	include 'inc/footer.php';
?>
