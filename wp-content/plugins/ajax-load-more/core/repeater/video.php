<?php 
$count =$alm_post_count;
$i = $alm_loop_count;
$coming_soon  = get_post_meta(get_the_ID(), '_coming_soon', true);
$play_button = get_post_meta(get_the_ID(), 'play_button', true);
$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
?>
<?php echo $rowCount==0?'<div class="row">':''; ?>
<div class="mb-4 col-sm-12 col-md-<?php echo $bootstrapColWidth; ?>">
    <div class="cover">
		<?php if ( ! empty ( $coming_soon ) ): ?>
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/coming_soon.gif" alt="<?php the_title(); ?>" >
		<?php else: ?>
			<a class="video<?php echo (!empty($play_button))?'-play':''; ?>" href="<?php echo the_permalink(); ?>">
        <?php if($featured_img_url) : ?>
             <img src="<?php echo $featured_img_url;?>" alt="<?php the_title(); ?>" >
        <?php else : ?>
             <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/no-picture.jpg" alt="<?php the_title(); ?>" >
        <?php endif;?>
			</a>
		<?php endif; ?>
	</div>
	<div class="title-content">
		<?php if ( ! empty ( $coming_soon ) ):  ?>
			<h3><?php the_title(); ?></h3>
		<?php else: ?>
			<a href="<?php echo the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>							
		<?php endif; ?>
	</div>
</div>
				
<?php
        $rowCount++;
        if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
    ?>
    <?php echo $rowCount==0?'</div>':''; ?>