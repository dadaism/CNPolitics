<div id="header">
	<div id="logo" style="cursor:pointer;" onclick="location.href='<?php bloginfo('siteurl'); ?>';"></div><!--/logo-->
	<div class="shadow"></div>
	<div id="slidecontent">
		<div id="search">
		<form id="search_form" style="display:inline" method="get" action="<?php bloginfo('siteurl'); ?>/">
			<input type="text" name="s" value="搜索" onblur="if (this.value==''){this.value='搜索'}" onfocus="if (this.value=='搜索') {this.value=''}" class="topsearch_input"/>
			<input type="image" class="topsearch_img" src="<?php bloginfo('template_directory'); ?>/images/search.png"/>
		</form>
		</div>
		<div id="nav">
			<div class="grid_5"><a href="#"><b>文章分类</b></a><br><br>
				<?php cnpolitics_list_category(); ?>
			</div>
			<div class="grid_4"><a href="<?php bloginfo('wpurl'); ?>/researcher/"><b>谁在研究中国</b></a><br><br>
				<?php cnpolitics_list_region();?>
			</div>
			<div class="grid_3"><a href="<?php bloginfo('wpurl'); ?>/topic/"><b>研究主题</b></a><br><br>
				<?php cnpolitics_list_toptopic();?>
			</div>
		</div><!--Nav-->
	</div><!--slidecontent-->

	<div class="clear"></div>
	<div class="when-shown"><p style="padding-top:20px;">隐藏导航</p></div>
	<div class="shadow-header" style="margin-top:-41px;"></div>
	<div class="when-hidden"><p style="padding-top:5px;">展开导航</p></div>
</div><!--/header-->
