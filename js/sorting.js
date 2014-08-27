/* SORTING */ 

jQuery(function(){
  var $container = $('.masonry_portfolio_block');

  $container.isotope({
	itemSelector : '.element',
	fitColumns : true
  });

  var $optionSets = $('.optionset'),
	  $optionLinks = $optionSets.find('a');

  $optionLinks.click(function(){
	var $this = $(this);
	// don't proceed if already selected
	if ( $this.parent('li').hasClass('selected') ) {
	  return false;
	}
	var $optionSet = $this.parents('.optionset');
	$optionSet.find('.selected').removeClass('selected');
	$optionSet.find('.fltr_before').removeClass('fltr_before');
	$optionSet.find('.fltr_after').removeClass('fltr_after');
	$this.parent('li').addClass('selected');
	$this.parent('li').next('li').addClass('fltr_after');
	$this.parent('li').prev('li').addClass('fltr_before');

	// make option object dynamically, i.e. { filter: '.my-filter-class' }
	var options = {},
		key = $optionSet.attr('data-option-key'),
		value = $this.attr('data-option-value');
	// parse 'false' as false boolean
	value = value === 'false' ? false : value;
	options[ key ] = value;
	if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
	  // changes in layout modes need extra logic
	  changeLayoutMode( $this, options )
	} else {
	  // otherwise, apply new options
	  $container.isotope(options);	  
	}	
	return false;	
  });
	$container.isotope('reLayout');
});



jQuery(window).load(function(){
	jQuery('.masonry_portfolio_block').isotope('reLayout');
	setTimeout("item_update()",500);
});

function item_update() {
	if ($(window).width() > 1024) var items_per_row = 5;
	if ($(window).width() < 1025 && $(window).width() > 768) var items_per_row = 4;
	if ($(window).width() < 769 && $(window).width() > 480) var items_per_row = 3;
	if ($(window).width() < 481 && $(window).width() > 320) var items_per_row = 2;
	if ($(window).width() < 321) var items_per_row = 1;

	$('.module_portfolio_masonry .masonry_pf_item').each(function(){
		$(this).find('.portfolio_content').css('margin-top', -1*($(this).find('.portfolio_content').height()/2)+'px');
		$(this).width(Math.floor($(window).width()/items_per_row)).height($(this).find('.portfolio_item_wrapper').height());
	});
	jQuery('.masonry_portfolio_block').isotope('reLayout');
}