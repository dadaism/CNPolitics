<?php

	$cnpoliticsers = get_users('orderby=post_count&order=DESC');

	/* Observer */
	$obs = array();
	/* graphics */
	$gra = array();
	/* new media operation */
	$ops = array();
	/* designer */
	$des = array();
	/* engineer */
	$eng = array();

	/* other */
	$other = array();
	
	/* past */
	$past = array();

	foreach ($cnpoliticsers as $key => $user) {
		$titles = get_the_author_meta( 'cnpolitics_title', $user->ID );
		$delimiters = array(',','，');
		$result = multiple_explode($delimiters,$titles);
		//var_dump($result);
		//if ( !empty($result[0]) ) 
		//	echo "<div>".$user->display_name." : ".$result[0]. "</div>";
	
		foreach ($result as $key => $title) {
		 	if ( $title === "观察员") {
		 		array_push($obs, $user->ID);
			}
			else if ( $title === "制图师") {
		 		array_push($gra, $user->ID);
			}
			else if ( $title === "新媒体运营") {
		 		array_push($ops, $user->ID);
			}
			else if ( $title === "设计师") {
	 			array_push($des, $user->ID);
			}
			else if ( $title === "工程师") {
	 			array_push($eng, $user->ID);
			}
			else if ( $title === "其他") {
	 			array_push($other, $user->ID);
			}
			else if ( $title === "离职") {
	 			array_push($past, $user->ID);
			}
	 	} 
	}
?>

<div class="clear"></div>
<div id='scroller-anchor'></div>
<div id='fixed-top'>
	<div id="join-nav">
		<h1>团队成员</h1>
		<ul>
			<li class="join-nav-obs">观察员 |</li>
			<li class="join-nav-gra"> 制图师 |</li>
			<li class="join-nav-ops"> 新媒体运营 |</li>
			<li class="join-nav-des"> 设计师 |</li>
			<li class="join-nav-eng"> 工程师</li>
		</ul>
	</div>
	<div id="display_bar">
		<img src="<?php bloginfo('template_directory'); ?>/images/shadow_middle.png">
	</div>
</div> <!--fixed-top end-->

<div id="team-main">
	<div id="join-observer">
		<div class="team-first-group">
			<p>观察员</p>
		</div>
<?php
	foreach ($obs as $key => $uid) :
		$intro = get_the_author_meta('description', $uid);
		$name = get_the_author_meta('display_name', $uid);
		$email = get_the_author_meta('user_email', $uid);
		$url = get_author_posts_url($uid);
		echo '
		<div class="team-unit">
			<div class="team-logo">'.get_avatar($email, 80).'</div>
			<div class="team-name"><a href="'.$url.'">'.$name.'</a></div>
			<div class="team-intro"><p>'.$intro.'</p></div>
		</div>';
	endforeach;
?>
	</div>
	<div class="clear"></div>

	<div id="join-graphic">
		<div class="team-group">
			<p>制图师</p>
		</div>
<?php
	foreach ($gra as $key => $uid) :
		$intro = get_the_author_meta('description', $uid);
		$name = get_the_author_meta('display_name', $uid);
		$email = get_the_author_meta('user_email', $uid);
		$url = get_author_posts_url($uid);
		echo '
		<div class="team-unit">
			<div class="team-logo">'.get_avatar($email).'</div>
			<div class="team-name"><a href="'.$url.'">'.$name.'</a></div>
			<div class="team-intro"><p>'.$intro.'</p></div>
		</div>';
	endforeach;
?>	
	</div>
	<div class="clear"></div>

	<div id="join-operation">
		<div class="team-group">
			<p>新媒体运营</p>
		</div>
<?php
	foreach ($ops as $key => $uid) :
		$intro = get_the_author_meta('description', $uid);
		$name = get_the_author_meta('display_name', $uid);
		$email = get_the_author_meta('user_email', $uid);
		$url = get_author_posts_url($uid);
		echo '
		<div class="team-unit">
			<div class="team-logo">'.get_avatar($email).'</div>
			<div class="team-name"><a href="'.$url.'">'.$name.'</a></div>
			<div class="team-intro"><p>'.$intro.'</p></div>
		</div>';
	endforeach;
?>	
	</div>
	<div class="clear"></div>

	<div id="join-design">		
		<div class="team-group">
			<p>设计师</p>
		</div>
<?php
	foreach ($des as $key => $uid) :
		$intro = get_the_author_meta('description', $uid);
		$name = get_the_author_meta('display_name', $uid);
		$email = get_the_author_meta('user_email', $uid);
		$url = get_author_posts_url($uid);
		echo '
		<div class="team-unit">
			<div class="team-logo">'.get_avatar($email).'</div>
			<div class="team-name"><a href="'.$url.'">'.$name.'</a></div>
			<div class="team-intro"><p>'.$intro.'</p></div>
		</div>';
	endforeach;
?>	
	</div>				
	<div class="clear"></div>

	<div id="join-engineer">
		<div class="team-group">
			<p>工程师</p>
		</div>
<?php
	foreach ($eng as $key => $uid) :
		$intro = get_the_author_meta('description', $uid);
		$name = get_the_author_meta('display_name', $uid);
		$email = get_the_author_meta('user_email', $uid);
		$url = get_author_posts_url($uid);
		echo '
		<div class="team-unit">
			<div class="team-logo">'.get_avatar($email).'</div>
			<div class="team-name"><a href="'.$url.'">'.$name.'</a></div>
			<div class="team-intro"><p>'.$intro.'</p></div>
		</div>';
	endforeach;
?>
	</div>
	<div class="clear"></div>

	<div id='team-more'>
		<div id='invited-members'>
			<p>其他成员：</p>	
			<ul>
<?php
	foreach ($other as $key => $uid) :
		$name = get_the_author_meta('display_name', $uid);
		$url = get_the_author_meta('user_url', $uid);
		echo 	'<li><a style="color:#000" href='.$url.'>'.$name.'</a></li>';
	endforeach;
?>
			</ul>
		</div>

		<div id='contributors'>
			<p>感谢曾经为政见团队做出贡献的：</p>
			<ul>
<?php
	foreach ($past as $key => $uid) :
		$name = get_the_author_meta('display_name', $uid);
		$url = get_the_author_meta('user_url', $uid);
		echo 	'<li><a style="color:#000" href='.$url.'>'.$name.'</a></li>';
	endforeach;
?>
			</ul>
		</div>

	</div> <!-- team- more end-->

</div><!--/join-main end-->

<div class="grid_2"><br></div>
<div class="clear"></div>

<script>
	$(function() {
		var move = function() {
			var screenTop = $(window).scrollTop();
			var objectTop = $('#scroller-anchor').offset().top;
			var scrollEnd = $('#join-engineer').offset().top;
			var object = $('#fixed-top');
			if (screenTop > objectTop && screenTop < scrollEnd-100) {
				object.css({position:'fixed',top:"0px"});
				var h = $("#fixed-top").height();
				$('#team-main').css({"padding-top":h});
			} else {
				object.css({position:"relative",top:""});
				$('#team-main').css({"padding-top":'0px'});
				}
		}; //move end
		$(window).scroll(move);
		move();
	});
</script>
