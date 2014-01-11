<?php

/**
 * add field to user profiles
 */
class Simple_Local_Avatars {
    private $user_id_being_edited;
    public function __construct() {
        add_filter( 'get_avatar', array( $this, 'get_avatar' ), 10, 5 );
        add_action( 'admin_init', array( $this, 'admin_init' ) );
        add_action( 'show_user_profile', array( $this, 'edit_user_profile' ) );
        add_action( 'edit_user_profile', array( $this, 'edit_user_profile' ) );
        add_action( 'personal_options_update', array( $this, 'edit_user_profile_update' ) );
        add_action( 'edit_user_profile_update', array( $this, 'edit_user_profile_update' ) );
        add_filter( 'avatar_defaults', array( $this, 'avatar_defaults' ) );
    }

    public function get_avatar( $avatar = '', $id_or_email, $size = 96, $default = '', $alt = false ) {
        add_filter('upload_dir', array( $this, 'set_upload_dir') );
        if ( is_numeric($id_or_email) )
            $user_id = (int) $id_or_email;
        elseif ( is_string( $id_or_email ) && ( $user = get_user_by( 'email', $id_or_email ) ) )
            $user_id = $user->ID;
        elseif ( is_object( $id_or_email ) && ! empty( $id_or_email->user_id ) )
            $user_id = (int) $id_or_email->user_id;
        if ( empty( $user_id ) )
            return $avatar;
        $local_avatars = get_user_meta( $user_id, 'cnpolitics_avatar', true );
 
        if ( empty( $local_avatars ) || empty( $local_avatars['relative'] ) )
            return $avatar;
        
        $size = (int) $size;
        if ( empty( $alt ) )
            $alt = get_the_author_meta( 'display_name', $user_id );
        // generate a new size
        if ( empty( $local_avatars[$size] ) ) {
            
            $upload_path = wp_upload_dir();
            $avatar_full_path = get_template_directory().$local_avatars['relative'];
            $image_sized = image_resize( $avatar_full_path, $size, $size, true ); 
            // deal with original being >= to original image (or lack of sizing ability)
            $local_avatars[$size] = is_wp_error($image_sized) ? $local_avatars['relative'] : str_replace( get_template_directory(), "", $image_sized );
            // save updated avatar sizes
            update_user_meta( $user_id, 'cnpolitics_avatar', $local_avatars );
        } 
        $avatar_full_path = get_template_directory_uri().$local_avatars[$size];
        $author_class = is_author( $user_id ) ? ' current-author' : '' ;
        $avatar = "<img alt='" . esc_attr( $alt ) . "' src='" . $avatar_full_path . "' class='avatar avatar-{$size}{$author_class} photo' height='{$size}' width='{$size}' />";
       
        remove_filter('upload_dir', array( $this, 'set_upload_dir') );
        return apply_filters( 'cnpolitics_avatar', $avatar );
    }

    public function admin_init() {
        //load_plugin_textdomain( 'simple-local-avatars', false, dirname( plugin_basename( __FILE__ ) ) . '/localization/' );
 
        register_setting( 'discussion', 'cnpolitics_avatars_caps', array( $this, 'sanitize_options' ) );
        add_settings_field( 'cnpolitics-avatars-caps', __('Local Avatar Permissions','cnpolitics-avatars'), array( $this, 'avatar_settings_field' ), 'discussion', 'avatars' );
    }
 
    public function sanitize_options( $input ) {
        $new_input['cnpolitics_avatars_caps'] = empty( $input['cnpolitics_avatars_caps'] ) ? 0 : 1;
        return $new_input;
    }
 
    public function avatar_settings_field( $args ) {       
        $options = get_option('cnpolitics_avatars_caps');
        echo '
            <label for="cnpolitics_avatars_caps">
                <input type="checkbox" name="cnpolitics_avatars_caps" id="cnpolitics_avatars_caps" value="1" ' . @checked( $options['cnpolitics_avatars_caps'], 1, false ) . ' />
                ' . __('仅具有头像上传权限的用户具有设置本地头像权限（作者及更高等级角色）。','cnpolitics-avatars') . '
            </label>
        ';
    }
 
