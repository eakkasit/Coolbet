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
    wp_enqueue_style( 'child-styles', get_stylesheet_directory_uri() . '/style.css', array(), '6-06-2018-13-24' );
    wp_enqueue_style( 'lightslider-styles', get_stylesheet_directory_uri() . '/css/lightslider.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'fastclick', get_stylesheet_directory_uri() . '/js/fastclick.js' );
    wp_enqueue_script( 'matchHeight', get_stylesheet_directory_uri() . '/js/jquery.matchHeight.js' );
    wp_enqueue_script( 'hammer', get_stylesheet_directory_uri() . '/js/hammer.min.js' );
	wp_enqueue_script( 'popper-scripts', get_template_directory_uri() . '/js/popper.min.js', array(), false);
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.js', array(), $the_theme->get( 'Version' ), true );
    wp_enqueue_script( 'custom-javascript-scripts', get_stylesheet_directory_uri() . '/src/js/custom-javascript.js', array(), $the_theme->get( 'Version' ), true );
    wp_enqueue_script( 'lightslider-scripts', get_stylesheet_directory_uri() . '/js/lightslider.js', array(), $the_theme->get( 'Version' ), true );
    wp_enqueue_script( 'vimeo-scripts', 'https://player.vimeo.com/api/player.js', array(), $the_theme->get( 'Version' ), true );
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
          if($_POST['_meta_info'] != ''){
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
                }
                update_post_meta( $post_id, '_meta_info', $_POST['_meta_info'] );
          }
        
      }
  } 

}

/**
 * Register meta box(es).
 */
function coming_soon_register_meta_boxes() {
    add_meta_box( 'meta-box-id', __( 'Coming soon', 'textdomain' ), 'coming_soon_my_display_callback', 'post' ,'side','low' );
}
add_action( 'add_meta_boxes', 'coming_soon_register_meta_boxes' );
 
/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function coming_soon_my_display_callback( $post ) {
    wp_nonce_field( plugin_basename( __FILE__ ), $post->post_type . '_noncename' );
    $coming_soon = get_post_meta( $post->ID, '_coming_soon', true) ? get_post_meta( $post->ID, '_coming_soon', true) : ''; ?>
    <h2><?php// _e( 'Meta Information' ); ?></h2>
    <div class="alignleft">
    <label class="selectit">
        <input value="1" type="checkbox" name="_coming_soon" id="coming-soon" <?php echo $coming_soon==1?'checked':''; ?>> Yes
    </label>        
    </div>
	<div class="alignright">	
	</div>
    <div class="clear"></div>
    <hr /><?php
}
 
/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function coming_soon_save_meta_box( $post_id ) {
    // Save logic goes here. Don't forget to include nonce checks!
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;

    if ( !wp_verify_nonce( @$_POST[$_POST['post_type'] . '_noncename'], plugin_basename( __FILE__ ) ) )
      return;

  // Check permissions
     if ( !current_user_can( 'edit_post', $post_id ) )
     return;
    update_post_meta( $post_id, '_coming_soon', $_POST['_coming_soon'] );
}
add_action( 'save_post', 'coming_soon_save_meta_box' );


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
            'instagram'     => esc_html__('Instagram', 'totoitnews'),
            'youtube'     => esc_html__('Youtube', 'totoitnews'),
		);
        totoit_register_sections($wp_customize,$panel,$panel,null,117);
        
		foreach($socials as $key => $value){
			totoit_register_setting($wp_customize, $value.'_social','');
			totoit_register_control($wp_customize,$panel,$value.'_social',null,$value,'text');
		}
	}
}
add_action( 'customize_register', 'totoitnews_socials_customize_register' );

add_action( 'wp_default_scripts', function( $scripts ) {
    if ( ! empty( $scripts->registered['jquery'] ) ) {
        $scripts->registered['jquery']->deps = array_diff( $scripts->registered['jquery']->deps, array( 'jquery-migrate' ) );
    }
} );



function remove_watch_slug( $post_link, $post, $leavename ) {
	
    if ( 'teams' != $post->post_type) {
      return $post_link;
    }
  
    $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
  
    return $post_link;
  }
  add_filter( 'post_type_link', 'remove_watch_slug', 10, 3 );
  
  function change_slug_struct( $query ) {
    if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
     $query->set( 'post_type', array(
      'post', 'page', 'nav_menu_item', 'teams'
       ));
     return $query;
     }
     if ( ! empty( $query->query['name'] ) ) {
         $query->set( 'post_type', array( 'post', 'page' , 'nav_menu_item', 'teams') );
     }
  }
  add_action( 'pre_get_posts', 'change_slug_struct' );


function excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt)>=$limit) {
      array_pop($excerpt);
      $excerpt = implode(" ",$excerpt).'...';
    } else {
      $excerpt = implode(" ",$excerpt);
    }	
    $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
    $excerpt = str_replace('[...]','',$excerpt);
    return $excerpt;
  }
   
  function content($limit) {
    $content = explode(' ', get_the_content(), $limit);
    if (count($content)>=$limit) {
      array_pop($content);
      $content = implode(" ",$content).'...';
    } else {
      $content = implode(" ",$content);
    }	
    $content = preg_replace('/[.+]/','', $content);
    $content = apply_filters('the_content', $content); 
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
  }