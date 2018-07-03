<?php 

$count =$alm_post_count;
$i = $alm_loop_count;

$post_type = get_post_type( get_the_ID() );
$title = get_post(get_post_thumbnail_id())->post_title; //The Title
?>
<?php if($i==1) : ?>
<div class="row box-content mr-0 ml-0">
<?php endif;?>    
<?php if($i==1) : ?>
   
<div class="col-xs-12 col-sm-12 col-md-6 p-0 c-pr-5 mb-10">
        <a href="<?php echo esc_url( get_permalink() ); ?>">
            <div class="img-m right"><?php echo $post_type=='video'?'<span class="play-btn"></span>':'';?>
            <picture>
						<source media="(min-width: 394px)" srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(),'ipad-large');?>">
						<source media="(min-width: 320px)" srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(),'mobile-large');?>">
						<img alt="<?php echo $title; ?>"  src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'pc-large');?>" >
					</picture>
        </div>
            <div class="title-m right fontautosize">
                <span>
            <?php 
                $yoast_title = get_post_meta($post->ID, '_yoast_wpseo_title', true);                 $trimtitle = $yoast_title;                 if (empty($trimtitle)) {                     $trimtitle = get_the_title($post->ID);                 }
                $shorttitle = wp_trim_words( $trimtitle, $num_words =10, $more = '… ' );
                echo $trimtitle
                ?>
                </span>
            </div>
        </a>
    </div>
<?php endif;?>    
<?php if($i==2) : ?>  
<div class="col-xs-12 col-sm-12 col-md-6 p-0 c-pl-5 mb-10">
        <a href="<?php echo esc_url( get_permalink() ); ?>">
            <div class="img-m left"><?php echo $post_type=='video'?'<span class="play-btn"></span>':'';?>
            <picture>
						<source media="(min-width: 394px)" srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(),'ipad-large');?>">
						<source media="(min-width: 320px)" srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(),'mobile-large');?>">
						<img alt="<?php echo $title; ?>"  src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'pc-large');?>" >
					</picture>
        </div>
            <div class="title-m left fontautosize">
            <span>
            <?php 
                $yoast_title = get_post_meta($post->ID, '_yoast_wpseo_title', true);                 $trimtitle = $yoast_title;                 if (empty($trimtitle)) {                     $trimtitle = get_the_title($post->ID);                 }
                $shorttitle = wp_trim_words( $trimtitle, $num_words = 10, $more = '… ' );
                echo $trimtitle
                ?>
                </span>
            </div>
        </a>
    </div>
<?php endif;?>        
<?php if($i==2) : ?>
</div>
<?php endif;?>

<?php if($i==1 && $count==$i) :?>
</div>
<?php endif;?>

<?php if($i==3) : ?>
<div class="row box-content mr-0 ml-0">
<?php endif;?>    
<?php if($i==3) : ?>
    <div class="col-xs-12 col-sm-12 col-md-6 p-0 c-pr-5 mb-10">
        <a href="<?php echo esc_url( get_permalink() ); ?>">
            <div class="img-m"><?php echo $post_type=='video'?'<span class="play-btn"></span>':'';?>
        
            <picture>
						<source media="(min-width: 394px)" srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(),'ipad-large');?>">
						<source media="(min-width: 320px)" srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(),'mobile-large');?>">
						<img alt="<?php echo $title; ?>"  src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'pc-large');?>" >
                    </picture>
                </div>
            <div class="title-m fontautosize">
            <span>
            <?php 
                $yoast_title = get_post_meta($post->ID, '_yoast_wpseo_title', true);                 $trimtitle = $yoast_title;                 if (empty($trimtitle)) {                     $trimtitle = get_the_title($post->ID);                 }
                $shorttitle = wp_trim_words( $trimtitle, $num_words = 10, $more = '… ' );
                echo $trimtitle
                ?>
                </span>
            </div>
        </a>
    </div>