    public function edit_user_profile( $profileuser ) {
    ?>
    <h3><?php _e( 'Extra profile information','cnpolitics-avatars' ); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="cnpolitics-avatar"><?php _e('Avatar','cnpolitics-avatars'); ?></label></th>
            <td style="width: 50px;" valign="top">
                <?php echo get_avatar( $profileuser->ID ); ?>
            </td>
            <td>
            <?php
                $options = get_option('cnpolitics_avatars_caps');
                if ( empty($options['cnpolitics_avatars_caps']) || current_user_can('upload_files') ) {
                    do_action( 'cnpolitics_avatar_notices' );
                    wp_nonce_field( 'cnpolitics_avatar_nonce', '_cnpolitics_avatar_nonce', false );
            ?>
                    <input type="file" name="cnpolitics-avatar" id="cnpolitics-avatar" /><br />
            <?php
                    if ( empty( $profileuser->cnpolitics_avatar ) )
                        echo '<span class="description">' . __('尚未设置本地头像，请点击“浏览”按钮上传本地头像。','cnpolitics-avatars') . '</span>';
                    else
                        echo '
                            <input type="checkbox" name="cnpolitics-avatar-erase" value="1" /> ' . __('移除本地头像','cnpolitics-avatars') . '<br />
                            <span class="description">' . __('如需要修改本地头像，请重新上传新头像。如需要移除本地头像，请选中上方的“移除本地头像”复选框并更新个人资料即可。<br/>移除本地头像后，将恢复使用 Gravatar 头像。','cnpolitics-avatars') . '</span>
                        ';     
                } else {
                    if ( empty( $profileuser->cnpolitics_avatar ) )
                        echo '<span class="description">' . __('尚未设置本地头像，请在 Gravatar.com 网站设置头像。','cnpolitics-avatars') . '</span>';
                    else
                        echo '<span class="description">' . __('你没有头像上传权限，如需要修改本地头像，请联系站点管理员。','cnpolitics-avatars') . '</span>';
                }
            ?>
            </td>
        </tr>
    </table>
    <script type="text/javascript">var form = document.getElementById('your-profile');form.encoding = 'multipart/form-data';form.setAttribute('enctype', 'multipart/form-data');</script>
    <?php       
    }

