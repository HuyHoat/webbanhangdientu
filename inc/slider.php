	<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">

				<?php
					$getLastesDell = $product->getLastesDell();
					if($getLastesDell){
						while($resultdell = $getLastesDell->fetch_assoc()){
					
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $resultdell['productId'] ?>">
						 	<img src="admin/uploads/<?php echo $resultdell['image'] ?>" alt="" />
						 </a>
					</div>
				    <div class="text list_2_of_1">
						<h2>DELL</h2>
						<p><?php echo $resultdell['productName'] ?></p>
						<div class="button">
							<span><a href="details.php?proid=<?php echo $resultdell['productId'] ?>">Add to cart</a></span>
						</div>
				   </div>
			   </div>
			   	<?php
			   			}
			   		}
			   	?>

			   	<?php
					$getLastesSS = $product->getLastesSamsung();
					if($getLastesSS){
						while($resultss = $getLastesSS->fetch_assoc()){
					
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php?proid=<?php echo $resultdell['productId'] ?>">
						  	<img src="admin/uploads/<?php echo $resultss['image'] ?>" alt="" />
						  </a>
					</div>
					<div class="text list_2_of_1">
					  	<h2>SAMSUNG</h2>
					  	<p><?php echo $resultss['productName'] ?></p>
					  	<div class="button">
							<span><a href="details.php?proid=<?php echo $resultdess['productId'] ?>">Add to cart</a></span>
						</div>
					</div>
				</div>
				<?php
			   			}
			   		}
			   	?>
			</div>

			<div class="section group">

				<?php
					$getLastesApple = $product->getLastesApple();
					if($getLastesApple){
						while($resultapple = $getLastesApple->fetch_assoc()){
					
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						<a href="details.php?proid=<?php echo $resultdell['productId'] ?>"> 
							<img src="admin/uploads/<?php echo $resultapple['image'] ?>" alt="" />
						</a>
					</div>
				    <div class="text list_2_of_1">
						<h2>APPLE</h2>
						<p><?php echo $resultapple['productName'] ?></p>
						<div class="button">
							<span><a href="details.php?proid=<?php echo $resultdapple['productId'] ?>">Add to cart</a></span>
						</div>
				   </div>
			   </div>
			   <?php
			   			}
			   		}
			   	?>

			   	<?php
					$getLastesOppo = $product->getLastesOppo();
					if($getLastesOppo){
						while($resultoppo = $getLastesOppo->fetch_assoc()){
					
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php?proid=<?php echo $resultdell['productId'] ?>">
						  	<img src="admin/uploads/<?php echo $resultoppo['image'] ?>" alt="" />
						  </a>
					</div>
					<div class="text list_2_of_1">
						  <h2>OPPO</h2>
						  <p><?php echo $resultoppo['productName'] ?></p>
						  <div class="button">
							<span><a href="details.php?proid=<?php echo $resultoppo['productId'] ?>">Add to cart</a></span>
						</div>
					</div>
				</div>
				<?php
			   			}
			   		}
			   	?>
			</div>

		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/slider1.png" alt=""/></li>
						<li><img src="images/slider2.png" alt=""/></li>
						<li><img src="images/slider3.png" alt=""/></li>
						<li><img src="images/slider4.png" alt=""/></li>
						<li><img src="images/slider5.png" alt=""/></li>
						<li><img src="images/slider6.png" alt=""/></li>
						<li><img src="images/slider7.png" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>	