<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

require_once('config.php');
require_once('view.php');
require_once('model.php');

require_once('author-avatar.php');

add_action( 'admin_menu', 'CNPolitics_add_submenu' );
add_action( 'submitpost_box', 'CNPolitics_add_box');
add_action( 'post_updated', 'CNPolitics_save_post');
add_action( 'init', 'CNPolitics_add_scripts');
add_action( 'admin_print_styles', 'CNPolitics_add_admin_styles');

add_action('add_meta_boxes', 'cnpolitics_create_meta_box');
add_action('save_post', 'cnpolitics_save_meta_box');
add_action('show_user_profile', 'cnpolitics_show_extra_profile_fields');
add_action('edit_user_profile', 'cnpolitics_show_extra_profile_fields');
add_action('personal_options_update', 'cnpolitics_save_extra_profile_fields');
add_action('edit_user_profile_update', 'cnpolitics_save_extra_profile_fields');

if (!isset($_SESSION)){
	session_start();
}

/**
* Add submenu to post
*/
function CNPolitics_add_submenu() {

	add_submenu_page( 'edit.php', 'CNPolitics', 'Topics', 'edit_pages', 
						'CNPolitcs_topics_settings_page', 'CNPolitics_topics_setting' );
	add_submenu_page( 'edit.php', 'CNPolitics', 'Researchers', 'edit_pages', 
						'CNPolitcs_researchers_settings_page', 'CNPolitics_researchers_setting' );
	add_submenu_page( 'edit.php', 'CNPolitics', 'Special Issue', 'edit_pages', 
						'CNPolitcs_issues_settings_page', 'CNPolitics_issues_setting' );
}

/**
* Add JavaScript to show tabs
*/
function CNPolitics_add_scripts() {
	//wp_register_script('CNPolitics-script', plugins_url('/CNPolitics.js', __FILE__));
	wp_register_script('CNPolitics-script', get_template_directory_uri().'/js/CNPolitics.js');
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_script( 'CNPolitics-script');
}

/**
* Add styles for admin page
*/
function CNPolitics_add_admin_styles() {
	wp_enqueue_style('thickbox');
}

/**
* Add select box to post edit page
*/
function CNPolitics_add_box () {
	add_meta_box('choose-topic', 'Topics', 'topics_box', 'post', 'side', 'default');
	add_meta_box('choose-researcher', 'Researchers', 'researchers_box', 'post', 'side', 'default');
	add_meta_box('choose-issue', 'Special Issues', 'issues_box', 'post', 'side', 'default');
}

