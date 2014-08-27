"use strict";
var fixed_menu = true;
var GT3THEME_INSTALLED = true;
window.jQuery = window.$ = jQuery;
var demo = true;

jQuery(document).ready(function() {
	if ($(window).height() > $('header').height()+$('footer').height()+$('.main_wrapper').height()+$('.pre_footer').height()+159) {
		$('.main_wrapper').css('min-height', ($(window).height()-$('header').height()-$('footer').height()-$('.pre_footer').height()-159)+'px')
	}
	setTimeout("jQuery('body').removeClass('op0')",500);
	//MobileMenu
	jQuery('.header_wrapper').append('<a href="javascript:void(0)" class="menu_toggler"></a>');
	jQuery('header').append('<div class="mobile_menu_wrapper"><ul class="mobile_menu container"/></div>');	
	jQuery('.mobile_menu').html(jQuery('header').find('.menu').html());
	jQuery('.mobile_menu_wrapper').hide();
	jQuery('.menu_toggler').click(function(){
		jQuery('.mobile_menu_wrapper').slideToggle(300);
	});	
	
	//Input and Textarea Click-Clear
	jQuery('input[type=text]').focus(function() {
		if(jQuery(this).attr('readonly') || jQuery(this).attr('readonly') == 'readonly') return false;
		if (jQuery(this).val() === jQuery(this).attr('title')) {
				jQuery(this).val('');
		}   
		}).blur(function() {
		if(jQuery(this).attr('readonly') || jQuery(this).attr('readonly') == 'readonly') return false;
		if (jQuery(this).val().length === 0) {
			jQuery(this).val(jQuery(this).attr('title'));
		}                        
	});	
	jQuery('textarea').focus(function() {
		if (jQuery(this).text() === jQuery(this).attr('title')) {
				jQuery(this).text('');
			}        
		}).blur(function() {
		if (jQuery(this).text().length === 0) {
			jQuery(this).text(jQuery(this).attr('title'));
		}                        
	});	
	
	//FeedBack Form
	jQuery('.content_block').find('.form_field').each(function(){
		jQuery(this).width(jQuery(this).parent('form').width()-32);
	});	
	jQuery('.login_form').find('.form_field').each(function(){
		jQuery(this).width(jQuery(this).parent('form').width()-32);
	});	
	jQuery('.mc_input').each(function(){
		jQuery(this).width(jQuery(this).parents('.widget_mailchimpsf_widget').width()-30);
	});			
	jQuery('.sidepanel').find('.field_search').each(function(){
		jQuery(this).width(jQuery(this).parent('.search_form').width()-32);
	});	

	//.wpcf7-form span.placeholder
	jQuery('.wpcf7-form .wpcf7-text').each(function(){
		jQuery(this).attr('placeholder', jQuery(this).parent('span').prev('span.placeholder').text());
	});
	jQuery('.wpcf7-form .wpcf7-textarea').each(function(){		
		jQuery(this).attr('placeholder', jQuery(this).parent('span').prev('span.placeholder').text());
	});		
	jQuery('.feedback_go').click(function(){
		var par = jQuery(this).parents(".feedback_form");
		var name = par.find(".field-name").val();
		var email = par.find(".field-email").val();
		var message = par.find(".field-message").val();
		var subject = par.find(".field-subject").val();
		if (email.indexOf('@') < 0) {			
			email = "mail_error";
		}
		if (email.indexOf('.') < 0) {			
			email = "mail_error";
		}
		jQuery.ajax({
			url: "mail.php",
			type: "POST",
			data: { name: name, email: email, message: message, subject: subject },
			success: function(data) {
				jQuery('.ajaxanswer').hide().empty().html(data).fadeIn("slow");
				setTimeout("jQuery('.ajaxanswer').fadeOut('slow')",5000);
		  }
		});
	});

	jQuery('.searchbox_toggle').click(function(){
		jQuery('.header_wrapper').toggleClass('search_show');
	});

	if (jQuery('.layout_trigger').hasClass('boxed_bg_cont')) {
		jQuery('html').addClass('user_bg_layout');
		jQuery('.header_wrapper').wrap('<div class="header_layout"/>');
	}
	if (jQuery('.layout_trigger').hasClass('image_bg_cont')) {
		jQuery('html').addClass('user_bg_layout');
		jQuery('.custom_bg_cont').height(jQuery(window).height());
		jQuery('html').addClass('user_pic_layout');
	}

	if (jQuery('.content_block').hasClass('no-sidebar')) {
		if (jQuery('html').hasClass('user_bg_layout')) {
			jQuery('.module_line_trigger').each(function(){
				jQuery(this).css('margin-left' , -1*(jQuery('.main_wrapper').width()-jQuery('.container').width())/2+'px').width(jQuery('.main_wrapper').width());
				jQuery(this).wrapInner('<div class="module_line '+jQuery(this).attr('data-option')+'" style="background:'+jQuery(this).attr('data-background')+'; padding-top:'+jQuery(this).attr('data-top-padding')+'"><div class="module_line_wrapper container"></div></div>');
			});
		} else {
			jQuery('.module_line_trigger').each(function(){
				jQuery(this).css('margin-left' , -1*(jQuery(window).width()-jQuery('.container').width())/2+'px').width(jQuery(window).width());
				jQuery(this).wrapInner('<div class="module_line '+jQuery(this).attr('data-option')+'" style="background:'+jQuery(this).attr('data-background')+'; padding-top:'+jQuery(this).attr('data-top-padding')+'"><div class="module_line_wrapper container"></div></div>');
			});
		}
	} else {
		jQuery('.module_line_trigger').each(function(){			
			jQuery(this).wrapInner('<div class="module_line '+jQuery(this).attr('data-option')+'" style="background:'+jQuery(this).attr('data-background')+'; padding-top:'+jQuery(this).attr('data-top-padding')+'"></div>');
		});		
	}

	jQuery('.nivoSlider').each(function(){
		jQuery(this).nivoSlider({
			directionNav:false,
			controlNav: true,
			effect:'fade',
			pauseTime:4000,
			slices: 1
		});
	});
	
	/*Blog post prev/next seperator*/
	if ($('.prev_next_links .fleft').html() !== '' && $('.prev_next_links .fright').html() !== '') {
		$('.prev_next_links .fleft').after('<span class="prev_next_links_seperator">/</span>');
	}
	$('.ls-wp-fullwidth-container').parents('.module_layer_slider').addClass('fullwidth_layer_slider');	
	
	$('.flickr_badge_image a').hover(function(){
		$(this).find('.flickr_wrapper').stop().animate({'opacity' : '0.8'}, 250);
	},
	function(){
		$(this).find('.flickr_wrapper').stop().animate({'opacity' : '0'}, 250);
	});
	
	$('ol.commentlist li').each(function(){
		if ($(this).find('ul').size() > 0) {
			$(this).addClass('hasComments');
		}
	});
	
	if (fixed_menu) {
		var header_text = $('.header_wrapper').html();
		$('body').append('<header class="fixed_menu"><div class="container">'+header_text+'</div></header>');
	}
	
	/*Portfolio Masonry*/
	if (jQuery('.content_block').hasClass('no-sidebar')) {
		if (jQuery('html').hasClass('user_bg_layout')) {
			jQuery('.module_portfolio_masonry').each(function(){
				jQuery(this).css({'margin-left' : -1*(jQuery('.main_wrapper').width()-jQuery('.container').width())/2+'px', 'width' : jQuery('.main_wrapper').width()+'px'}).attr('width', jQuery('.main_wrapper').width());
			});
		} else {
			jQuery('.module_portfolio_masonry').each(function(){
				jQuery(this).css({'margin-left' : -1*(jQuery(window).width()-jQuery('.container').width())/2+'px', 'width' : jQuery(window).width()+'px'}).attr('width', jQuery(window).width());
			});			
		}
	}
    $('.portfolio_item_img_fx').hover(function(){
        $(this).find('.portfolio_image_fadder').stop().animate({'opacity' : '0.8'},250);
        $(this).find('a').stop().animate({'opacity' : '1'},250);
    }, function() {
        $(this).find('.portfolio_image_fadder').stop().animate({'opacity' : '0'},300);
        $(this).find('a').stop().animate({'opacity' : '0'},50);
    });		
	$('.masonry_pf_item').hover(function(){
		$(this).find('.masonry_pf_image_fadder').stop().animate({'opacity' : '0.8'}, 300);
		$(this).find('.portfolio_content').stop().animate({'opacity' : '1'}, 300);
	},function(){
		$(this).find('.masonry_pf_image_fadder').stop().animate({'opacity' : '0'}, 300);
		$(this).find('.portfolio_content').stop().animate({'opacity' : '0'}, 300);
	});
	if ($(window).width() > 1024) var items_per_row = 5;
	if ($(window).width() < 1025 && $(window).width() > 768) var items_per_row = 4;
	if ($(window).width() < 769 && $(window).width() > 480) var items_per_row = 3;
	if ($(window).width() < 481 && $(window).width() > 320) var items_per_row = 2;
	if ($(window).width() < 321) var items_per_row = 1;
	
	$('.module_portfolio_masonry .masonry_pf_item').each(function(){
		$(this).find('.portfolio_content').css('margin-top', -1*($(this).find('.portfolio_content').height()/2)+'px');
		$(this).width(Math.floor($(window).width()/items_per_row)).height($(this).find('.portfolio_item_wrapper').height());
	});
	
	$('.portfolio_preview').click(function(){
		var set_img = $(this).find('img').attr('src');
		var set_title = $(this).find('.masonry_pf_title').text();
		var set_text = $(this).find('.masonry_pf_excerpt').html();
		var set_url = $(this).attr('data-url');
		$('html, body').stop().animate({scrollTop: $('.portfolio_preview_wrapper').offset().top-$('.fixed_menu').height()-35}, 600);
		$('.portfolio_preview_wrapper').animate({'opacity' : '0'}, 500, function(){
			$(this).empty();
			$(this).parents('.masonry_portfolio_preview').height(0);
			$(this).append('<div class="row_fluid"><div class="gt3_col6"><img src="'+set_img+'"></div><div class="gt3_col6"><h4>'+set_title+'</h4><div class="pf_preview_text">'+set_text+'</div><a href="'+set_url+'" class="shortcode_button btn_small btn_type4">Read more!</a></div></div>');
			$(this).parents('.masonry_portfolio_preview').height($(this).height()+110);			
			$(this).animate({'opacity' : '1'}, 500);
		});
	});
	$('.pf_preview_close').click(function(){
		$(this).parents('.masonry_portfolio_preview').height(0);
		$('.portfolio_preview_wrapper').animate({'opacity' : '0'}, 500, function(){
			$(this).empty();			
		});	
	});

    var comment_heading = $("#respond #reply-title").html();
    $("#respond #reply-title").wrap("<div class='bg_title'></div>");
    $("#respond #reply-title").parent().html("<h3 id='reply-title'>"+comment_heading+"</h3>");
    $(".mc_signup_submit .button").addClass("mc_submit");

    jQuery('.module_faq').each(function(){
        jQuery(this).find('.expanded_yes').click();
    });	
});	

