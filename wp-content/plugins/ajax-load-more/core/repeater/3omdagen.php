<?php 
$count =$alm_post_count;
$i = $alm_loop_count;
$post_type = get_post_type( get_the_ID() );
    $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
?>
<?php echo $rowCount==0?'<div class="row omcat m-0">':''; ?>
<div class="m-0 p-0 col-md-<?php echo $bootstrapColWidth; ?>">
            <?php 
                $title = get_the_title(get_the_ID()); 
                $post_type = get_post_type( get_the_ID() );
                $link = get_permalink(get_the_ID() ); 
                $date = get_the_date('l d. F',get_the_ID());
                $wpom_title_one = get_post_meta(get_the_ID(), 'wpom_title_one', true);
                $wpom_title_two = get_post_meta(get_the_ID(), 'wpom_title_two', true);
                $wpom_title_three = get_post_meta(get_the_ID(), 'wpom_title_three', true);
            ?>
            <a href="<?php echo  $link; ?>" rel="bookmark" title="<?php $title ; ?>">
                <div class="omcatcontent" >
                    <div class="title"><span><?php echo $title; ?></span></div>
                    <div class="datetime"><?php echo  $date; ?></div>
                    <ul>
                        <?php if($wpom_title_one!='') : ?>
                            <li><span><?php echo $wpom_title_one;?></span></li>
                        <?php endif;?>
                        <?php if($wpom_title_two!='') : ?>
                            <li><span><?php echo $wpom_title_two;?></span></li>
                        <?php endif;?>
                        <?php if($wpom_title_three!='') : ?>
                            <li><span><?php echo $wpom_title_three;?></span></li>
                        <?php endif;?>
                    </ul>
                </div>
            </a>
</div>
<?php
        $rowCount++;
        if($rowCount % $numOfCols == 0) echo '</div><div class="row omcat m-0">';
    ?>
    <?php echo $rowCount==0?'</div>':''; ?>