
		<nav id="sidebar" class="sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.php">
					<span class="align-middle">PSOMS Vendor</span>
				</a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Reports
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="index.php">
							<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-blank.php">
							<i class="align-middle" data-feather="book"></i> <span class="align-middle">Reports</span>
						</a>
					</li>

					<li class="sidebar-header">
						Manage
					</li>

          <li class="sidebar-item">
            <a href="#forms" data-toggle="collapse" class="sidebar-link collapsed">
              <i class="align-middle" data-feather="users"></i> <span class="align-middle">Product Categories</span>
            </a>
            <ul id="forms" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
							<?php if($category->rowCount() > 0): ?>
								<?php while($cate=$category->fetch(PDO::FETCH_ASSOC)): ?>
									<li class="sidebar-item"><a class="sidebar-link" href="./index.php?category_id=<?= $cate['catid']; ?>"><?= $cate['name']; ?></a></li>
								<?php endwhile ?>
							<?php else: ?>
									<li class="sidebar-item"><a class="sidebar-link" href="./">No Category Found</a></li>
							<?php endif ?>
            </ul>
          </li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-settings.php">
							<i class="align-middle" data-feather="settings"></i> <span class="align-middle">Settings</span>
						</a>
					</li>
				</ul>

			</div>
		</nav>