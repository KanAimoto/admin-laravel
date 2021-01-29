<div class="paginate">
	<nav>
		<ul class="paginate_links">
			<?php
			if (isset($_GET["ch_val"])) {
				// Устанавливаем условие кликабельности кнопки "Предидущая страница"
				if ($page_number_now > 1) {
					?>
					<li>
						<a href="shop-category.php?page=<?php echo $page_number_now - 1; ?>&ch_val=<?php echo $_GET["ch_val"]?>&category_id=<?php echo $_GET['category_id']?>" style="user-select: none;" class="page-numbers" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span>
						</a>
					</li>
					<?php
				} else {
					?>
					<li>
						<a href="#" style="user-select: none; pointer-events: none; cursor: default; color: #999;" class="page-numbers" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span>
						</a>
					</li>
					<?php
				}
				// Если не указан $_GET['page'], то
				if (!isset($_GET['page'])) {
					?>
					<!-- отображаем активной первую страницу, и -->
					<li>
						<a href="shop-category.php?page=1&ch_val=<?php echo $_GET["ch_val"]?>&category_id=<?php echo $_GET['category_id']?>" style="user-select: none;" class="page-numbers current">1</a>
					</li>
					<?php
					// устанавливаем цыкл, который отобразит необходимое количество страниц, начиная со 2
					for ($page_number=2; $page_number <= $number_of_pages; $page_number++) {
						?>
						<li>
							<a href="shop-category.php?page=<?php echo $page_number; ?>&ch_val=<?php echo $_GET["ch_val"]?>&category_id=<?php echo $_GET['category_id']?>" style="user-select: none;" class="page-numbers"><?php echo $page_number; ?></a>
						</li>
						<?php
					}
				// Если указан $_GET['page'], то
				} else {
					// устанавливаем цыкл, который отобразит необходимое количество страниц
					for ($page_number=1; $page_number <= $number_of_pages; $page_number++) {
						?>
						<!-- Задаем в 'class' условия становления страницы активной -->
						<li>
							<a href="shop-category.php?page=<?php echo $page_number; ?>&ch_val=<?php echo $_GET["ch_val"]?>&category_id=<?php echo $_GET['category_id']?>" style="user-select: none;" class="page-numbers <?php if ($page_number == $_GET['page']) { echo 'current'; }?>"><?php echo $page_number; ?></a>
						</li>
						<?php
					}
				}
				if ($page_number_now < $number_of_pages) {
					?>
					<li>
						<a href="shop-category.php?page=<?php echo $page_number_now + 1; ?>&ch_val=<?php echo $_GET["ch_val"]?>&category_id=<?php echo $_GET['category_id']?>" style="user-select: none;" class="page-numbers" aria-label="Previous">
							<span aria-hidden="true">&raquo;</span>
						</a>
					</li>
					<?php
				} else {
					?>
					<li>
						<a href="#" style="user-select: none; pointer-events: none; cursor: default; color: #999;" class="page-numbers" aria-label="Previous">
							<span aria-hidden="true">&raquo;</span>
						</a>
					</li>
					<?php
				}
			} else {
				// Устанавливаем условие кликабельности кнопки "Предидущая страница"
				if ($page_number_now > 1) {
					?>
					<li>
						<a href="shop-category.php?page=<?php echo $page_number_now - 1; ?>&category_id=<?php echo $_GET['category_id']?>" style="user-select: none;" class="page-numbers" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span>
						</a>
					</li>
					<?php
				} else {
					?>
					<li>
						<a href="#" style="user-select: none; pointer-events: none; cursor: default; color: #999;" class="page-numbers" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span>
						</a>
					</li>
					<?php
				}
				// Если не указан $_GET['page'], то
				if (!isset($_GET['page'])) {
					?>
					<!-- отображаем активной первую страницу, и -->
					<li>
						<a href="shop-category.php?page=1&category_id=<?php echo $_GET['category_id']?>" style="user-select: none;" class="page-numbers current">1</a>
					</li>
					<?php
					// устанавливаем цыкл, который отобразит необходимое количество страниц, начиная со 2
					for ($page_number=2; $page_number <= $number_of_pages; $page_number++) {
						?>
						<li>
							<a href="shop-category.php?page=<?php echo $page_number; ?>&category_id=<?php echo $_GET['category_id']?>" style="user-select: none;" class="page-numbers"><?php echo $page_number; ?></a>
						</li>
						<?php
					}
				// Если указан $_GET['page'], то
				} else {
					// устанавливаем цыкл, который отобразит необходимое количество страниц
					for ($page_number=1; $page_number <= $number_of_pages; $page_number++) {
						?>
						<!-- Задаем в 'class' условия становления страницы активной -->
						<li>
							<a href="shop-category.php?page=<?php echo $page_number; ?>&category_id=<?php echo $_GET['category_id']?>" style="user-select: none;" class="page-numbers <?php if ($page_number == $_GET['page']) { echo 'current'; }?>"><?php echo $page_number; ?></a>
						</li>
						<?php
					}
				}

				if ($page_number_now < $number_of_pages) {
					?>
					<li>
						<a href="shop-category.php?page=<?php echo $page_number_now + 1; ?>&category_id=<?php echo $_GET['category_id']?>" style="user-select: none;" class="page-numbers" aria-label="Previous">
							<span aria-hidden="true">&raquo;</span>
						</a>
					</li>
					<?php
				} else {
					?>
					<li>
						<a href="#" style="user-select: none; pointer-events: none; cursor: default; color: #999;" class="page-numbers" aria-label="Previous">
							<span aria-hidden="true">&raquo;</span>
						</a>
					</li>
					<?php
				}
			}	
			?>
		</ul>
	</nav>
</div>