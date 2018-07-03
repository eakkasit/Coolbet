<div <?php post_class('mb-4 col-sm-12 m-0 p-0 col-md-12'); ?>>	
					<div class="content-feture-image">
						<div class="container">
							<div class="row">
								<div class="col-md-12 readmore-content">
									<div class="cover-full" >
										<?php
											$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');		
											$video_embed  = get_field( "video_link",  get_the_ID()  );
											$alt = get_post(get_post_thumbnail_id())->post_title; //The Title						
										?>
										<?php if(!empty($video_embed)) : ?>
											<div class="resp-container">
												<?php echo $video_embed?>
											</div>
										<?php else : ?>
											<?php echo get_the_post_thumbnail( $post->ID, 'full',array('alt'=>$alt) ); ?>
										<?php endif;?>
									</div>
								</div>
							</div>
						</div>
					</div>	
					<div class="content-data-page mt-4">
						<div class="container">
							<div class="row">			
								<div class="col-md-12">
									<div class="title-content">
										<h3><a href="<?php echo the_permalink() ?>"><?php the_title(); ?></a></h3>
										<span>
												<?php
													$post_date = get_the_date( 'M d,Y' ); 
													echo $post_date; 
												?>
											</span>
									</div>	
								</div>					
							</div>
							<div  class="row">
								<div class="col-md-12">
									<div class="content-excerpt">
										<p>
											<?php 
												$excerpt_content =  get_the_excerpt() ;
												echo  str_replace('[...]','',$excerpt_content);
											?>
										</p>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 text-right">
									<a class="btn btn-secondary btn-readmore" href="<?php echo the_permalink(); ?>"><?php esc_html_e( 'Read more', 'understrap' ); ?> <span><img class="img-fluid" src="<?php echo get_stylesheet_directory_uri(); ?>/images/readmore_small.png"></span></a>
								</div>
							</div>						
								
								
						</div>
					</div>		
				</div>