<?php
function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_style( 'child-styles', get_stylesheet_directory_uri() . '/style.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_style( 'lightslider-styles', get_stylesheet_directory_uri() . '/css/lightslider.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'jquery');
	wp_enqueue_script( 'popper-scripts', get_template_directory_uri() . '/js/popper.min.js', array(), false);
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
    wp_enqueue_script( 'lightslider-scripts', get_stylesheet_directory_uri() . '/js/lightslider.js', array(), $the_theme->get( 'Version' ), true );
    wp_enqueue_script( 'slider-scripts', get_stylesheet_directory_uri() . '/js/slider.js', array(), $the_theme->get( 'Version' ), true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}


function atg_menu_classes($classes, $item, $args) {
    if($args->theme_location == 'footer') {
      $classes[] = 'col col-12 col-md-3 p-2 p-md-0 text-center';
    }
    return $classes;
  }
  add_filter('nav_menu_css_class','atg_menu_classes',1,3);



/* Define the custom box */

// WP 3.0+
add_action( 'add_meta_boxes', 'post_options_metabox' );

// backwards compatible
add_action( 'admin_init', 'post_options_metabox', 1 );

/* Do something with the data entered */
add_action( 'save_post', 'save_post_options' );

/**
 *  Adds a box to the main column on the Post edit screen
 * 
 */
function post_options_metabox() {
    add_meta_box( 'post_options', __( 'Video ' ), 'post_options_code', 'post', 'normal', 'high' );
}

/**
 *  Prints the box content
 */
function post_options_code( $post ) { 
    wp_nonce_field( plugin_basename( __FILE__ ), $post->post_type . '_noncename' );
    $meta_info = get_post_meta( $post->ID, '_meta_info', true) ? get_post_meta( $post->ID, '_meta_info', true) : ''; ?>
    <h2><?php// _e( 'Meta Information' ); ?></h2>
    <div class="alignleft">
        URL
		<input id="meta_default" width="450px" type="text" name="_meta_info" value="<?php echo $meta_info ?>" />        
    </div>
	<div class="alignright">
	
	</div>
    <div class="clear"></div>
    <hr /><?php
}

/** 
 * When the post is saved, saves our custom data 
 */
function save_post_options( $post_id ) {
	// echo "post id". $post_id;
  // verify if this is an auto save routine. 
  // If it is our form has not been submitted, so we dont want to do anything
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times
  if ( !wp_verify_nonce( @$_POST[$_POST['post_type'] . '_noncename'], plugin_basename( __FILE__ ) ) )
      return;

  // Check permissions
  if ( !current_user_can( 'edit_post', $post_id ) )
     return;

  // OK, we're authenticated: we need to find and save the data
  if( 'post' == $_POST['post_type'] ) {
      if ( !current_user_can( 'edit_post', $post_id ) ) {
          return;
      } else {
          
        //$post_id = wp_insert_post( $my_post );
        
        //$vimeo = 'http://vimeo.com/12083674';
        $arr = get_vimeo_thumb($_POST['_meta_info']);
        foreach($arr[0] as $key => $data){
            $name_ex = explode("_",$key);
            if($name_ex[0] == 'thumbnail'){
                if($name_ex[1] == 'large'){
                    Generate_Featured_Image($post_id,$data,'1');
                }else{
                    Generate_Featured_Image($post_id,$data,'');
                }
            }
            //print_r($name_ex);
        }
        // echo "<pre>";
        // print_r($arr);
        // echo "</pre>";
        // die();
        // return false;


        // die();
        update_post_meta( $post_id, '_meta_info', $_POST['_meta_info'] );
      }
  } 

}


function get_vimeo_thumb($vimeo)
{    
    $parts = explode("/", $vimeo);
    $imgid = end($parts);
    $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php"));
    return $hash;
}



function Generate_Featured_Image(  $post_id, $image_url,$active){
    if(!has_post_thumbnail($post_id)) { 
    
        $upload_dir = wp_upload_dir();
        $image_data = file_get_contents($image_url);
        $filename = basename($image_url.'.jpg');
        if(wp_mkdir_p($upload_dir['path']))     $file = $upload_dir['path'] . '/' . $filename;
        else                                    $file = $upload_dir['basedir'] . '/' . $filename;
        file_put_contents($file, $image_data);
        
        if($active != ''){
            $wp_filetype = wp_check_filetype($filename, null );
            $attachment = array(
                'post_mime_type' => $wp_filetype['type'],
                'post_title' => sanitize_file_name($filename),
                'post_content' => '',
                'post_status' => 'inherit'
            );
            $attach_id = wp_insert_attachment( $attachment, $file, $post_id );
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
            $res1= wp_update_attachment_metadata( $attach_id, $attach_data );
            $res2= set_post_thumbnail( $post_id, $attach_id );
        }
        
    }
}


/**
 * Totoitnews Theme Customizer for social
 *
 * @package totoitnews
 */

if ( ! function_exists( 'totoitnews_socials_customize_register' ) ) {
	/**
	 * Register font customizer support.
	 *
	 * @param object $wp_customize Customizer reference.
	 */
    function totoit_register_sections($wp_customize,$key,$value,$panel,$priority=50){
		$wp_customize->add_section($key , array(
			'title'      => $value,
			'panel'		=> $panel,
			'priority'    => $priority,
		) );
	}

	function totoit_register_setting($wp_customize,$key,$default){
		$wp_customize->add_setting( $key , array(
			'default'     => $default,
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
		) );
	}

	function totoit_register_control($wp_customize,$section,$settings,$choices,$label,$type='text'){

		switch ($type) {
			case 'text':
				$wp_customize->add_control( new WP_Customize_Control( 
					$wp_customize, 
					$settings,
					array(
						'label'      => __( $label, 'totoitnews' ),
						'section'    => $section,
						'settings'   =>$settings,
					)
				));
				break;
			case 'select':
				$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $settings, array(
					'label'        => $label,
					'section'    => $section,
					'settings'   => $settings,
					'type'        => 'select',
					'sanitize_callback' => 'totoitnews_theme_slug_sanitize_select',
					'choices'     =>$choices,
				) ) );
				break;
		}

		
    }
    
	function totoitnews_socials_customize_register( $wp_customize ) {
		$panel = 'Socials';
	

		$socials = array(
			'facebook'      => esc_html__('Facebook', 'totoitnews'),
			'twitter'       => esc_html__('Twitter', 'totoitnews'),
			'linkedin'      => esc_html__('Linkedin', 'totoitnews'),
			'instagram'     => esc_html__('Instagram', 'totoitnews')
		);
        totoit_register_sections($wp_customize,$panel,$panel,null,117);
        
		foreach($socials as $key => $value){
			totoit_register_setting($wp_customize, $value.'_social','');
			totoit_register_control($wp_customize,$panel,$value.'_social',null,$value,'text');
		}
	}
}
add_action( 'customize_register', 'totoitnews_socials_customize_register' );