jQuery(window).load(function(){
	//Widget Flickr;	
	$('.flickr_badge_image a').append('<div class="flickr_wrapper" style="opacity:0"></div>');	
	jQuery('.wpcf7-form .wpcf7-text').each(function(){		
		jQuery(this).width(jQuery(this).parents('.wpcf7-form').width()-32);
	});	
	jQuery('.wpcf7-form .wpcf7-textarea').each(function(){		
		jQuery(this).width(jQuery(this).parents('.wpcf7-form').width()-32);
	});	

	if (fixed_menu) {
		if ($(window).scrollTop() > $('header#main_header').offset().top+$('header#main_header').height()+100) {
			$('.fixed_menu').addClass('fixed_showed');
		} else {
			$('.fixed_menu').removeClass('fixed_showed');
		}
	}
	if ($(window).width() > 1024) var items_per_row = 5;
	if ($(window).width() < 1025 && $(window).width() > 768) var items_per_row = 4;
	if ($(window).width() < 769 && $(window).width() > 480) var items_per_row = 3;
	if ($(window).width() < 481 && $(window).width() > 320) var items_per_row = 2;
	if ($(window).width() < 321) var items_per_row = 1;
	
	$('.module_portfolio_masonry .masonry_pf_item').each(function(){
		$(this).find('.portfolio_content').css('margin-top', -1*($(this).find('.portfolio_content').height()/2)+'px');
		$(this).width(Math.floor($(window).width()/items_per_row)).height($(this).find('.portfolio_item_wrapper').height());
	});	
});