    public function edit_user_profile_update( $user_id ) {
        if ( ! isset( $_POST['_cnpolitics_avatar_nonce'] ) || ! wp_verify_nonce( $_POST['_cnpolitics_avatar_nonce'], 'cnpolitics_avatar_nonce' ) )            //security
            return;
        if ( ! empty( $_FILES['cnpolitics-avatar']['name'] ) ) {
            $mimes = array(
                'jpg|jpeg|jpe' => 'image/jpeg',
                'gif' => 'image/gif',
                'png' => 'image/png',
                'bmp' => 'image/bmp',
                'tif|tiff' => 'image/tiff'
            );
 
            // front end (theme my profile etc) support
            if ( ! function_exists( 'wp_handle_upload' ) )
                require_once( ABSPATH . 'wp-admin/includes/file.php' );
 
            $this->avatar_delete( $user_id );    // delete old images if successful
 
            // need to be more secure since low privelege users can upload
            if ( strstr( $_FILES['cnpolitics-avatar']['name'], '.php' ) )
                wp_die('For security reasons, the extension ".php" cannot be in your file name.');
 
            $this->user_id_being_edited = $user_id; // make user_id known to unique_filename_callback function
            
            // add file to folder
            add_filter('upload_dir', array( $this, 'set_upload_dir') );
            $avatar = wp_handle_upload( $_FILES['cnpolitics-avatar'], array( 'mimes' => $mimes, 'test_form' => false, 'unique_filename_callback' => array( $this, 'unique_filename_callback' ) ) );
            remove_filter('upload_dir', array( $this, 'set_upload_dir') );

            if ( empty($avatar['file']) ) {     // handle failures
                switch ( $avatar['error'] ) {
                    case 'File type does not meet security guidelines. Try another.' :
                        add_action( 'user_profile_update_errors', create_function('$a','$a->add("avatar_error",__("请上传有效的图片文件。","cnpolitics-avatars"));') );              
                        break;
                    default :
                        add_action( 'user_profile_update_errors', create_function('$a','$a->add("avatar_error","<strong>".__("上传头像过程中出现以下错误：","cnpolitics-avatars")."</strong> ' . esc_attr( $avatar['error'] ) . '");') );
                }
                return;
            }
            $avatar_rel_path = str_replace(get_template_directory_uri(), "", $avatar['url'] );
            update_user_meta( $user_id, 'cnpolitics_avatar', array( 'relative' => $avatar_rel_path ) );      // save user information (overwriting old)
        } elseif ( ! empty( $_POST['cnpolitics-avatar-erase'] ) ) {
            $this->avatar_delete( $user_id );
        }
    }
    /**
     * remove the custom get_avatar hook for the default avatar list output on options-discussion.php
     */
    public function avatar_defaults( $avatar_defaults ) {
        remove_action( 'get_avatar', array( $this, 'get_avatar' ) );
        return $avatar_defaults;
    }
 
    /**
     * delete avatars based on user_id
     */
    public function avatar_delete( $user_id ) {
        add_filter('upload_dir', array( $this, 'set_upload_dir') );

        $old_avatars = get_user_meta( $user_id, 'cnpolitics_avatar', true );
        // remove avatar from folder
        if ( is_array($old_avatars) ) {
            foreach ($old_avatars as $old_avatar ) {
                $old_avatar_path = get_template_directory() . $old_avatar;
                @unlink( $old_avatar_path );   
            }
        }

        delete_user_meta( $user_id, 'cnpolitics_avatar' );
        remove_filter('upload_dir', array( $this, 'set_upload_dir') );
    }

    public function unique_filename_callback( $dir, $name, $ext ) {
        $user = get_user_by( 'id', (int) $this->user_id_being_edited );
        $name = $base_name = sanitize_file_name( $user->user_login . '_avatar' );
        $number = 1;
        while ( file_exists( $dir . "/$name$ext" ) ) {
            $name = $base_name . '_' . $number;
            $number++;
        }

        return $name . $ext;
    }
    public function set_upload_dir($upload) {
        global $cnpolitics_theme_dir;
        global $cnpolitics_theme_uri;
        $upload['subdir'] = '/cnpoliticsers';
        $upload['basedir'] = $cnpolitics_theme_dir .'/upload';
        $upload['path']   = $upload['basedir'] . $upload['subdir'];
        $upload['baseurl'] = $cnpolitics_theme_uri . '/upload';
        $upload['url']    = $upload['baseurl'] . $upload['subdir'];
        return $upload;
    }
}

$simple_local_avatars = new Simple_Local_Avatars;

/**
 * more efficient to call simple local avatar directly in theme and avoid gravatar setup
 *
 * @param int|string|object $id_or_email A user ID,  email address, or comment object
 * @param int $size Size of the avatar image
 * @param string $default URL to a default image to use if no avatar is available
 * @param string $alt Alternate text to use in image tag. Defaults to blank
 * @return string <img> tag for the user's avatar
 */

function get_simple_local_avatar( $id_or_email, $size = '96', $default = '', $alt = false ) {
    global $simple_local_avatars;
    $avatar = $simple_local_avatars->get_avatar( '', $id_or_email, $size, $default, $alt );
    if ( empty ( $avatar ) )
        $avatar = get_avatar( $id_or_email, $size, $default, $alt );
    return $avatar;
}