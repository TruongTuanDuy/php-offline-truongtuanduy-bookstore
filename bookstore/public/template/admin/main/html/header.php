<?php
$linkControlPanel	= URL::createLink('admin', 'index', 'index');
$linkMyProfile		= URL::createLink('admin', 'index', 'profile');
$linkUserManager	= URL::createLink('admin', 'user', 'index');
$linkAddUser		= URL::createLink('admin', 'user', 'form');
$linkGroupManager	= URL::createLink('admin', 'group', 'index');
$linkAddGroup		= URL::createLink('admin', 'group', 'form');
$linkCategoryManager = URL::createLink('admin', 'category', 'index');
$linkAddCategory	= URL::createLink('admin', 'category', 'form');
$linkBookManager	= URL::createLink('admin', 'book', 'index');
$linkAddBook		= URL::createLink('admin', 'book', 'form');
$linkCouponManager	= URL::createLink('admin', 'coupon', 'index');
$linkAddCoupon		= URL::createLink('admin', 'coupon', 'form');

$linkCategoryNewsManager	= URL::createLink('admin', 'categorynews', 'index');
$linkAddCategoryNews		= URL::createLink('admin', 'categorynews', 'form');

$linkNewsManager	= URL::createLink('admin', 'news', 'index');
$linkAddNews		= URL::createLink('admin', 'news', 'form');

$linkRssManager	= URL::createLink('admin', 'rss', 'index');
$linkAddRss		= URL::createLink('admin', 'rss', 'form');

$linkLogout			= URL::createLink('admin', 'index', 'logout');
$linkViewSite		= URL::createLink('default', 'index', 'index');
?>
<div id="border-top" class="h_blue">
	<span class="title"><a href="#">Administration</a></span>
</div>

<!-- HEADER -->
<div id="header-box">
	<div id="module-status">
		<span class="viewsite"><a href="<?php echo $linkViewSite; ?>" target="_blank">View Site</a></span>
		<span class="no-unread-messages"><a href="<?php echo $linkLogout; ?>">Log out</a></span>
	</div>
	<div id="module-menu">
		<!-- MENU -->
		<ul id="menu">
			<li class="node"><a href="#">Site</a>
				<ul>
					<li><a class="icon-16-cpanel" href="<?php echo $linkControlPanel; ?>">Control Panel</a></li>
					<li class="separator"><span></span></li>
					<li><a class="icon-16-profile" href="<?php echo $linkMyProfile; ?>">My Profile</a></li>
				</ul>
			</li>
			<li class="separator"><span></span></li>

			<li class="node"><a href="#">Users</a>
				<ul>
					<li class="node">
						<a class="icon-16-user" href="<?php echo $linkUserManager; ?>">User Manager</a>
						<ul id="menu-com-users-users" class="menu-component">
							<li><a class="icon-16-newarticle" href="<?php echo $linkAddUser; ?>">Add New User</a></li>
						</ul>
					</li>
					<li class="node">
						<a class="icon-16-groups" href="<?php echo $linkGroupManager; ?>">Group Manager</a>
						<ul id="menu-com-users-groups" class="menu-component">
							<li><a class="icon-16-newarticle" href="<?php echo $linkAddGroup; ?>">Add New Group</a></li>
						</ul>
					</li>
				</ul>
			</li>

			<li class="node"><a href="#">Book Shopping</a>
				<ul>
					<li class="node">
						<a class="icon-16-category" href="<?php echo $linkCategoryManager; ?>">Category Manager</a>
						<ul id="menu-com-users-users" class="menu-component">
							<li><a class="icon-16-newarticle" href="<?php echo $linkAddCategory; ?>">Add New Category</a></li>
						</ul>
					</li>
					<li class="node">
						<a class="icon-16-article" href="<?php echo $linkBookManager; ?>">Book Manager</a>
						<ul id="menu-com-users-groups" class="menu-component">
							<li><a class="icon-16-newarticle" href="<?php echo $linkAddBook; ?>">Add New Book</a></li>
						</ul>
					</li>
					<li class="node">
						<a class="icon-16-article" href="<?php echo $linkCouponManager; ?>">Coupon Manager</a>
						<ul id="menu-com-users-groups" class="menu-component">
							<li><a class="icon-16-newarticle" href="<?php echo $linkAddCoupon; ?>">Add New Coupon</a></li>
						</ul>
					</li>
				</ul>
			</li>

			<li class="node"><a href="#">News</a>
				<ul>
					<li class="node">
						<a class="icon-16-category" href="<?php echo $linkCategoryNewsManager; ?>">Category News Manager</a>
						<ul id="menu-com-users-users" class="menu-component">
							<li><a class="icon-16-newarticle" href="<?php echo $linkAddCategoryNews; ?>">Add Category News</a></li>
						</ul>
					</li>
					<li class="node">
						<a class="icon-16-article" href="<?php echo $linkNewsManager; ?>">News Manager</a>
						<ul id="menu-com-users-groups" class="menu-component">
							<li><a class="icon-16-newarticle" href="<?php echo $linkAddNews; ?>">Add News</a></li>
						</ul>
					</li>
					<li class="node">
						<a class="icon-16-article" href="<?php echo $linkRssManager; ?>">RSS Manager</a>
						<ul id="menu-com-users-groups" class="menu-component">
							<li><a class="icon-16-newarticle" href="<?php echo $linkAddRss; ?>">Add RSS</a></li>
						</ul>
					</li>
				</ul>
			</li>

		</ul>
	</div>

	<div class="clr"></div>
</div>