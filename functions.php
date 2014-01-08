<?php


/* For wordpress backend admin */
//error_reporting(E_ALL);
//ini_set('display_errors',1);
require_once('backend.php');


/* For wordpress theme admin page */
add_action('admin_menu', 'setup_theme_admin_menus');


function setup_theme_admin_menus() {
	add_theme_page("CNPolitics Options", "CNPolitics Option", 'edit_themes', basename(__FILE__),  'theme_option_admin');
}

function get_excerpt($charlength) {
/**
* Return chopped excerpt
* @param int $charlength length of chopped excerpt
*/
	$excerpt = get_the_excerpt();
	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength-3 );
		return $subex."...... | 完整摘要";
	}
	else {
		return $excerpt;
	}
	/*$excerpt = get_the_excerpt();
	$subex = preg_split("/。/", $excerpt);
	return $subex[0]."。";*/
}

function cnpolitics_list_category() {
/**
* List categories in navigation ( homepage )
*/
	$categories = get_categories('orderby=id');
	foreach ( $categories as $key => $value ) {
		$cat_display = get_option("cnpolitics_cat_vis_".$value->cat_ID);
		if ( $cat_display==0 )
			unset($categories[$key]);
		//if ( $category_display[$key] == 0 ) 
		//	unset($categories[$key]);
	}
	$numItems = count($categories);
	$i = 0;
	foreach ( $categories as $key => $category ) {
		if ( ++$i === $numItems ) {
			echo	'<div class="nav-box last">';
		}
		else {
			echo	'<div class="nav-box">';
		}	
		echo	'		<div class="nav-header">
							<img class="expand-nav" src="' . get_bloginfo('template_directory'). '/images/arrow-expand.png">
							<img class="collapse-nav" src="' . get_bloginfo('template_directory'). '/images/arrow-collapse.png">
							<span style="font-size:14px; color:#b42800;">'.$category->name.'</span>
						</div>
						<div class="nav-collapse-content">
							<ul>';
		$args = array( 'posts_per_page' => 4, 'category' => $category->cat_ID);
		$myposts = get_posts( $args );
		//var_dump($myposts);
		foreach( $myposts as $post ) :
			echo	'			<li>
									<a href=" '. get_permalink($post->ID) .'  ">' . get_the_title($post->ID). '</a>
								</li>';
	 	endforeach;
		echo	'			</ul>
							<div class="clear"></div>
							<div class="more"><a href="'.get_category_link($category->cat_ID).'">阅读更多 »</a></div>
						</div>
					</div>';
	}
}

function cnpolitics_list_region() {
/**
* List researchers according to regions in navigation ( homepage )
*/
	global $regions;
	$numItems = count($regions);
	$i = 0;
	foreach ($regions as $key => $value) {
		if ( ++$i === $numItems ) {
			echo	'<div class="nav-box last">';
		}
		else {
			echo	'<div class="nav-box">';
		}	
		echo	'		<div class="nav-header">
							<img class="expand-nav" src="' . get_bloginfo('template_directory'). '/images/arrow-expand.png">
							<img class="collapse-nav" src="' . get_bloginfo('template_directory'). '/images/arrow-collapse.png">
							<span style="font-size:14px; color:#b42800;">'.$value.'</span>
						</div>
						<div class="nav-collapse-content continent">
							<ul>';
		$myrschs = get_rschs( $key );			
		foreach( $myrschs as $rsch ) :
			if ( ord($rsch->name[0])>127 )			
				echo	'			<li><a href="'.get_bloginfo('url')."/researcher/?rsch_id=".$rsch->id.'">' . $rsch->name. '</a></li>';
			else {
				$names = explode(" ", $rsch->name);
				$size = count($names);
				if ( $size == 1 )
					$display = $names[0];
				else
					$display = $names[0][0].". ".$names[$size-1];
				echo	'			<li><a href="'.get_bloginfo('url')."/researcher/?rsch_id=".$rsch->id.'">'.$display.'</a></li>';
			}
		endforeach;
		echo	'			</ul>
						</div>
					</div>';
	}
}

function cnpolitics_list_toptopic() {
/**
* List research topics in navigation ( homepage )
*/
	global $toptopics;
	$numItems = count($toptopics);
	$i = 0;
	foreach ($toptopics as $key => $value) {
		if ( ++$i === $numItems ) {
			echo	'<div class="nav-box last">';
		}
		else {
			echo	'<div class="nav-box">';
		}	
		echo	'		<div class="nav-header">
							<img class="expand-nav" src="' . get_bloginfo('template_directory'). '/images/arrow-expand.png">
							<img class="collapse-nav" src="' . get_bloginfo('template_directory'). '/images/arrow-collapse.png">
							<span style="font-size:14px; color:#b42800;">'.$value.'</span>
						</div>
						<div class="nav-collapse-content topic">
							<ul>';
		$mytopics = get_topics( $key );
		//var_dump($mytopics);			
		foreach( $mytopics as $topic ) :
			echo	'			<li><a href="'.get_bloginfo('url')."/topic/?topic_id=".$topic->id.'">'. $topic->subject .'</a></li>';
		endforeach;
		echo	'			</ul>
						</div>
					</div>';
	}
}

