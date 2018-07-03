<?php 
global $detect; $detect = new Mobile_Detect;
$count =$alm_post_count;
$i = $alm_loop_count;

if( $detect->isMobile() && !$detect->isTablet() ){
    $featured_img_url= get_the_post_thumbnail_url(get_the_ID(),'mobile-profile');
}else if( $detect->isTablet() ){
    $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'ipad-profile');
}else{
    $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'pc-profile');
}
$title = get_post(get_post_thumbnail_id())->post_title; //The Title
?>
<div class="row m-0 mb-3 bg-white">
  <div class="m-0 p-0 col-md-12">
            <?php 
                $title = get_the_title(get_the_ID()); 
                $post_type = get_post_type( get_the_ID() );
                $link = get_permalink(get_the_ID() ); 
            ?>
          
                <div class="row m-0" >
                    <div class="col-xs-12 col-sm-12 col-md-2 pl-0 pr-3">
                        <div class="meta-img">
                            <div class="entry-thumbnail">
                                <a href="<?php echo $link; ?>">
                                <img alt="<?php echo $title; ?>"  class="profile" src="<?php echo $featured_img_url;?>" />
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-10 p-0 pt-2 pb-2">
                    <a href="<?php echo  $link; ?>" rel="bookmark" title="<?php $title ; ?>"> <h3 class="m-0"> <span><?php echo $title; ?></span> </h3></a>
                        <p class="pt-2 pr-2 m-0"><?php echo  wp_trim_words( get_the_content(), $num_words =110, $more = '… ' );?></p>
                    </div>
                </div>
                </div>
            </div>