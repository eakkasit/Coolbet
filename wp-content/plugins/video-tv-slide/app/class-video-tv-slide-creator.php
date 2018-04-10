<?php

class Video_TV_Slide_Creator {

	private $parent_view, $list_table;
	
	function __construct($parent) {
		
		$this->parent_view = $parent;
	}
	
	function render( $id, $config ) {
		
		?>
		
		<?php 
		$config = str_replace("<", "&lt;", $config);
		$config = str_replace(">", "&gt;", $config);
		$config = str_replace("&quot;", "", $config);
		?>
		
		<h3><?php _e( 'General Options', 'video_tv_slide' ); ?></h3>
		
		<div id="video-tv-slide-id" style="display:none;"><?php echo $id; ?></div>
		<div id="video-tv-slide-id-config" style="display:none;"><?php echo $config; ?></div>
		<div id="video-tv-slide-pluginfolder" style="display:none;"><?php echo WONDERPLUGIN_GALLERY_URL; ?></div>
		<div id="video-tv-slide-jsfolder" style="display:none;"><?php echo WONDERPLUGIN_GALLERY_URL . 'engine/'; ?></div>
		<div id="video-tv-slide-viewadminurl" style="display:none;"><?php echo admin_url('admin.php?page=video_tv_slide_show_item'); ?></div>		
		<div id="video-tv-slide-wp-history-media-uploader" style="display:none;"><?php echo ( function_exists("wp_enqueue_media") ? "0" : "1"); ?></div>
		<div id="video-tv-slide-ajaxnonce" style="display:none;"><?php echo wp_create_nonce( 'video-tv-slide-ajaxnonce' ); ?></div>
		<div id="video-tv-slide-saveformnonce" style="display:none;"><?php wp_nonce_field('video-tv-slide', 'video-tv-slide-saveform'); ?></div>
		<?php 
			$cats = get_categories();
			$catlist = array();
			foreach ( $cats as $cat )
			{
				$catlist[] = array(
						'ID' => $cat->cat_ID,
						'cat_name' => $cat ->cat_name
				);
			}
		?>
		<div id="video-tv-slide-catlist" style="display:none;"><?php echo json_encode($catlist); ?></div>
		
		<?php 
			$folderlist = videotvslide_dirtoarray(get_home_path(), false);
		?>
		<div id="video-tv-slide-folderlist" style="display:none;"><?php echo json_encode($folderlist); ?></div>
		<div id="video-tv-slide-folderseperator" style="display:none;"><?php echo DIRECTORY_SEPARATOR; ?></div>
		
		<div style="margin:0 12px;">
		<table class="wonderplugin-form-table">
			<tr>
				<th><?php _e( 'Name', 'video_tv_slide' ); ?></th>
				<td><input name="video-tv-slide-name" type="text" id="video-tv-slide-name" value="My Gallery" class="regular-text" /></td>
			</tr>
			<tr>
				<th><?php _e( 'Width', 'video_tv_slide' ); ?> / <?php _e( 'Height', 'video_tv_slide' ); ?></th>
				<td><input name="video-tv-slide-width" type="text" id="video-tv-slide-width" value="640" class="small-text" /> / <input name="video-tv-slide-height" type="text" id="video-tv-slide-height" value="360" class="small-text" /></td>
			</tr>
		</table>
		</div>
		
		<h3><?php _e( 'Designing', 'video_tv_slide' ); ?></h3>
		
		<div style="margin:0 12px;">
		<ul class="wonderplugin-tab-buttons" id="video-tv-slide-toolbar">
			<li class="wonderplugin-tab-button step1 wonderplugin-tab-buttons-selected"><?php _e( 'Images & Videos', 'video_tv_slide' ); ?></li>
			<li class="wonderplugin-tab-button step2"><?php _e( 'Skins', 'video_tv_slide' ); ?></li>
			<li class="wonderplugin-tab-button step3"><?php _e( 'Options', 'video_tv_slide' ); ?></li>
			<li class="wonderplugin-tab-button step4"><?php _e( 'Preview', 'video_tv_slide' ); ?></li>
			<li class="laststep"><input class="button button-primary" type="button" value="<?php _e( 'Save & Publish', 'video_tv_slide' ); ?>"></input></li>
		</ul>
				
		<ul class="wonderplugin-tabs" id="video-tv-slide-tabs">
			<li class="wonderplugin-tab wonderplugin-tab-selected">	
			
				<div class="wonderplugin-toolbar">	
					<input type="button" class="button" id="wonderplugin-add-image" value="<?php _e( 'Add Image', 'video_tv_slide' ); ?>" />
					<input type="button" class="button" id="wonderplugin-add-video" value="<?php _e( 'Add Video', 'video_tv_slide' ); ?>" />
					<input type="button" class="button" id="wonderplugin-add-youtube" value="<?php _e( 'Add YouTube', 'video_tv_slide' ); ?>" />
					<input type="button" class="button" id="wonderplugin-add-youtube-playlist" value="<?php _e( 'Add YouTube Playlist', 'video_tv_slide' ); ?>" />
					<input type="button" class="button" id="wonderplugin-add-vimeo" value="<?php _e( 'Add Vimeo', 'video_tv_slide' ); ?>" />
					<input type="button" class="button" id="wonderplugin-add-dailymotion" value="<?php _e( 'Add Dailymotion', 'video_tv_slide' ); ?>" />
					<input type="button" class="button" id="wonderplugin-add-iframevideo" value="<?php _e( 'Add Iframe Video', 'video_tv_slide' ); ?>" />
					<input type="button" class="button" id="wonderplugin-add-posts" value="<?php _e( 'Add WordPress Posts', 'video_tv_slide' ); ?>" />
					<input type="button" class="button" id="wonderplugin-add-folder" value="<?php _e( 'Import Folder', 'video_tv_slide' ); ?>" />
					<label style="float:right;"><input type="button" class="button" id="wonderplugin-reverselist" value="<?php _e( 'Reverse List', 'video_tv_slide' ); ?>" /></label>
					<label style="float:right;padding-top:4px;margin-right:8px;"><input type='checkbox' id='wonderplugin-newestfirst' value='' /> Add new item to the beginning</label>
				</div>
        		
        		<ul class="wonderplugin-table" id="video-tv-slide-media-table">
			    </ul>
			    <div style="clear:both;"></div>
      
			</li>
			<li class="wonderplugin-tab">
				<form>
					<fieldset>
						<div class="wonderplugin-tab-skin">
						<label><input type="radio" name="video-tv-slide-skin" value="gallery" selected> Gallery <br /><img class="selected" style="width:300px;" src="<?php echo WONDERPLUGIN_GALLERY_URL; ?>images/skin-gallery.jpg" /></label>
						</div>
						
						<div class="wonderplugin-tab-skin">
						<label><input type="radio" name="video-tv-slide-skin" value="mediapage"> Media page <br /><img style="width:300px;" src="<?php echo WONDERPLUGIN_GALLERY_URL; ?>images/skin-mediapage.jpg" /></label>
						</div>
						
						<div class="wonderplugin-tab-skin">
						<label><input type="radio" name="video-tv-slide-skin" value="light"> Light <br /><img style="width:300px;" src="<?php echo WONDERPLUGIN_GALLERY_URL; ?>images/skin-light.jpg" /></label>
						</div>
						
						<div class="wonderplugin-tab-skin">
						<label><input type="radio" name="video-tv-slide-skin" value="horizontal"> Horizontal <br /><img style="width:300px;" src="<?php echo WONDERPLUGIN_GALLERY_URL; ?>images/skin-horizontal.jpg" /></label>
						</div>
						
						<div class="wonderplugin-tab-skin">
						<label><input type="radio" name="video-tv-slide-skin" value="gallerywithtext"> Gallery With Text <br /><img style="width:300px;" src="<?php echo WONDERPLUGIN_GALLERY_URL; ?>images/skin-gallerywithtext.jpg" /></label>
						</div>
						
						<div class="wonderplugin-tab-skin">
						<label><input type="radio" name="video-tv-slide-skin" value="gallerywithtopthumbs"> Gallery With Top Thumbnails <br /><img style="width:300px;" src="<?php echo WONDERPLUGIN_GALLERY_URL; ?>images/skin-gallerywithtopthumbs.jpg" /></label>
						</div>
						
						<div class="wonderplugin-tab-skin">
						<label><input type="radio" name="video-tv-slide-skin" value="gallerywithtextbottom"> Gallery With Bottom Text <br /><img style="width:300px;" src="<?php echo WONDERPLUGIN_GALLERY_URL; ?>images/skin-gallerywithtextbottom.jpg" /></label>
						</div>
						
						<div class="wonderplugin-tab-skin">
						<label><input type="radio" name="video-tv-slide-skin" value="vertical"> Vertical <br /><img style="width:300px;" src="<?php echo WONDERPLUGIN_GALLERY_URL; ?>images/skin-vertical.jpg" /></label>
						</div>
						
						<div class="wonderplugin-tab-skin">
						<label><input type="radio" name="video-tv-slide-skin" value="verticallight"> Vertical Light<br /><img style="width:300px;" src="<?php echo WONDERPLUGIN_GALLERY_URL; ?>images/skin-verticallight.jpg" /></label>
						</div>
						
						<div class="wonderplugin-tab-skin">
						<label><input type="radio" name="video-tv-slide-skin" value="showcase"> Showcase <br /><img style="width:300px;" src="<?php echo WONDERPLUGIN_GALLERY_URL; ?>images/skin-showcase.jpg" /></label>
						</div>
						
						<div class="wonderplugin-tab-skin">
						<label><input type="radio" name="video-tv-slide-skin" value="darkness"> Darkness <br /><img style="width:300px;" src="<?php echo WONDERPLUGIN_GALLERY_URL; ?>images/skin-darkness.jpg" /></label>
						</div>
						
					</fieldset>
				</form>
			</li>
			<li class="wonderplugin-tab">
			
				<div class="video-tv-slide-options">
					<div class="video-tv-slide-options-menu" id="video-tv-slide-options-menu">
						<div class="video-tv-slide-options-menu-item video-tv-slide-options-menu-item-selected"><?php _e( 'Gallery options', 'video_tv_slide' ); ?></div>
						<div class="video-tv-slide-options-menu-item"><?php _e( 'Skin options', 'video_tv_slide' ); ?></div>
						<div class="video-tv-slide-options-menu-item"><?php _e( 'Lightbox options', 'video_tv_slide' ); ?></div>
						<div class="video-tv-slide-options-menu-item"><?php _e( 'Social Media options', 'video_tv_slide' ); ?></div>
						<div class="video-tv-slide-options-menu-item"><?php _e( 'Advanced options', 'video_tv_slide' ); ?></div>
					</div>
					
					<div class="video-tv-slide-options-tabs" id="video-tv-slide-options-tabs">
						<div class="video-tv-slide-options-tab video-tv-slide-options-tab-selected">
							<table class="wonderplugin-form-table-noborder">
								<tr>
									<th>Slideshow</th>
									<td><label><input name='video-tv-slide-autoslide' type='checkbox' id='video-tv-slide-autoslide' value='' /> Auto slide</label>
									<br /><label><input name='video-tv-slide-random' type='checkbox' id='video-tv-slide-random' value='' /> Random</label></td>
								</tr>
								<tr>
									<th>Slideshow interval (ms)</th>
									<td><label><input name='video-tv-slide-slideshowinterval' type='number' id='video-tv-slide-slideshowinterval' value='' /></label></td>
								</tr>
								<tr>
									<th>Video</th>
									<td><label><input name='video-tv-slide-autoplayvideo' type='checkbox' id='video-tv-slide-autoplayvideo' value='' /> Automatically play video (Not working on mobile and tablets devices: iPhone, iPad and Android)</label>
									<br /><label><input name='video-tv-slide-autoslideandplayafterfirstplayed' type='checkbox' id='video-tv-slide-autoslideandplayafterfirstplayed' value='' /> Auto slide and play videos after the first video is played</label>
									<br /><label><input name='video-tv-slide-html5player' type='checkbox' id='video-tv-slide-html5player' value='' /> Use HTML5 as default video player</label>
									<br /><label><input name='video-tv-slide-schemamarkup' type='checkbox' id='video-tv-slide-schemamarkup' value='' /> Create Schema.org markup for Videos (Dynamic YouTube Playlist not supported)</label>
									<br /><label><input name='video-tv-slide-hidetitlewhenvideoisplaying' type='checkbox' id='video-tv-slide-hidetitlewhenvideoisplaying' value='' /> Hide title when the video is playing</label>
									<br /><label><input name='video-tv-slide-stopallplaying' type='checkbox' id='video-tv-slide-stopallplaying' value='' /> Stop other HTML5 audio and video players on the same webpage when the video starts playing</label>
									<br /><label><input name='video-tv-slide-reloadonvideoend' type='checkbox' id='video-tv-slide-reloadonvideoend' value='' /> Reload and display the poster image when the current video ends</label>
									<br /><label><input name='video-tv-slide-loadnextonvideoend' type='checkbox' id='video-tv-slide-loadnextonvideoend' value='' /> Load the next video and stop when the current video ends</label>
									</td>
								</tr>
								<tr>
									<th>Responsive</th>
									<td><label><input name='video-tv-slide-responsive' type='checkbox' id='video-tv-slide-responsive' value='' /> Create a responsive gallery</label><br />
									<label><input name='video-tv-slide-fullwidth' type='checkbox' id='video-tv-slide-fullwidth' value='' /> Create a full width gallery</label>
									<br><label><input name='video-tv-slide-disablehovereventontouch' type='checkbox' id='video-tv-slide-disablehovereventontouch' value='' /> Disable hover over effect on touch screen</label>
									</td>
								</tr>
								<tr>
									<th>Resize mode</th>
									<td><label>
										<select name='video-tv-slide-resizemode' id='video-tv-slide-resizemode'>
										  <option value="fit">Resize to fit</option>
										  <option value="fill">Resize to fill</option>
										</select>
									</label></td>
								</tr>
								<tr>
									<th>Keyboard Accessibility</th>
									<td><label><input name='video-tv-slide-enabletabindex' type='checkbox' id='video-tv-slide-enabletabindex' value='' /> Enable the tabindex attribute for thumbnails</label><br />
									</td>
								</tr>
								<tr>
									<th>Button display mode</th>
									<td><label>
										<select name='video-tv-slide-imagetoolboxmode' id='video-tv-slide-imagetoolboxmode'>
										  <option value="mouseover">Show on mouseover</option>
										  <option value="show">Always show</option>
										  <option value="hide">Hide</option>
										</select>
									</label></td>
								</tr>
								<tr>
									<th>Buttons</th>
									<td>
										<label><input name='video-tv-slide-showplaybutton' type='checkbox' id='video-tv-slide-showplaybutton' value='' /> Show play/pause button</label><br />
										<label><input name='video-tv-slide-showfullscreenbutton' type='checkbox' id='video-tv-slide-showfullscreenbutton' value='' /> Show lightbox button</label>
									</td>
								</tr>
								<tr>
									<th>Transition effect</th>
									<td>
										<label><input name='video-tv-slide-effect-fade' type='checkbox' id='video-tv-slide-effect-fade' value='fade' /> Fade</label> &nbsp;
										<label><input name='video-tv-slide-effect-fadeinout' type='checkbox' id='video-tv-slide-effect-fadeinout' value='fadeinout' /> Fade In Fade Out</label> &nbsp;
										<label><input name='video-tv-slide-effect-crossfade' type='checkbox' id='video-tv-slide-effect-crossfade' value='crossfade' /> Crossfade</label>
										<label><input name='video-tv-slide-effect-slide' type='checkbox' id='video-tv-slide-effect-slide' value='slide' /> Slide</label> &nbsp;
									</td>
								</tr>
								<tr>
									<th>Fade effect duration (ms)</th>
									<td><label><input name='video-tv-slide-duration' type='number' id='video-tv-slide-duration' value='' /></label></td>
								</tr>
								<tr>
									<th>Slide effect duration (ms)</th>
									<td><label><input name='video-tv-slide-slideduration' type='number' id='video-tv-slide-slideduration' value='' /></label></td>
								</tr>
								<tr>
									<th>Timer</th>
									<td><label><input name='video-tv-slide-showtimer' type='checkbox' id='video-tv-slide-showtimer' value='' /> Show a line timer at the bottom of the image when slideshow playing</label></td>
								</tr>
								<tr>
									<th>Carousel</th>
									<td><label><input name='video-tv-slide-showcarousel' type='checkbox' id='video-tv-slide-showcarousel' value='' /> Show thumbnail carousel</label></td>
								</tr>
								<tr>
									<th>Google Analytics Tracking ID:</th>
									<td><label><input name="video-tv-slide-googleanalyticsaccount" type="text" id="video-tv-slide-googleanalyticsaccount" value="" class="medium-text" /></label></td>
								</tr>
								<tr>
									<th>&lt;img&gt; tags</th>
									<td><label><input name='video-tv-slide-showimgtitle' type='checkbox' id='video-tv-slide-showimgtitle' value='' /> Add the following text as &lt;img&gt; tag title attribute: </label>
									<select name='video-tv-slide-imgtitle' id='video-tv-slide-imgtitle'>
										  <option value="title">Title</option>
										  <option value="description">Description</option>
										  <option value="alt">Alt</option>
										</select>
									</td>
								</tr>
							</table>
						</div>
						<div class="video-tv-slide-options-tab">
							<p class="video-tv-slide-options-tab-title"><?php _e( 'Skin option will be restored to its default value if you switch to a new skin in the Skins tab.', 'video_tv_slide' ); ?></p>
							<table class="wonderplugin-form-table-noborder">
								<tr>
									<th>Text</th>
									<td><label><input name='video-tv-slide-showtitle' type='checkbox' id='video-tv-slide-showtitle' value='' /> Show title</label><br />
									<label><input name='video-tv-slide-showdescription' type='checkbox' id='video-tv-slide-showdescription' value='' /> Show description</label>
									</td>
								</tr>
								
								<tr>
									<th>Title CSS</th>
									<td><label><textarea name="video-tv-slide-titlecss" id="video-tv-slide-titlecss" rows="3" class="large-text code"></textarea></label>
									</td>
								</tr>
								
								<tr>
									<th>Title height (px)</th>
									<td>
									<input name="video-tv-slide-titleheight" type="number" id="video-tv-slide-titleheight" value="72" class="small-text" />
									<br><label><input name='video-tv-slide-titlesmallscreen' type='checkbox' id='video-tv-slide-titlesmallscreen' value='' /> Specify a different title height (px) : </label>
									<input name="video-tv-slide-titleheightsmallscreen" type="number" id="video-tv-slide-titleheightsmallscreen" value="148" class="small-text" />
									when the screen width is less than (px) :<input name="video-tv-slide-titlesmallscreenwidth" type="number" id="video-tv-slide-titlesmallscreenwidth" value="640" class="small-text" />
									</td>
								</tr>
								
								<tr>
									<th>Description CSS</th>
									<td><label><textarea name="video-tv-slide-descriptioncss" id="video-tv-slide-descriptioncss" rows="3" class="large-text code"></textarea></label>
									</td>
								</tr>
								<tr>
									<th><?php _e( 'Padding', 'video_tv_slide' ); ?> </th>
									<td><input name="video-tv-slide-padding" type="text" id="video-tv-slide-padding" value="12" class="small-text" /></td>
								</tr>
								<tr>
									<th>Shadow</th>
									<td><label><input name='video-tv-slide-galleryshadow' type='checkbox' id='video-tv-slide-galleryshadow'  /> Show gallery shadow</label>
									<br /><label><input name='video-tv-slide-slideshadow' type='checkbox' id='video-tv-slide-slideshadow' /> Show slide shadow</label>
									<br /><label><input name='video-tv-slide-thumbshadow' type='checkbox' id='video-tv-slide-thumbshadow' /> Show thumbnail shadow</label>
									</td>
								</tr>
								<tr>
									<th><?php _e( 'Background color', 'video_tv_slide' ); ?> </th>
									<td><input name="video-tv-slide-bgcolor" type="text" id="video-tv-slide-bgcolor" value="" class="text" /></td>
								</tr>
								<tr>
									<th><?php _e( 'Background image', 'video_tv_slide' ); ?> </th>
									<td><input name="video-tv-slide-bgimage" type="text" id="video-tv-slide-bgimage" value="" class="large-text" /></td>
								</tr>
								<tr>
								<th><?php _e( 'Thumbnail width', 'video_tv_slide' ); ?> / <?php _e( 'height', 'video_tv_slide' ); ?></th>
									<td><input name="video-tv-slide-thumbwidth" type="number" id="video-tv-slide-thumbwidth" value="64" class="small-text" /> / <input name="video-tv-slide-thumbheight" type="number" id="video-tv-slide-thumbheight" value="48" class="small-text" />
									<p><label><input name='video-tv-slide-thumbcolumnsresponsive' type='checkbox' id='video-tv-slide-thumbcolumnsresponsive'  /> Specify different size for small screens (horizontal skins only)</label></p>
									<ul style="list-style-type:square;margin-left:24px;"><li>Thumbnail size when the screen width is less than <input name="video-tv-slide-thumbmediumsize" type=""number"" id="video-tv-slide-thumbmediumsize" value="800" class="small-text" /> px:  <input name="video-tv-slide-thumbmediumwidth" type="number" id="video-tv-slide-thumbmediumwidth" value="64" class="small-text" /> / <input name="video-tv-slide-thumbmediumheight" type="number" id="video-tv-slide-thumbmediumheight" value="48" class="small-text" /></li>
									<li>Thumbnail size when the screen width is less than <input name="video-tv-slide-thumbsmallsize" type=""number"" id="video-tv-slide-thumbsmallsize" value="480" class="small-text" /> px:  <input name="video-tv-slide-thumbsmallwidth" type="number" id="video-tv-slide-thumbsmallwidth" value="64" class="small-text" /> / <input name="video-tv-slide-thumbsmallheight" type="number" id="video-tv-slide-thumbsmallheight" value="48" class="small-text" /></li></ul>
									</td>
								</tr>
								<tr>
									<th>Thumbnail title</th>
									<td><label><input name='video-tv-slide-thumbshowtitle' type='checkbox' id='video-tv-slide-thumbshowtitle'  /> Show title in thumbnail area</label></td>
								</tr>
								<tr>
									<th>Thumbnail gap</th>
									<td><input name="video-tv-slide-thumbgap" type="text" id="video-tv-slide-thumbgap" value="64" class="small-text" /> </td>
								</tr>
								<tr>
									<th>Thumbnail gap between row</th>
									<td><input name="video-tv-slide-thumbrowgap" type="text" id="video-tv-slide-thumbrowgap" value="64" class="small-text" /> </td>
								</tr>
							</table>
						</div>
						
						<div class="video-tv-slide-options-tab">
							<table class="wonderplugin-form-table-noborder">
								<tr>
									<th>Maximum text bar height</th>
									<td><label><input name="video-tv-slide-lightboxtextheight" type="text" id="video-tv-slide-lightboxtextheight" value="64" class="small-text" /></label>
									</td>
								</tr>
								
								<tr valign="top">
									<th scope="row">Title</th>
									<td><label><input name="video-tv-slide-lightboxshowtitle" type="checkbox" id="video-tv-slide-lightboxshowtitle" /> Show title</label></td>
								</tr>
								
								<tr>
									<th>Title CSS</th>
									<td><label><textarea name="video-tv-slide-lightboxtitlecss" id="video-tv-slide-lightboxtitlecss" rows="2" class="large-text code"></textarea></label>
									</td>
								</tr>
								
								<tr valign="top">
									<th scope="row">Description</th>
									<td><label><input name="video-tv-slide-lightboxshowdescription" type="checkbox" id="video-tv-slide-lightboxshowdescription" /> Show description</label></td>
								</tr>
								
								<tr>
									<th>Description CSS</th>
									<td><label><textarea name="video-tv-slide-lightboxdescriptioncss" id="video-tv-slide-lightboxdescriptioncss" rows="2" class="large-text code"></textarea></label>
									</td>
								</tr>
								
							</table>
						</div>
						
						<div class="video-tv-slide-options-tab">
							<table class="wonderplugin-form-table-noborder">
								<tr valign="top">
								<th scope="row">Social Media</th>
								<td><label for="video-tv-slide-initsocial"><input name="video-tv-slide-initsocial" type="checkbox" id="video-tv-slide-initsocial" /> Initialise social media CSS</label>
								<p><label for="video-tv-slide-showsocial"><input name="video-tv-slide-showsocial" type="checkbox" id="video-tv-slide-showsocial" /> Enable social media</label></p>
								<p><label for="video-tv-slide-showemail"><input name="video-tv-slide-showemail" type="checkbox" id="video-tv-slide-showemail" /> Show email button</label>
								<br><label for="video-tv-slide-showfacebook"><input name="video-tv-slide-showfacebook" type="checkbox" id="video-tv-slide-showfacebook" /> Show Facebook button</label>
								<br><label for="video-tv-slide-showtwitter"><input name="video-tv-slide-showtwitter" type="checkbox" id="video-tv-slide-showtwitter" /> Show Twitter button</label>
								<br><label for="video-tv-slide-showpinterest"><input name="video-tv-slide-showpinterest" type="checkbox" id="video-tv-slide-showpinterest" /> Show Pinterest button</label></p>
								</td>
							</tr>
				        	
				        	<tr valign="top">
								<th scope="row">Position and Size</th>
								<td>
								Display mode on the gallery:
								<select name="video-tv-slide-socialmode" id="video-tv-slide-socialmode">
								  <option value="mouseover" selected="selected">On mouse over</option>
								  <option value="always">Always</option>
								</select>
								<p>Position CSS: <input name="video-tv-slide-socialposition" type="text" id="video-tv-slide-socialposition" value="" class="regular-text" /></p>
                				<p>Position CSS on lightbox popup: <input name="video-tv-slide-socialpositionlightbox" type="text" id="video-tv-slide-socialpositionlightbox" value="" class="regular-text" /></p>
								<p>Button size: <input name="video-tv-slide-socialbuttonsize" type="number" id="video-tv-slide-socialbuttonsize" value="32" class="small-text" />
								Button font size: <input name="video-tv-slide-socialbuttonfontsize" type="number" id="video-tv-slide-socialbuttonfontsize" value="18" class="small-text" />
								Buttons direction:
								<select name="video-tv-slide-socialdirection" id="video-tv-slide-socialdirection">
								  <option value="horizontal" selected="selected">horizontal</option>
								  <option value="vertical">vertical</option>
								</select>
								</p>
								<p><label for="video-tv-slide-socialrotateeffect"><input name="video-tv-slide-socialrotateeffect" type="checkbox" id="video-tv-slide-socialrotateeffect" /> Enable button rotating effect on mouse hover</label></p>	
								</td>
							</tr>
							</table>
						</div>
						
						<div class="video-tv-slide-options-tab">
							<table class="wonderplugin-form-table-noborder">
								<tr>
									<th></th>
									<td><p><label><input name='video-tv-slide-donotinit' type='checkbox' id='video-tv-slide-donotinit'  /> Do not init the gallery when the page is loaded. Check this option if you would like to manually init the gallery with JavaScript API.</label></p>
									<p><label><input name='video-tv-slide-addinitscript' type='checkbox' id='video-tv-slide-addinitscript'  /> Add init scripts together with gallery HTML code. Check this option if your WordPress site uses Ajax to load pages and posts.</label></p>
									<p><label><input name='video-tv-slide-doshortcodeontext' type='checkbox' id='video-tv-slide-doshortcodeontext'  /> Support shortcode in title and description</label></p>
									<p><label><input name='video-tv-slide-triggerresize' type='checkbox' id='video-tv-slide-triggerresize'  /> Trigger window resize event after (ms): </label><input name="video-tv-slide-triggerresizedelay" type="number" min=0 id="video-tv-slide-triggerresizedelay" value="0" class="small-text" /></p>
									</td>
								</tr>
								<tr>
								<tr>
									<th>Custom CSS</th>
									<td><textarea name='video-tv-slide-custom-css' id='video-tv-slide-custom-css' value='' class='large-text' rows="10"></textarea><br />
									<label><input name='video-tv-slide-specifyid' type='checkbox' id='video-tv-slide-specifyid' value='' /> Use gallery id in CSS class name</label>
									</td>
								</tr>
								<tr>
									<th>Advanced Options</th>
									<td><textarea name='video-tv-slide-data-options' id='video-tv-slide-data-options' value='' class='large-text' rows="10"></textarea></td>
								</tr>
								<tr>
									<th>Custom JavaScript</th>
									<td><textarea name='video-tv-slide-customjs' id='video-tv-slide-customjs' value='' class='large-text' rows="10"></textarea><br />
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
				<div style="clear:both;"></div>
				
			</li>
			<li class="wonderplugin-tab">
				<div id="video-tv-slide-preview-tab">
					<div id="video-tv-slide-preview-message"></div>
					<div id="video-tv-slide-preview-container">
					</div>
				</div>
			</li>
			<li class="wonderplugin-tab">
				<div id="video-tv-slide-publish-loading"></div>
				<div id="video-tv-slide-publish-information"></div>
			</li>
		</ul>
		</div>
		
		<?php
	}
	
	function get_list_data() {
		return array();
	}
}