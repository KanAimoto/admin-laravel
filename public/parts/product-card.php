<?php
/*===========================================
Файл отображения карточки товаров
===========================================*/
?>

	<div class="product-container">
		<figure>
			<div class="product-wrap">
				<div class="product-images">
					<div class="shop-loop-thumbnail">
						<a href="../shop-detail.php?id=<?php echo $rowProduct["id"]; ?>&subcategory_id=<?php echo $rowProduct["subcategory_id"]; ?>">
							<img width="500" height="400" src="<?php echo $rowProduct["image"]; ?>" alt="product-1"/>
						</a>
					</div>
				</div>
			</div>
			<figcaption>
				<div class="shop-loop-product-info">
					<div class="info-title">
						<h3 class="product_title">
							<a href="#"><?php echo $rowProduct["author"]; ?></a>
						</h3>
					</div>
					<div class="info-title">
						<h3 class="product_title max-lines">
							<a href="../shop-detail.php?id=<?php echo $rowProduct["id"]; ?>&subcategory_id=<?php echo $rowProduct["subcategory_id"]; ?>"><?php echo $rowProduct["title"]; ?></a>
						</h3>
					</div>
					<div class="info-rating">
						<div class="star-rating">
							<span style="width:0%"></span>
						</div>
					</div>
					<div class="info-meta">
						<div class="info-price">
							<span class="price">
								<?php 
								if ($rowProduct["discounted_price"]==0) {
									?>
									<span class="amount"><?php echo $rowProduct["price"]; ?> грн</span>
									<?php
								} else {
									?>
									<del><span class="amount"><?php echo $rowProduct["price"]; ?></span></del> 
									<span class="amount"><?php echo $rowProduct["discounted_price"]; ?> грн</span>
									<?php
								}
								?>	
							</span>
						</div>
					</div>
					<?php
						if ($rowProduct["quantity"]!=0) {
					?>
					<div class="shop-loop-actions">
						<a class="shop-loop-quickview" href="#"></a>
						<button class="btn btn-primary btn-align-left" onclick="addToOrders(this)" data-id="<?php echo $rowProduct["id"];?>">
                            <span>В корзину</span>
                        </button>
						<div class="yith-wcwl-add-to-wishlist">
							<a href="#" class="add_to_wishlist"></a>
						</div>
						<div class="clear"></div>
					</div>
					<?php
						} else {
							echo "<p>Нет в наличии</p>";
						}

					?>
				</div>
			</figcaption>
		</figure>
	</div>