/**
* state machine to control topics setting
*/
function CNPolitics_topics_setting() {
	global $wpdb;
	if ( isset($_GET['position']) ) {
		$toward = $_GET['toward'];
		$order_no  = $_GET['order_no'];
		$cat = $_GET['cat'];
		$content_id = $_GET['id'];
		move_position("topics", "category", $cat, $content_id, $order_no, $toward);
	}
	if ( isset($_GET['action']) ) {
		
		if ( $_GET['action']=='edit' ) {
			$id = $_GET['id'];
			$topic_info = get_edit_topic($id);
			edit_topic_disp($topic_info);
			//$topic_info->checked = array(4, 8, 10);
			echo '<script type="text/javascript">
					var arrayID='.json_encode($topic_info->checked).';					
					check_checkbox("rschid-", arrayID);
				  </script>';
		}
		else if ( $_GET['action']=='delete' ) {
			// delete_topic();
			$id = $_GET['id'];
			delete_topic($id);	
			$topic_array = 	get_topic_table();
			topic_setting_disp($topic_array);
		}
		else if ( $_GET['action']=='filter' ) {
			// get_topic_table($category);
			$top_topic = $_GET['filter-tag'];
			$topic_array = 	get_topic_table($top_topic, NULL);
			topic_setting_disp($topic_array, $top_topic);
		
		}
		else if ( $_GET['action']=='search' ) {
			$key_word = $_GET['s'];
			$topic_array = 	get_topic_table(NULL, $key_word);
			topic_setting_disp($topic_array);
		}
	
	}
	else if ( isset($_POST['action']) ) {
			if ( $_POST['action']=='add' ) {
				global $topic_image_dir;
				if ( trim($_POST['topic-name'])=='' ) {
					echo '<div id="message" class="error">Topic name should not be empty!</div>';
				}
				else if ( is_topic_exist( trim($_POST['topic-name']) ) ) {
					echo '<div id="message" class="error">Topic "'.$_POST['topic-name'].'" exist!</div>';
				}
				else if ( file_exists($_FILES['topic-img']['tmp_name']) && file_exists( $topic_image_dir.$_FILES['topic-img']["name"]) ) {
					echo '<div id="message" class="error">Image "'.$_FILES['topic-img']["name"].'" exist! Rename your image!</div>';
				}
				else {
					$file_path = '';
					/*if ($_FILES['topic-img']['error'] > 0) {
						echo "Error: " . $_FILES['topic-img']["error"] . "<br>";
	  				}*/
					if(  is_uploaded_file($_FILES['topic-img']['tmp_name']) ) {
						/*echo "Upload: " . $_FILES['topic-img']["name"] . "<br>";
						echo "Type: " . $_FILES['topic-img']["type"] . "<br>";
						echo "Size: " . ($_FILES['topic-img']["size"] / 1024) . " kB<br>";
						echo "Stored in: " . $_FILES['topic-img']["tmp_name"]."<br>";*/
						$file_tmp = $_FILES['topic-img']["tmp_name"];
						$file_path = $topic_image_dir . $_FILES['topic-img']["name"];
						move_uploaded_file( $file_tmp, get_template_directory().$file_path);
					}
					$topic_info = array (
									'name'	=> trim($_POST['topic-name']),
									'cat'	=> $_POST['top-topic'],
									'intro'	=> $_POST['topic-intro'],
									'img_path' => $file_path,
										);
					if ( isset($_POST['rsch_checkbox']) ) {
						$topic_info['related_rschs'] = $_POST['rsch_checkbox'];
					}
					else {
						$topic_info['related_rschs'] = NULL;
					}
					add_topic( $topic_info );
				}
			}
			else if ( $_POST['action']=='update') {
				global $topic_image_dir;
				if ( trim($_POST['topic-name'])=='' ) {
					echo '<div id="message" class="error">Topic name should not be empty!</div>';
				}
				else {
					$file_path = $_POST['img-path'];
					//var_dump($_FILES);
					if ( file_exists($_FILES['topic-img']['tmp_name']) ) { // file uploaded!
						if ( $topic_image_dir.$_FILES['topic-img']["name"] != $_POST['img-path'] 
							&& file_exists( get_template_directory().$topic_image_dir.$_FILES['topic-img']["name"]) ){
							echo '<div id="message" class="error">Image "'.$_FILES['topic-img']["name"].'" exist! Rename your image!</div>';
						}
						// remove old image
						else {
							if ( $_POST['img-path']!='' ) {
								unlink( get_template_directory().$_POST['img-path'] );
							}
							$file_tmp = $_FILES['topic-img']["tmp_name"];	
							$file_path = $topic_image_dir . $_FILES['topic-img']["name"];
							move_uploaded_file( $file_tmp, get_template_directory().$file_path);
						}
					}
					// update database
					$topic_info = array(
								"id"	=> $_POST['id'],
								"sub"	=> trim($_POST['topic-name']),
								"cat"	=> $_POST['top-topic'],
								"intro"	=> $_POST['topic-intro'],
								"img_path"	=> $file_path,
								);


					if ( isset($_POST['rsch_checkbox']) ) {
						//echo "checked!\n";
						$topic_info['related_rschs'] = $_POST['rsch_checkbox'];
					}
					else {
						$topic_info['related_rschs'] = NULL;
					}
					update_topic($topic_info);
				}
			}
			else {
				// wrong post..
			}
			$topic_table = get_topic_table();
			topic_setting_disp($topic_table);
		}
	else {
		$topic_table = get_topic_table();
		topic_setting_disp($topic_table);
	}
}	