<?php endif;?>    
<?php if($i==4) : ?>  
    <div class="col-xs-12 col-sm-12 col-md-6 p-0 c-pl-5 mb-10">
        <a href="<?php echo esc_url( get_permalink() ); ?>">
            <div class="img-m"><?php echo $post_type=='video'?'<span class="play-btn"></span>':'';?>
            <picture>
						<source media="(min-width: 394px)" srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(),'ipad-large');?>">
						<source media="(min-width: 320px)" srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(),'mobile-large');?>">
						<img alt="<?php echo $title; ?>"  src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'pc-large');?>" >
					</picture>
        </div>
            <div class="title-m fontautosize">
            <span>
            <?php 
                $yoast_title = get_post_meta($post->ID, '_yoast_wpseo_title', true);                 $trimtitle = $yoast_title;                 if (empty($trimtitle)) {                     $trimtitle = get_the_title($post->ID);                 }
                $shorttitle = wp_trim_words( $trimtitle, $num_words =10, $more = '… ' );
                echo $trimtitle
                ?>
                </span>
            </div>
        </a>
    </div>
<?php endif;?>        
<?php if($i==4) : ?>
</div>
<?php endif;?>

<?php if($i==3 && $count==$i) :?>
</div>
<?php endif;?>

<?php if($i==5) : ?>
<div class="row box-content mr-0 ml-0">
<?php endif;?>    
<?php if($i==5) : ?>
    <div class="col-xs-12 col-sm-12 col-md-4 p-0 pr-2 mb-10">
        <a href="<?php echo esc_url( get_permalink() ); ?>">
            <div class="img-s left"><?php echo $post_type=='video'?'<span class="play-btn"></span>':'';?>
            <picture>
						<source media="(min-width: 394px)" srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(),'ipad-large');?>">
						<source media="(min-width: 320px)" srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(),'mobile-large');?>">
						<img alt="<?php echo $title; ?>"  src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'pc-large');?>" >
					</picture>
        </div>
            <div class="title-s left fontautosize">
            <span>
            <?php 
                $yoast_title = get_post_meta($post->ID, '_yoast_wpseo_title', true);                 $trimtitle = $yoast_title;                 if (empty($trimtitle)) {                     $trimtitle = get_the_title($post->ID);                 }
                $shorttitle = wp_trim_words( $trimtitle, $num_words =8, $more = '… ' );
                echo $trimtitle
                ?>
                </span>
            </div>
        </a>
    </div>
<?php endif;?>  
<?php if($i==6) : ?>  
    <div class="col-xs-12 col-sm-12 col-md-4 p-0 pr-1 pl-1 mb-10">
        <a href="<?php echo esc_url( get_permalink() ); ?>">
            <div class="img-s left"><?php echo $post_type=='video'?'<span class="play-btn"></span>':'';?>
            <picture>
						<source media="(min-width: 394px)" srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(),'ipad-large');?>">
						<source media="(min-width: 320px)" srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(),'mobile-large');?>">
						<img alt="<?php echo $title; ?>"  src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'pc-large');?>" >
					</picture>
        </div>
            <div class="title-s left fontautosize">
            <span>
            <?php 
                $yoast_title = get_post_meta($post->ID, '_yoast_wpseo_title', true);                 $trimtitle = $yoast_title;                 if (empty($trimtitle)) {                     $trimtitle = get_the_title($post->ID);                 }
                $shorttitle = wp_trim_words( $trimtitle, $num_words = 8, $more = '… ' );
                echo $trimtitle
                ?>
                </span>
            </div>
        </a>
    </div>
<?php endif;?>   
<?php if($i==7) : ?>  
    <div class="col-xs-12 col-sm-12 col-md-4 p-0 pl-2">
        <a href="<?php echo esc_url( get_permalink() ); ?>">
            <div class="img-s left"><?php echo $post_type=='video'?'<span class="play-btn"></span>':'';?>
            <picture>
						<source media="(min-width: 394px)" srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(),'ipad-large');?>">
						<source media="(min-width: 320px)" srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(),'mobile-large');?>">
						<img alt="<?php echo $title; ?>"  src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'pc-large');?>" >
					</picture>
        </div>
            <div class="title-s left fontautosize">
            <span>
            <?php 
                $yoast_title = get_post_meta($post->ID, '_yoast_wpseo_title', true);                 $trimtitle = $yoast_title;                 if (empty($trimtitle)) {                     $trimtitle = get_the_title($post->ID);                 }
                $shorttitle = wp_trim_words( $trimtitle, $num_words = 8, $more = '… ' );
                echo $trimtitle
                ?>
                </span>
            </div>
        </a>
    </div>
