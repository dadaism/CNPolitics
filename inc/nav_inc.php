<div id="header" class="fixed-atop">
	<!--div id="logo" style="cursor:pointer;" onclick="location.href='<?php bloginfo('siteurl'); ?>';"></div--><!--/logo-->
	<div id="logo">
		<a href="<?php bloginfo('siteurl'); ?>">政见 CNPolitics.org</a>
	</div>
	<!--div class="shadow"></div-->
	<div id="slidecontent">
		<?php require_once( get_template_directory().'/inc/search_box.php' ); ?>
		<div id="nav">
			<div class="grid_5"><b>文章分类</b><br><br>
				<?php cnpolitics_list_category(); ?>
			</div>
			<div class="grid_4"><b>谁在研究中国</b><br><br>
				<?php cnpolitics_list_region();?>
			</div>
			<div class="grid_3"><b>研究主题</b><br><br>
				<?php cnpolitics_list_toptopic();?>
			</div>
		</div><!--Nav-->
	</div><!--slidecontent-->

	<div class="clear"></div>
	<div class="when-shown"><p style="padding-top:20px;">隐藏导航</p></div>
	<div class="shadow-header" style="margin-top:-41px;"></div>
	<div style="display: block;" class="when-hidden"><p style="padding-top:5px;">展开导航</p></div>
</div><!--/header-->