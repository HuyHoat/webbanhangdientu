<?php
	include 'inc/header.php';
	include 'inc/slider.php';
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>TẤT CẢ SẢN PHẨM</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
				<?php
	      		$all_product = $product->getproduct_all();
	      		if($all_product){
	      			while($result = $all_product->fetch_assoc()){
	      		
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="details.php?proid=<?php echo $result['productId'] ?>">
						<img src="admin/uploads/<?php echo $result['image'] ?>" alt="" />
					</a>
					<h2><?php echo $result['productName'] ?></h2>
					<p><?php echo $fm->textShorten($result['product_desc'], 110) ?></p>
					<p><span class="price"><?php echo $fm->format_currency($result['price'])." "."VND" ?></span></p>
				   <div class="button">
				     	<span><a href="details.php?proid=<?php echo $result['productId'] ?>" class="details">CHI TIẾT</a></span>
				   </div>
				</div>
				<?php
					}
				}	
				?>
			</div>

    </div>
 </div>
<?php
	include 'inc/footer.php';
?>