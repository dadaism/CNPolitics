<div class="clear"></div>
</div><!--/container-->

<div id="footer" >
	<div id="container-copy">
	<div class="grid_7">
		<p style="font-size:13px;color:#b9b9b9;font-weight:700;margin-bottom:8px;">关注政见动向：</p>
		<div class="social">
			<a href="#" class="fav" style="margin-right:14px;"><img src="<?php bloginfo('template_directory'); ?>/images/social_fav.png" onmouseover="this.title='添加至收藏夹'" onClick=add_favorite()></a>
			<a href="http://cnpolitics.org/feed/" target="_blank" class="rss" style="margin-right:14px;"><img src="<?php bloginfo('template_directory'); ?>/images/social_rss.png" onmouseover="this.title='订阅RSS'"></a>
			<a href="http://weibo.com/cnpolitics"  target="_blank" class="sina" style="margin-right:14px;"><img src="<?php bloginfo('template_directory'); ?>/images/social_sina.png" onmouseover="this.title='访问新浪微博'"></a>
			<a href="http://t.qq.com/chinapolitics"  target="_blank" class="tecent" style="margin-right:14px;"><img src="<?php bloginfo('template_directory'); ?>/images/social_tecent.png" onmouseover="this.title='访问腾讯微博'"></a>
			<a href="http://t.163.com/cnpolitics"  target="_blank" class="a163" style="margin-right:14px;"><img src="<?php bloginfo('template_directory'); ?>/images/social_163.png" onmouseover="this.title='访问网易微博'"></a>
		</div>
		<p style="font-size:13px;color:#b9b9b9;font-weight:700;padding-bottom:12px;">订阅最新文章，自动推送至你的邮箱：</p>
		<div class="emailbox">
		<!--以下是QQ邮件列表订阅嵌入代码-->
		<script >var nId = "384aadf45363c5d64f96fe9a5b020d0b8acee304fd40cdee"</script>
		<script src="http://list.qq.com/zh_CN/htmledition/js/qf/page/qfcode.js" charset="gb18030"></script>

		<form style="display:inline;" action="http://list.qq.com/cgi-bin/qf_compose_send" target='_blank' method="post">
			<input type="hidden" name="t" value="qf_booked_feedback">
			<input type="hidden" name="id" value="384aadf45363c5d64f96fe9a5b020d0b8acee304fd40cdee">
			<input type="text" id="to" name="to" value="输入你的Email地址" onblur="if (this.value==''){this.value='输入你的Email地址'}" onfocus="if (this.value=='输入你的Email地址') {this.value=''}" class="emailbox_input"/>
			<input type="image" class="emailbox_img" src="<?php bloginfo('template_directory'); ?>/images/footer_input.png">
			<img class="emailbox_shadow" src="<?php bloginfo('template_directory'); ?>/images/shadow_emailbox.png">
		</form>
		</div>
		<ul style="font-size:13px; color:#f1f1f1;">
			<!--?php cnpolitics_list_page(); ?-->
			<?php cnpolitics_list_static(); ?>
		</ul>
		<p style="font-size:13px;margin-top:7px;">&copy; 2011–2013 政见 CNPolitics.org &nbsp;&nbsp;
			<a href="http://www.miitbeian.gov.cn/">京ICP备09007572号-2</a>
		</p>
		</div>

		<div class="grid_5">
		<div class="partner grid_3 alpha">
			<p style="font-size:13px;color:#b9b9b9;font-weight:700;margin-bottom:16px;">合作伙伴</p>
			<ul style="font-size:13px;list-style: none;margin:0px;padding:0px;line-height:24px;width:80px;float:left;">
				<?php cnpolitics_list_bookmark(8); ?><!-- category 8 is 合作伙伴 -->
			</ul>
		</div>

		<div class="grid_2 omega">
			<p style="font-size:13px;color:#b9b9b9;font-weight:700;margin-bottom:16px;">友情链接</p>
			<ul style="font-size:13px;list-style: none;margin:0px;padding:0px;line-height:24px;">
				<?php cnpolitics_list_bookmark(64); ?><!-- category 64 is 友情链接 -->
			</ul>
		</div>
		<div class="clear"></div>
		<div id="footer-end">
			<p><a href="http://www.foundertype.com/">方正字库</a>授权“政见”网站及微博使用方正字体。</p>
			<p>Powered by <a href="http://www.wordpress.org/">WordPress</a>.</p>
		</div>
	</div>  <!-- grid end-->
	</div> <!-- container-copy end-->
</div> <!-- footer end-->

<?php wp_footer(); ?>
</body>
</html>