/**
* state machine to control researchers setting
*/
function CNPolitics_researchers_setting() {
	global $wpdb;
	if ( isset($_GET['position']) ) {
		$toward = $_GET['toward'];
		$order_no  = $_GET['order_no'];
		$cat = $_GET['cat'];
		$content_id = $_GET['id'];
		move_position("rschs", "region", $cat, $content_id, $order_no, $toward);
	}
	if ( isset($_GET['action']) ) {
		if ( $_GET['action']=='edit' ) {
			$id = $_GET['id'];
			$rsch_info = get_edit_rsch($id);
			edit_rsch_disp($rsch_info);
			//var_dump($rsch_info->checked);
			//$rsch_info->checked = array(4, 8, 10);
			//var_dump($rsch_info->checked);
			echo '<script type="text/javascript">
					var arrayID='.json_encode($rsch_info->checked).';					
					check_checkbox("topicid-",arrayID);
				  </script>';
		}
		else if ( $_GET['action']=='delete' ) {
			// delete_topic();
			$id = $_GET['id'];
			delete_rsch($id);	
			$rsch_array = get_rsch_table();
			rsch_setting_disp($rsch_array);
		}
		else if ( $_GET['action']=='filter' ) {
			// get_topic_table($category);
			$region = $_GET['filter-tag'];
			$rsch_array = get_rsch_table($region, NULL);
			rsch_setting_disp($rsch_array, $region);
		}
		else if ( $_GET['action']=='search' ) {
			$key_word = $_GET['s'];
			$rsch_array = 	get_rsch_table(NULL, $key_word);
			rsch_setting_disp($rsch_array);
		}
	
	}
	else if ( isset($_POST['action']) ) {
			if ( $_POST['action']=='add' ) {
				global $rsch_image_dir;
				if ( trim($_POST['rsch-name'])=='' ) {
					echo '<div id="message" class="error">Researcher name should not be empty!</div>';
				}
				else if ( is_rsch_exist( trim($_POST['rsch-name']) ) ) {
					echo '<div id="message" class="error">Researcher "'.$_POST['rsch-name'].'" exist!</div>';
				}
				else if ( file_exists($_FILES['rsch-img']['tmp_name']) && file_exists( $rsch_image_dir.$_FILES['rsch-img']["name"]) ) {
					echo '<div id="message" class="error">Image "'.$_FILES['rsch-img']["name"].'" exist! Rename your image!</div>';
				}
				else {
					$file_path = '';
					if(  is_uploaded_file($_FILES['rsch-img']['tmp_name']) ) {
						$file_tmp = $_FILES['rsch-img']["tmp_name"];
						$file_path = $rsch_image_dir . $_FILES['rsch-img']["name"];
						move_uploaded_file( $file_tmp, get_template_directory().$file_path);
					}
					$rsch_info = array (
							'name'		=> trim($_POST['rsch-name']),
							'alias'		=> $_POST['rsch-alias'],
							'sex'		=> $_POST['rsch-sex'],
							'birth'		=> $_POST['rsch-birth'],
							'region'	=> $_POST['rsch-region'],
							'title'		=> $_POST['rsch-title'],
							'experience'=> $_POST['rsch-experience'],
							'rep'		=> $_POST['rsch-rep'],							
							'intro'		=> $_POST['rsch-intro'],
							'img_path'	=> $file_path,
							);
					add_rsch( $rsch_info );
				}
			}
			else if ( $_POST['action']=='update') {
				global $rsch_image_dir;
				if ( trim($_POST['rsch-name'])=='' ) {
					echo '<div id="message" class="error">Researcher name should not be empty!</div>';
				}
				else {
					$file_path = $_POST['img-path'];
					if ( file_exists($_FILES['rsch-img']['tmp_name']) ) { // file uploaded!
						if ( $rsch_image_dir.$_FILES['rsch-img']["name"] != $_POST['img-path'] 
							&& file_exists( get_template_directory().$rschs_image_dir.$_FILES['rsch-img']["name"]) ){
							echo '<div id="message" class="error">Image "'.$_FILES['rsch-img']["name"].'" exist! Rename your image!</div>';
						}
						// remove old image
						else {
							if ( $_POST['img-path']!='' ) {
								unlink( get_template_directory().$_POST['img-path'] );
							}
							$file_tmp = $_FILES['rsch-img']["tmp_name"];	
							$file_path = $rsch_image_dir . $_FILES['rsch-img']["name"];
							move_uploaded_file( $file_tmp, get_template_directory().$file_path);
						}
					}
					// update database
					$rsch_info = array (
							'id'		=> $_POST['id'],
							'name'		=> trim($_POST['rsch-name']),
							'alias'		=> $_POST['rsch-alias'],
							'sex'		=> $_POST['rsch-sex'],
							'birth'		=> $_POST['rsch-birth'],
							'region'	=> $_POST['rsch-region'],
							'title'		=> $_POST['rsch-title'],
							'experience'=> $_POST['rsch-experience'],
							'rep'		=> $_POST['rsch-rep'],							
							'intro'		=> $_POST['rsch-intro'],
							'img_path'	=> $file_path,
							//'related_topics' => $_POST['topics_checkbox']
							);
					if ( isset($_POST['topic_checkbox']) ) {
						//echo "checked!\n";
						$rsch_info['related_topics'] = $_POST['topic_checkbox'];
						//var_dump( $rsch_info['related_topics'] );
					}
					else {
						$rsch_info['related_topics'] = NULL;
					}
					//foreach ( $rsch_info['related_topics'] as $topic_id )
					//	echo $topic_id."\n";
					
					update_rsch($rsch_info);
				}
			}
			else {
				// wrong post..
			}
			$rsch_table = get_rsch_table();
			rsch_setting_disp($rsch_table);
		}
	else {
		$rsch_table = get_rsch_table();
		rsch_setting_disp($rsch_table);
	}
}

