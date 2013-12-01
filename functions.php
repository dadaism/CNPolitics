<?php
require_once('config.php');

/* For wordpress backend admin */
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once('backend.php');


/* For wordpress theme */
add_action('admin_menu', 'setup_theme_admin_menus');
add_action('add_meta_boxes', 'cnpolitics_create_meta_box' );
add_action('save_post', 'cnpolitics_save_meta_box');
add_action( 'show_user_profile', 'cnpolitics_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'cnpolitics_show_extra_profile_fields' );
add_action( 'personal_options_update', 'cnpolitics_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'cnpolitics_save_extra_profile_fields' );

function setup_theme_admin_menus() {
	add_theme_page("CNPolitics Options", "CNPolitics Option", 'edit_themes', basename(__FILE__),  'theme_option_admin');
}


function cnpolitics_create_meta_box() {
	add_meta_box( 'post-subtitle', 'Subtitle', 'subtitle_box', 'post', 'normal', 'high' );
}

function subtitle_box( $post ) {
	$subtitle = get_post_meta( $post->ID, 'cnpolitics_subtitle', true );
	echo '	<input style="width:100%;" type="text" name="post-subtitle" value="'.esc_attr($subtitle).'">';
}

function cnpolitics_save_meta_box( $post_id ) {
	//verify the metadata is set
	if ( isset( $_POST['post-subtitle'] ) ) {
		//save the metadata
		update_post_meta( $post_id, 'cnpolitics_subtitle', strip_tags( $_POST['post-subtitle'] ) );
	}
}


function get_excerpt($charlength) {
	$excerpt = get_the_excerpt();
	//return mb_strlen( $excerpt );
	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength-3 );
		return $subex."...";
	}
	else {
		return $excerpt;
	}
	/*$excerpt = get_the_excerpt();
	$subex = preg_split("/。/", $excerpt);
	return $subex[0]."。";*/
}

function cnpolitics_list_category() {
	//global $category_display;
	//$categories = get_categories('number=6');
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
							<div class="more"><a href="'.get_category_link($category->cat_ID).'">阅读更多</a></div>
						</div>
					</div>';
	}
}

function cnpolitics_list_region() {
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
	echo '<li><a href="'.get_bloginfo('url').'/static/?static_page=about.html">关于政见 | </a></li>';
	echo '<li><a href="'.get_bloginfo('url').'/static/?static_page=copyright.php">版权声明 | </a></li>';
	echo '<li><a href="'.get_bloginfo('url').'/static/?static_page=coop.php">交流合作 | </a></li>';
	echo '<li><a href="'.get_bloginfo('url').'/static/?static_page=join-us.php">加入我们</a></li>';
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
		//'prev_text' => __(' <li>囧</li> '),
		//'next_text' => __(' 下一页>> ')
	);
	//echo $wp_query->max_num_pages;
	echo paginate_links($pagination);
}

function cnpolitics_show_extra_profile_fields( $user ) { ?>
	<h3>Extra profile information</h3>
	<table class="form-table">
		<tr>
			<th><label for="Title">Title</label></th>
			<td>
				<input type="text" name="title" id="title" value="<?php echo esc_attr( get_the_author_meta( 'title', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Title in CNPolitics.</span>
			</td>
		</tr>
	</table>
<?php }

function cnpolitics_save_extra_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;
	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
	update_usermeta( $user_id, 'title', $_POST['title'] );
}

/* ????????????? does not work
Plugin Name: Category pagination fix
Plugin URI: http://www.htmlremix.com/projects/category-pagination-wordpress-plugin
Description: Fixes 404 page error in pagination of category page while using custom permalink
Version: 2.0
Author: Remiz Rahnas
Author URI: http://www.htmlremix.com

Copyright 2009 Creative common (email: mail@htmlremix.com)

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You are allowed to use, change and redistibute without any legal issues. I am not responsible for any damage caused by this program. Use at your own risk
Tested with WordPress 2.7, 2.8.4 only. Works with wp-pagenavi
*/

/**
* This plugin will fix the problem where next/previous of page number buttons are broken on list
* of posts in a category when the custom permalink string is:
* /%category%/%postname%/
* The problem is that with a url like this:
* /categoryname/page/2
* the 'page' looks like a post name, not the keyword "page"
*/
function remove_page_from_query_string($query_string)
{
	/*if ($query_string['name'] == 'page' && isset($query_string['page'])) {
		unset($query_string['name']);
		// 'page' in the query_string looks like '/2', so i'm spliting it out
		list($delim, $page_index) = split('/', $query_string['page']);
		$query_string['paged'] = $page_index;
	}*/
	return $query_string;
}

// I will kill you if you remove this. I died two days for this line
add_filter('request', 'remove_page_from_query_string');

?>