function cnpolitics_list_bookmark($cat_id) {
	$bookmarks = get_bookmarks( array(
								'orderby' => 'length',
								'order' => 'ASC',
								//'limit' => '1',
								'category' => $cat_id) );
	$i = 0;
	foreach ( $bookmarks as $bm ) {
		if ( ++$i == '7' )
			echo '</ul><ul style="font-size:13px;list-style: none;margin:0px;padding:0px;line-height:24px;width:80px;float:left;">';
		echo '<li style="display:block;"><a href="'.$bm->link_url.'">'.__($bm->link_name).'</a></li>';
	}
}

function cnpolitics_list_page() {
	$pages = get_pages( array( 'sort_column' =>'menu_order', 'include' => '2,106,108,743,') );
	$numItems = count($pages);
	$i = 0;
	foreach ( $pages as $page ) {
		if ( ++$i === $numItems ) {
			//echo '<li><a href="'.$page->guid.'"> '.$page->post_title.'</a></li>';
			echo '<li><a href="'. get_page_link($page->ID).'"> '.$page->post_title.'</a></li>';
		}
		else {
			//echo '<li><a href="'.$page->guid.'"> '.$page->post_title.' |</a></li>';
			echo '<li><a href="'. get_page_link($page->ID).'"> '.$page->post_title.' | </a></li>';
		}
	}
}

function cnpolitics_list_static() {
/**
* List static pages in homepage
*/
	echo '<li><a href="'.get_bloginfo('url').'/static/?static_page=about.php">关于政见｜</a></li>';
	echo '<li><a href="'.get_bloginfo('url').'/static/?static_page=copyright.php">版权声明｜</a></li>';
	echo '<li><a href="'.get_bloginfo('url').'/static/?static_page=coop.php">交流合作｜</a></li>';
	echo '<li><a href="'.get_bloginfo('url').'/static/?static_page=join-us.php">加入我们｜</a></li>';
	echo '<li><a href="'.get_bloginfo('url').'/static/?static_page=team.php">团队成员</a></li>';
}

register_sidebars( //register sidebar
	2,    
	array(
		'id' => 'info',
        'name' => 'Right-side',
        'before_widget' => '<div class="rightwidget">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>',
        ),
	array(
		'id' => 'filter',
        'name' => 'Right-side-filter',
        'before_widget' => '<div class="rightwidget">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>',
        ));

