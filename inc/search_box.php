<div id="search">
	<form id="search_form" style="display:inline" method="get" action="<?php bloginfo('siteurl'); ?>/">
		<input type="text" name="s" value="搜索" onblur="if (this.value==''){this.value='搜索'}" onfocus="if (this.value=='搜索') {this.value=''}" class="topsearch_input"/>
		<input type="image" class="topsearch_img" src="<?php bloginfo('template_directory'); ?>/images/search.png"/>
	</form>
</div>
