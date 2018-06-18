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
$useragent=$_SERVER['HTTP_USER_AGENT'];
$is_mobile = false;
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))$is_mobile=true;
?>
<?php if($post_type=='post') :?>
<article <?php post_class("author-content pb-3"); ?> id="post-<?php the_ID(); ?>">


	<div class="entry-content container article">
			<?php if(!empty($id_video)) : ?>
			<?php 
				$muted = 0;
				$auto_play = 1;
				if($is_mobile){
					$muted = 1;
					$auto_play = 0;
				}
			?>
			<div class="pb-3">
				<div  class="embed-container">
						<iframe src="https://player.vimeo.com/video/<?php echo $id_video ?>?autoplay=<?php echo  $auto_play; ?>&title=0&byline=0&portrait=0&muted=<?php echo $muted  ?>"  allow="autoplay" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>							
							
				</div>
			</div>
			<?php 
				else:
					$featured_img_url = get_the_post_thumbnail_url(get_the_ID());
					$get_description = get_post(get_post_thumbnail_id())->post_excerpt;
					

					if($featured_img_url!=''):
						?>
						<div class="col col-12  m-0 p-0 text-center">
								<?php echo get_the_post_thumbnail( get_the_ID(), 'full'); ?>				
								<?php  
									if(!empty($get_description)){
										echo '<div class="featured_caption">' . $get_description . '</div>';
									} 
								?>				
							</div>
						<?php
					endif;
			?>

			<?php endif;?>
			<h1 class="pt-3 pb-3"><?php the_title();?></h1>
			<?php the_content(); ?>
		</div>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
<?php echo do_shortcode( '[widget id="dpe_fp_widget-2"]' ); ?>

<?php elseif($post_type=='teams') :?>
<article <?php post_class("author-content pb-3"); ?> id="post-<?php the_ID(); ?>">


	<div class="entry-content container article">
			<div class="row bg-white m-0 mb-4">
				<div class="col col-12 col-md-4 m-0 p-0 text-center">
				<?php
								$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
								
							?>
							<img src="<?php echo $featured_img_url;?>" alt="<?php the_title(); ?>" >
				</div>
				<div class="col col-12 col-md-8">
					<h1 class="pt-3 pb-3"><?php the_title();?></h1>
					<!-- <h3><?php //echo $GLOBALS['cgv']['position']?></h3> -->
					<h3><?php echo get_field( "job_title", get_the_ID() );?></h3>
					<?php echo get_field( "position", get_the_ID() );?>
				</div>
			</div>
			<div class="row">
				<div class="col col-12"><?php the_content(); ?></div>
			</div>
			
			
		</div>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
<?php echo do_shortcode( '[widget id="dpe_fp_widget-4"]' ); ?>
<?php endif;?>