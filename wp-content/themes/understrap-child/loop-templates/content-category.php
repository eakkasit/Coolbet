<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */
$id = get_the_ID();
$video_data = get_post_meta($id,'');
$data_ex = explode('/',$video_data['_meta_info'][0]);
$id_video = end($data_ex);
$post_type = get_post_type(get_the_ID());
?>
<?php 
	$categories = get_the_category();
	if($categories[0]->slug == 'episoder'){
		echo do_shortcode( '[widget id="dpe_fp_widget-2"]' );
	}else if($categories[0]->slug== 'bookmakerne'){
		echo do_shortcode( '[widget id="dpe_fp_widget-4"]' );
	}else{
	}
?>