/**
* state machine to control issues setting
*/
function CNPolitics_issues_setting() {
	global $wpdb;
	if ( isset($_GET['position']) ) {
		$toward = $_GET['toward'];
		$order_no  = $_GET['order_no'];
		$content_id = $_GET['id'];
		move_position("issues", "category", 1, $content_id, $order_no, $toward);
	}
	if ( isset($_GET['action']) ) {
		if ( $_GET['action']=='edit' ) {
			$id = $_GET['id'];
			$issue_info = get_edit_issue($id);
			edit_issue_disp($issue_info);
		}
		else if ( $_GET['action']=='delete' ) {
			// delete_topic();
			$id = $_GET['id'];
			delete_issue($id);	
			$issue_array = get_issue_table();
			issue_setting_disp($issue_array);
		}
		else if ( $_GET['action']=='filter' ) {
			//$region = $_GET['filter-tag'];
			$issue_table = get_issue_table();
			issue_setting_disp($issue_table);
		}
		else if ( $_GET['action']=='search' ) {
			$key_word = $_GET['s'];
			$issue_array = get_issue_table(NULL, $key_word);
			issue_setting_disp($issue_array);
		}
	}
	else if ( isset($_POST['action']) ) {
			if ( $_POST['action']=='add' ) {
				echo $_POST['issue-name'];
				echo $_POST['issue-intro'];
				if ( trim($_POST['issue-name'])=='' ) {
					echo '<div id="message" class="error">Issue name should not be empty!</div>';
				}
				else if ( is_issue_exist( trim($_POST['issue-name']) ) ) {
					echo '<div id="message" class="error">Issue "'.$_POST['issue-name'].'" exist!</div>';
				}
				else {
					$issue_info = array (
							'name'		=> trim($_POST['issue-name']),
							'intro'=> $_POST['issue-intro']
							);
					add_issue( $issue_info );
				}
			}
			else if ( $_POST['action']=='update') {
				if ( trim($_POST['issue-name'])=='' ) {
					echo '<div id="message" class="error">Issue name should not be empty!</div>';
				}
				else {
					// update database
					$issue_info = array (
							'id'		=> $_POST['id'],
							'name'		=> trim($_POST['issue-name']),					
							'intro'		=> $_POST['issue-intro'],
							);
					update_issue($issue_info);
				}
			}
			else {
				// wrong post..
			}
			$issue_table = get_issue_table();
			issue_setting_disp($issue_table);
		}
	else {
		$issue_table = get_issue_table();
		issue_setting_disp($issue_table);
	}
}

/**
* Create meta box for subtitle
*/
function cnpolitics_create_meta_box() {
	add_meta_box( 'post-subtitle', 'Subtitle', 'subtitle_box', 'post', 'normal', 'high' );
}

/**
* HTML for subtitle box
*/
function subtitle_box( $post ) {
	$subtitle = get_post_meta( $post->ID, 'cnpolitics_subtitle', true );
	echo '	<input style="width:100%;" type="text" name="post-subtitle" value="'.esc_attr($subtitle).'">';
}

/**
* Save subtitle
*/
function cnpolitics_save_meta_box( $post_id ) {
	if ( isset( $_POST['post-subtitle'] ) ) {
		update_post_meta( $post_id, 'cnpolitics_subtitle', strip_tags( $_POST['post-subtitle'] ) );
	}
}

/**
* Save extra profile fields when update user information
* @param int $user_id user id
*/
function cnpolitics_save_extra_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;
	update_usermeta( $user_id, 'cnpolitics_title', $_POST['title'] );
	update_usermeta( $user_id, 'cnpolitics_weibo', $_POST['weibo'] );
	update_usermeta( $user_id, 'cnpolitics_pubemail', $_POST['pubemail'] );
}

?>