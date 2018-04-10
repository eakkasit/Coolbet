/*
 * TOTOIT Posts Widget
 * Admin Scripts
 * Author: dpe415
 * URI: http://wordpress.org/extend/plugins/totoit-posts-widget/
 */
 
/* global ajaxurl, fpwL10n */

jQuery(function() {

	// Setup the show/hide thumbnails box
	jQuery('input.dpe-fp-thumbnail').each( function() {
		if( this.checked ) {
			jQuery(this).parent().next().slideDown('fast');
		} else {
			jQuery(this).parent().next().slideUp('fast');
		}
	});

	// Enable the Get Em By tabs
	jQuery('.dpe-fp-widget .getembytabs').tabs({
		// Set the active tab to a widget option
		activate: function() {
			jQuery(this).find('.cur_tab').val( jQuery( this ).tabs( 'option', 'active' ) );
		},
		// retrieve the saved active tab and set it for the UI
		create: function() {
			jQuery( this ).tabs( 'option', 'active', jQuery(this).find('.cur_tab').val() );
		}
	});

});

// Add the tabs functionality AJAX returns
jQuery(document).ajaxComplete(function() {
	jQuery('.dpe-fp-widget .getembytabs').tabs({
		// Set the active tab to a widget option
		activate: function() {
			jQuery(this).find('.cur_tab').val( jQuery(this).tabs( 'option', 'active' ) );
		},
		// retrieve the saved active tab and set it for the UI
		create: function() {
			jQuery(this).tabs( 'option', 'active', jQuery(this).find('.cur_tab').val() );
		}
	});
});

// Add event triggers to the show/hide thumbnails box
jQuery('#widgets-right').on('change', 'input.dpe-fp-thumbnail', function() {
	if( this.checked ) {
		jQuery(this).parent().next().slideDown('fast');
	} else {
		jQuery(this).parent().next().slideUp('fast');
	}
});

// Setup the get_terms callback
jQuery('#widgets-right').on('change', 'select.dpe-fp-taxonomy', function() {
	
	var terms_div		= jQuery(this).parent().nextAll('div.terms'),
		terms_label		= jQuery(this).parent().next('label'),
		widget_id       = jQuery(this).parents('form').find('input.widget_number'),
		data            = {};

	// If we're not ignoring Taxonomy & Term...
	if( jQuery(this).val() !== 'none' ) {
		
		terms_label.html(fpwL10n.gettingTerms).show();

		data = {
			action:     'dpe_fp_get_terms',
			widget_id:  widget_id.val(),
			taxonomy:   jQuery(this).val()
		};
		
		jQuery.post(ajaxurl, data, function(response) {
			terms_div.html(response);
			terms_label.html(fpwL10n.selectTerms).show();
			terms_div.slideDown();
		}).error( function() {
			terms_label.html(fpwL10n.noTermsFound).show();
		});
	
	} else {
		terms_div.slideUp().html('');
		terms_label.hide();
	}
	
});

var seletedVal = [];
var addPostTitle = function (fieldid){
	var result = confirm("Are you sure you want to add this item?");
			if (result) {
				//console.log('addPostTitle',fieldid);
				//console.log('seletedVal',seletedVal);
				var img = jQuery( "img.delete" ).first().clone();
				var $li = jQuery("<li id='records_"+seletedVal[fieldid].ID+"' data-postid='"+seletedVal[fieldid].ID+"' />").html(seletedVal[fieldid].post_title+img[0].outerHTML);
				var el_last = jQuery("#list-"+fieldid+' li:last');
				var last_postid = el_last.data('postid');
				var dataMoveTo = el_last.clone();

				//console.log('dataMoveTo',dataMoveTo);
				jQuery("#list-"+fieldid).prepend($li);


				
					var order = jQuery("#list-"+fieldid).sortable("toArray");
					//console.log('fieldid',fieldid,'order.length',order.length);
					var order = jQuery("#list-"+fieldid).sortable("toArray");
					var newOrder = order.join(",").replace(/records_/gi,'');
					//console.log('newOrder',newOrder); 
					//console.log('fieldid',fieldid);
					jQuery('.'+fieldid).val(newOrder);
					jQuery("#list-"+fieldid).sortable('refresh');
					if(fieldid=='Three-stories' && order.length>=3){
						var el_eight_stories = jQuery('.8-item');
						var eight_stories = el_eight_stories.val();
						//console.log('eight_stories',eight_stories);
						var partsOfStr8 = eight_stories.split(',');
						partsOfStr8.unshift(last_postid);
						if(partsOfStr8.length>8){
							partsOfStr8.pop();
						}
						//console.log('eight_stories',partsOfStr8,'partsOfStr8.length',partsOfStr8.length);
						el_eight_stories.val(partsOfStr8.join(","));
						var el_eight_last = jQuery('#list-8-item li:last');
						if(partsOfStr8.length>8){
							//console.log('partsOfStr8.length>8',partsOfStr8.length);
							el_eight_last.remove();
						}
						jQuery("#list-8-item").prepend(dataMoveTo[0].outerHTML);
						jQuery("#list-8-item").sortable('refresh');
					}
			}
			return true;
}
jQuery(document).ready(function(){

	function inisort(){
		jQuery('.post_title').each(function(){
			var post_title = jQuery(this);
			var fieldid = post_title.data('fieldid');
			jQuery( post_title ).autocomplete({
				source: function( request, response ) {
				  jQuery.ajax( {
					url: ajaxurl,
					data: {
						action:     'dpe_fp_get_title',
						title: request.term
					  },
					success: function( data ) {
						//console.log('data',data);
					  response( data );
					}
				  } );
				},
				minLength: 2,
				select: function( event, ui ) {
					post_title.val( ui.item.label); //ui.item is your object from the array
					seletedVal[fieldid] = {post_title:ui.item.label,ID:ui.item.value};
					return false;
				}
			  } ).disableSelection();
			  if(jQuery("#list-"+fieldid).length){
				  jQuery("#list-"+fieldid).sortable({ opacity:0.6, update: function() {
							var order = jQuery(this).sortable("toArray");
							var newOrder = order.join(",").replace(/records_/gi,'');
							//console.log('newOrder',newOrder); 
							//console.log('fieldid',fieldid);
							jQuery('.'+fieldid).val(newOrder);
						}
				  });
			  }
			  jQuery("#list-"+fieldid).on("click", ".delete",function(event) { 
				event.preventDefault();
				var result = confirm("Are you sure you want to delete this item?");
				if (result) {
					//Logic to delete the item
					jQuery(this).parent().remove();
					var order = jQuery("#list-"+fieldid).sortable("toArray");
						var newOrder = order.join(",").replace(/records_/gi,'');
						//console.log('newOrder',newOrder); 
						//console.log('fieldid',fieldid);
						jQuery('.'+fieldid).val(newOrder);
					
				}
				});
		});
	}

	jQuery(document).on('widget-updated', function(e, widget){
		var widget_id = jQuery(widget).attr('id');
		var templateName = jQuery('#'+widget_id).find('input.Three-stories').data('fieldid');
		//console.log('templateName',templateName);
		if(typeof templateName!='undefined' &&templateName=='Three-stories'){
			//console.log('widget_id',widget_id);
			var eightID = jQuery('#homepagewidgets input.8-item').data('widgetid');
			//console.log('eightID',eightID);
			jQuery('#widget-dpe_fp_widget-'+eightID+'-savewidget').trigger('click');
			
		}
		inisort();
	});

	inisort();


});