<?php endif;?>    
<?php if($i==7) : ?>    
</div>
<?php endif;?>

<?php if($i==5 && $count==$i || $i==6 && $count==$i) :?>
</div>
<?php endif;?>


<?php if($i==8) : ?>
<div class="row box-content mr-0 ml-0">
    <div class="col p-0">
        <a href="<?php echo esc_url( get_permalink() ); ?>">
            <div class="img-l">

            <picture>
						<source media="(min-width: 394px)" srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(),'ipad-large');?>">
						<source media="(min-width: 320px)" srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(),'mobile-large');?>">
						<img alt="<?php echo $title; ?>"  src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'pc-large');?>" >
					</picture>
            </div>
            <div class="title-l fontautosize">
                <span>
                <?php 
                $yoast_title = get_post_meta($post->ID, '_yoast_wpseo_title', true);                 $trimtitle = $yoast_title;                 if (empty($trimtitle)) {                     $trimtitle = get_the_title($post->ID);                 }
                //$shorttitle = wp_trim_words( $trimtitle, $num_words = 11, $more = '… ' );
                echo $trimtitle
                ?>
                 </span>
            </div>
        </a>
    </div>
</div>
<?php endif;?>

<?php if($i==9) : ?>
<div class="row box-content mr-0 ml-0">
<?php endif;?>    
<?php if($i==9) : ?>
    <div class="col-xs-12 col-sm-12 col-md-6 p-0 c-pr-5 mb-10">
        <a href="<?php echo esc_url( get_permalink() ); ?>">
            <div class="img-m left">
            <picture>
						<source media="(min-width: 394px)" srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(),'ipad-large');?>">
						<source media="(min-width: 320px)" srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(),'mobile-large');?>">
						<img alt="<?php echo $title; ?>"  src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'pc-large');?>" >
					</picture>
            </div>
            <div class="title-m left fontautosize">
            <span>
            <?php 
                $yoast_title = get_post_meta($post->ID, '_yoast_wpseo_title', true);                 $trimtitle = $yoast_title;                 if (empty($trimtitle)) {                     $trimtitle = get_the_title($post->ID);                 }
                //$shorttitle = wp_trim_words( $trimtitle, $num_words = 8, $more = '… ' );
                echo $trimtitle
                ?>
                 </span>
            </div>
        </a>
    </div>
<?php endif;?>    
<?php if($i==10) : ?>  
    <div class="col-xs-12 col-sm-12 col-md-6 p-0 c-pl-5 mb-10">
        <a href="<?php echo esc_url( get_permalink() ); ?>">
            <div class="img-m right">
            <picture>
						<source media="(min-width: 394px)" srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(),'ipad-large');?>">
						<source media="(min-width: 320px)" srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(),'mobile-large');?>">
						<img alt="<?php echo $title; ?>"  src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'pc-large');?>" >
					</picture>
            </div>
            <div class="title-m right fontautosize">
            <span>
            <?php 
                $yoast_title = get_post_meta($post->ID, '_yoast_wpseo_title', true);                 $trimtitle = $yoast_title;                 if (empty($trimtitle)) {                     $trimtitle = get_the_title($post->ID);                 }
                //$shorttitle = wp_trim_words( $trimtitle, $num_words =10, $more = '… ' );
                echo $trimtitle
                ?>
                 </span>
            </div>
        </a>
    </div>
<?php endif;?>        
<?php if($i==10) : ?>
</div>
<?php if($i==9 && $count==$i) :?>
</div>
<?php endif;?>

<?php endif;?>