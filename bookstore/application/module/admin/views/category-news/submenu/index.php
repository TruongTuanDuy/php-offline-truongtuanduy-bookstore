<?php
$linkCategoryNews 	= URL::createLink('admin', 'categorynews', 'index');
$linkNews 	= URL::createLink('admin', 'news', 'index');
$linkRss 	= URL::createLink('admin', 'rss', 'index');
?>
<div id="submenu-box">
	<div class="m">
		<ul id="submenu">
			<li><a href="#" class="active">Category</a></li>
			<li><a href="<?php echo $linkNews ?>">News</a></li>
			<li><a href="<?php echo $linkRss ?>">RSS</a></li>
		</ul>
		<div class="clr"></div>
	</div>
</div>