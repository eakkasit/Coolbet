<?php 
$count =$alm_post_count;
$i = $alm_loop_count;

?>
<?php echo $rowCount==0?'<div class="row">':''; ?>
<div class="mb-4 col-sm-12 col-md-<?php echo $bootstrapColWidth; ?>">
<div class="page-content-detail">
										<div class="cover">
										<a class="video" href="<?php echo the_permalink(); ?>">
											<?php
												$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');								
											?>
											<img src="<?php echo $featured_img_url;?>" alt="<?php the_title(); ?>" >
										</a>
										</div>
										<div class="title-content">
										<h3><a href="<?php echo the_permalink() ?>"><?php the_title(); ?></a></h3>
										<p>
											<?php 
												echo excerpt(25);
											?>

										</p>
										</div>
										<div class="row">
											<div class="col-md-12 readmore-content">
												<a class="btn btn-secondary btn-readmore-black" href="<?php echo the_permalink(); ?>"><?php esc_html_e( 'Read more', 'understrap' ); ?> <span><img class="img-fluid" src="<?php echo get_stylesheet_directory_uri(); ?>/images/readmore_small.png"></span></a>
											</div>
										</div>	
										<?php ?>
									</div>
</div>
<?php
        $rowCount++;
        if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
    ?>
    <?php echo $rowCount==0?'</div>':''; ?>