jQuery(window).scroll(function(){
	if (fixed_menu) {
		if ($(window).scrollTop() > $('header#main_header').offset().top+$('header#main_header').height()+100) {
			$('.fixed_menu').addClass('fixed_showed');
		} else {
			$('.fixed_menu').removeClass('fixed_showed');
		}
	}
});


jQuery(window).resize(function(){
	/*Portfolio Masonry*/
	if (jQuery('.content_block').hasClass('no-sidebar')) {
		if (jQuery('html').hasClass('user_bg_layout')) {
			jQuery('.module_portfolio_masonry').each(function(){
				jQuery(this).css({'margin-left' : -1*(jQuery('.main_wrapper').width()-jQuery('.container').width())/2+'px', 'width' : jQuery('.main_wrapper').width()+'px'}).attr('width', jQuery('.main_wrapper').width());
			});
		} else {
			jQuery('.module_portfolio_masonry').each(function(){
				jQuery(this).css({'margin-left' : -1*(jQuery(window).width()-jQuery('.container').width())/2+'px', 'width' : jQuery(window).width()+'px'}).attr('width', jQuery(window).width());
			});			
		}
	}	

	if ($(window).width() > 1024) var items_per_row = 5;
	if ($(window).width() < 1025 && $(window).width() > 768) var items_per_row = 4;
	if ($(window).width() < 769 && $(window).width() > 480) var items_per_row = 3;
	if ($(window).width() < 481 && $(window).width() > 320) var items_per_row = 2;
	if ($(window).width() < 321) var items_per_row = 1;
	
	$('.module_portfolio_masonry .masonry_pf_item').each(function(){
		$(this).find('.portfolio_content').css('margin-top', -1*($(this).find('.portfolio_content').height()/2)+'px');
		$(this).width(Math.floor($(window).width()/items_per_row)).height($(this).find('.portfolio_item_wrapper').height());
	});	
		
	if ($('.module_portfolio_masonry').size() > 0) setTimeout("jQuery('.masonry_portfolio_block').isotope('reLayout')",500);
	if ($(window).height() > $('header').height()+$('footer').height()+$('.main_wrapper').height()+$('.pre_footer').height()+159) {
		$('.main_wrapper').css('min-height', ($(window).height()-$('header').height()-$('footer').height()-$('.pre_footer').height()-159)+'px')
	}
	//Header
	//FeedBack Form
	jQuery('.content_block').find('.form_field').each(function(){
		jQuery(this).width(jQuery(this).parent('form').width()-32);
	});	
	jQuery('.login_form').find('.form_field').each(function(){
		jQuery(this).width(jQuery(this).parent('form').width()-32);
	});	
	jQuery('.mc_input').each(function(){
		jQuery(this).width(jQuery(this).parents('.widget_mailchimpsf_widget').width()-32);
	});
	jQuery('.sidepanel').find('.field_search').each(function(){
		jQuery(this).width(jQuery(this).parent('.search_form').width()-32);
	});

	jQuery('.wpcf7-form .wpcf7-text').each(function(){
		jQuery(this).width(jQuery(this).parents('.wpcf7-form').width()-32);
	});
	jQuery('.wpcf7-form .wpcf7-textarea').each(function(){
		jQuery(this).width(jQuery(this).parents('.wpcf7-form').width()-32);
	});	

	if (jQuery('.content_block').hasClass('no-sidebar')) {
		if (jQuery('html').hasClass('user_bg_layout')) {
			jQuery('.module_line_trigger').each(function(){
				jQuery(this).css('margin-left' , -1*(jQuery('.main_wrapper').width()-jQuery('.container').width())/2+'px').width(jQuery('.main_wrapper').width());
			});
		} else {
			jQuery('.module_line_trigger').each(function(){
				jQuery(this).css('margin-left' , -1*(jQuery(window).width()-jQuery('.container').width())/2+'px').width(jQuery(window).width());
			});
		}
	}
});