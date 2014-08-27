jQuery('.grid_wrap').each(function() { 
		
	single =	jQuery(this).find('.singleElement');
	 	console.log(single);
	
	});

jQuery('.grid_wrap').map(function() { return jQuery(this).find('.singleElement') })