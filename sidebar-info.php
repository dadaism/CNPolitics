<?php
	$post_author = get_the_author_meta( 'user_login' );
	$query = new WP_Query(
		array(
			'author_name' => $post_author,
			'post__not_in' => array($post->ID),	
			'showposts' => 3, // 显示相关文章数量
			'orderby' => date, // 按时间排序
			'caller_get_posts' => 1
			)
	);
	$posts = $query->posts;
?>
	<div class="post-sidebar">
		<div class="post-info-box">
			<img class="expand-observer-info" src="<?php bloginfo('template_directory'); ?>/images/arrow-expand.png">
			<img class="collapse-observer-info" src="<?php bloginfo('template_directory'); ?>/images/arrow-collapse.png">
			观察员：<a href=""><?php the_author();?></a>
			<div class="observer-info">
				<p style="margin-top:20px;">个人简介：</p>
				<p style="color:#777;"><?php echo get_the_author_meta('description');?></p>
				<p style="margin-top:20px;">最新发表：</p>
				<p>
				<ul>
				<?php foreach($posts as $k => $p): //文章输出 ?>
					<li><a href="<?php echo get_permalink($p->ID); ?>"><?php echo $p->post_title ?></a></li>
				<?php endforeach; ?>
				</ul>
				</p>
				<p style="margin-bottom:20px;margin-top:0px;"><a href="" style="color:#b9b9b9;font-size:12px;float:right;">浏览更多>></a></p>
			</div>
		</div>
		<div class="post-info-box">
			<img class="expand-researcher-info" src="<?php bloginfo('template_directory'); ?>/images/arrow-expand.png">
			<img class="collapse-researcher-info" src="<?php bloginfo('template_directory'); ?>/images/arrow-collapse.png">
			研究者：<a href="">研究者名（F.M. Lastname）</a>
			<div class="researcher-info">
				<p style="margin-top:20px;">个人简介：</p>
				<p style="color:#777;">个人简介，字号14px，栏宽20em。个人简介，字号14px，栏宽20em。</p>
				<p style="margin-top:20px;">相关文章：</p>
				<p>
				<ul>
					<li><a href="">文章1</a></li>
					<li><a href="">文章1</a></li>
					<li><a href="">文章1</a></li>
					<li><a href="">文章1</a></li>
				</ul>
				</p>
				<p style="margin-bottom:20px;margin-top:0px;"><a href="" style="color:#b9b9b9;font-size:12px;float:right;">浏览更多>></a></p>
			</div>
		</div>
		<div class="post-info-box">
			<img class="expand-theme-info" src="<?php bloginfo('template_directory'); ?>/images/arrow-expand.png">
			<img class="collapse-theme-info" src="<?php bloginfo('template_directory'); ?>/images/arrow-collapse.png">
			主题名：<a href="">主题名称</a>
			<div class="theme-info">
				<p style="margin-top:20px;">主题简介：</p>
				<p style="color:#777;">个人简介，字号14px，栏宽20em。个人简介，字号14px，栏宽20em。</p>
				<p style="margin-top:20px;">相关文章：</p>
				<p>
				<ul>
					<li><a href="">文章1</a></li>
					<li><a href="">文章1</a></li>
					<li><a href="">文章1</a></li>
					<li><a href="">文章1</a></li>
				</ul>
				</p>
				<p style="margin-bottom:20px;margin-top:0px;"><a href="" style="color:#b9b9b9;font-size:12px;float:right;">浏览更多>></a></p>
			</div>
		</div>
		<p><a href=""><b>政见 CNPolitics.org</b></a> 是一个独立团队，向你介绍世界上最聪明的脑袋是怎样分析中国的。我们致力于发掘海内外学者和智库的智慧成果，引进思想资源。｜更多关于我们 »</p>
		<p style="color:#777777;margin-bottom:10px;">关注政见动向：</p>
		<div class="post-sidebar-social">
			<ul>
			<li><a href="#" class="fav" style="margin-right:14px;"><img src="<?php bloginfo('template_directory'); ?>/images/social_fav.png"></a></li>
			<li><a href="#" class="rss" style="margin-right:14px;"><img src="<?php bloginfo('template_directory'); ?>/images/social_rss.png"></a></li>
			<li><a href="#" class="sina" style="margin-right:14px;"><img src="<?php bloginfo('template_directory'); ?>/images/social_sina.png"></a></li>
			<li><a href="#" class="tecent" style="margin-right:14px;"><img src="<?php bloginfo('template_directory'); ?>/images/social_tecent.png"></a></li>
			<li><a href="#" class="a163" style="margin-right:14px;"><img src="<?php bloginfo('template_directory'); ?>/images/social_163.png"></a></li>
			</ul>
		</div>
		<p style="color:#777777;margin-bottom:15px;float:left;">订阅最新文章，自动推送至你的邮箱：</p>
		<form style="display:inline;" method="get" action="#">
			<input type="text" value="输入你的Email地址" onblur="if (this.value==''){this.value='输入你的Email地址'}" onfocus="if (this.value=='输入你的Email地址') {this.value=''}" class="post-sidebar-emailbox-input"/>
			<input type="image" style="margin-bottom:-30px;verticle-align:middle;" src="<?php bloginfo('template_directory'); ?>/images/footer_inputting.png">
		</form>
		<img src="<?php bloginfo('template_directory'); ?>/images/shadow_emailbox.png" style="margin-left:-15px;margin-top:-5px;">
</div>