function theme_option_admin() {
	//global $category_display;
	if (!current_user_can('manage_options')) {  
	    wp_die('You do not have sufficient permissions to access this page.');  
	}
	if ( isset($_POST['action']) ) {
		echo $_POST['action'];
		if ( $_POST['action']=="save" ) {
			for ( $i=0; $i<=5; $i++) {
				//echo $_POST["cnpolitics_recommend_title_".$i];
				update_option("cnpolitics_recommend_title_".$i, $_POST["cnpolitics_recommend_title_".$i]);
				update_option("cnpolitics_recommend_content_".$i, $_POST["cnpolitics_recommend_content_".$i]);
				update_option("cnpolitics_recommend_link_".$i, $_POST["cnpolitics_recommend_link_".$i]);	
			}
			$categories = get_categories('orderby=id');
			foreach ( $categories as $key => $value ) {
   				//var_dump($_POST["cnpolitics_catbox_".$value->cat_ID]);
				if(isset($_POST["cnpolitics_catbox_".$value->cat_ID]) && $_POST["cnpolitics_catbox_".$value->cat_ID] == 'Yes') {
   					//echo $value->cat_ID." Yes";
   					update_option("cnpolitics_cat_vis_".$value->cat_ID, 1);
				}
				else {
    				//echo $value->cat_ID." No";
    				update_option("cnpolitics_cat_vis_".$value->cat_ID, 0);
				}
			}
		}
		else if ( $_POST['action']=="reset" ) {
			for ( $i=0; $i<=5; $i++) {
				update_option("cnpolitics_recommend_title_".$i, '');
				update_option("cnpolitics_recommend_content_".$i, '');
				update_option("cnpolitics_recommend_link_".$i, '');
			}
			$categories = get_categories('orderby=id');
			foreach ( $categories as $key => $value ) {	
   					update_option("cnpolitics_cat_vis_".$value->cat_ID, 1);
			}
		}
	}
	echo '<div class="wrap">
			<h2>'.wp_get_theme().' Settings</h2>
		 	<form method="post">';
	echo '<table class="widefat" width="100%" border="0" cellpadding="0" cellspacing="0">
			<thead>
			<tr>
				<th colspan="2">Categories Navigation</th>
			</tr>
			</thead>
		  </table>';
	echo '<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color:#f4f4f4; padding:10px">
			<tbody>
			<tr>
				<td width="30%" rowspan="2" valign="middle"><strong>Categories to show at Navigation Bar<br><small>(Please enable Javascript to use this)</small></strong> </td>					
			<td width="70%" >';
	$categories = get_categories('orderby=id');
	foreach ( $categories as $key => $value ):
		$cat_display = get_option("cnpolitics_cat_vis_".$value->cat_ID);
		//if ( $category_display[$key] == 1 )
		if ( $cat_display == 1 )
			$visibility = "checked";
		else
			$visibility = "";
		echo '<label title="'.$value->name.'">
				<div style="border:1px solid #cccccc;margin-right:4px;margin-bottom:4px;padding:4px;white-space:nowrap;float:left;">
					<input type="checkbox" name="cnpolitics_catbox_'.$value->cat_ID.'"'.$visibility.' value="Yes">'.$value->name.'
				</div>
			  </label>';
	endforeach;
	echo '			</td>
				</tr>
				<tr><td><small>Choose the categories you want to show at the navigation header under the logo.<br>
							   Choose only important categories to avoid overflow</small></td>
				</tr>
				<tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr>
				<tr><td colspan="2">&nbsp;</td></tr>
			</tbody>
		  </table>
		  <table class="widefat" width="100%" border="0" cellpadding="0" cellspacing="0">
		  	<thead>
		  		<tr>
				<th colspan="2">Recommended reading</th>
				</tr>
			</thead>
		  </table>
		  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color:#f4f4f4; padding:10px">
		  	<tbody>';
	for ($i=0; $i<=5; $i++){
		echo	'
				<tr class="form-field form-required">
					<td width="30%" valign="middle"><strong>Title '.$i.'</strong></td>
					<td width="70%"><input style="width:400px;" name="cnpolitics_recommend_title_'.$i.'" id="cnpolitics_recommend_title_'.$i.'" type="text" value="'.get_option("cnpolitics_recommend_title_".$i).'"></td>
				</tr>
				<tr class="form-field form-required">
					<td width="30%" valign="middle"><strong>Content '.$i.'</strong></td>
					<td width="70%"><textarea name="cnpolitics_recommend_content_'.$i.'" style="width:400px; height:110px;" type="textarea" cols="" rows="">'.get_option("cnpolitics_recommend_content_".$i).'</textarea></td>
				</tr>
				<tr class="form-field form-required">
					<td width="30%" valign="middle"><strong>Link '.$i.'</strong></td>
					<td width="70%"><input style="width:400px;" name="cnpolitics_recommend_link_'.$i.'" id="cnpolitics_recommend_link_'.$i.'" type="text" value="'.get_option("cnpolitics_recommend_link_".$i).'"></td>
				</tr>
				<tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr>
				<tr><td colspan="2">&nbsp;</td></tr>';
	}
	echo	'
		  	</tbody>
		  </table>
		  <p class="submit" style="display:inline; float:right;">
			<input name="save" type="submit" value="Save changes">
			<input type="hidden" name="action" value="save">
		  </p>
		</form>';
	echo '<form style="display:inline;" method="post">
			<p class="submit" style="display:inline; ">
			<input name="reset" type="submit" value="Reset">
			<input type="hidden" name="action" value="reset">
			</p>
		  </form>
		  <div class="clear"></div>';
	//	if (isset($_POST['action'])) {
	//	echo $_POST['action'];
	//}
echo '	</div>';
}

function wp_pagenavi() {
/**
* Page navigation
*/
	global $wp_query;
	global $wp_rewrite;
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
	$pagination = array(
		'base'      => @add_query_arg('paged','%#%'),
		'format'    => '',
		//'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		//'format' => '?paged=%#%',
		'total'     => $wp_query->max_num_pages,
		'current'   => $current,
		'show_all'  => false,
		'type'      => 'plain',
		'end_size'  => '1',
		'mid_size'  => '4',
		'prev_text' => __(' << '),
		'next_text' => __(' >> ')
	);
	//echo $wp_query->max_num_pages;
	echo paginate_links($pagination);
}

?>
