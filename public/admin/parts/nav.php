<!-- Навигация по админскому сайту -->

<ul class="nav">
	<li class="nav-item <?php if($page_admin == "orders") { echo 'active'; } ?>">
		<a class="nav-link" href="/admin/orders.php">
			<i class="nc-icon nc-bag"></i>
			<p>Заказы</p>
		</a>
	</li>
	<li class="nav-item nav-add-products <?php if($page_admin == "products") { echo 'active'; } ?>">
		<a class="nav-link" href="/admin/products.php">
			<i class="nc-icon nc-app"></i>
			<p>Товары</p>
		</a>
		<a class="nav-link add_products" href="/admin/modules/products/add_products.php">
			<div class="nav-item add-product">&#10010;</div>
		</a>
	</li>
	<li class="nav-item <?php if($page_admin == "categories") { echo 'active'; } ?>">
		<a class="nav-link" href="/admin/category.php">
			<i class="nc-icon nc-bullet-list-67"></i>
			<p>Категории</p>
		</a>
	</li>
	<li class="nav-item <?php if($page_admin == "log_out") { echo 'active'; } ?>">
		<a class="nav-link" href="#">
			<i class="nc-icon nc-button-power"></i>
			<p>Log out</p>
		</a>
	</li>
</ul>