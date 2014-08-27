// for removing the dialog box for unresponsive script on ie http://stackoverflow.com/questions/4460263/disabling-the-long-running-script-message-in-internet-explorer

// to help debug ie styling issues if u have any http://www.satzansatz.de/cssd/onhavinglayout.html

var positiveWords = ['yes','most','some','rare','moderate','seen'];
var negativeWords = ['no'];
var antibodySearchTerms = ['anti','isbt','isbtno','rbc','frequency','asian','antigen','cord','cells','structure','papain','igm','igg','complement binding','htr','hdfn','compatible','caucasian','temperature','thermal','saline','degrees','degree','iat','suitable', 'elution', 'methods','method','comments'];
var antigenSearchTerms = [];
var searchRealatedActive = 0;

jQuery(document).ready(function(){
  /* SHORTCODE TABS */
  jQuery('.shortcode_tabs').each(function(index) {
    /* GET ALL HEADERS */
    var i = 1;
    jQuery(this).find('.shortcode_tab_item_title').each(function(index) {
      jQuery(this).addClass('it'+i); jQuery(this).attr('whatopen', 'body'+i);
      jQuery(this).addClass('head'+i);
      // jQuery(this).parents('.shortcode_tabs').find('.all_heads_cont').append(this);
      i++;
    });
    /* GET ALL BODY */
    var i = 1;
    jQuery(this).find('.shortcode_tab_item_body').each(function(index) {
      jQuery(this).addClass('body'+i);
      jQuery(this).addClass('it'+i);
      // jQuery(this).parents('.shortcode_tabs').find('.all_body_cont').append(this);
      i++;
    }); 
    /* OPEN ON START */
    jQuery(this).find('.expand_yes').addClass('active');
    var whatopenOnStart = jQuery(this).find('.expand_yes').attr('whatopen');
    jQuery(this).find('.'+whatopenOnStart).addClass('active');
  });
  singleElementSizeChangeAntibody(); 
  jQuery(document).on('click', '.shortcode_tab_item_title', function(){
    jQuery(this).parents('.shortcode_tabs').find('.shortcode_tab_item_body').removeClass('active');
    jQuery(this).parents('.shortcode_tabs').find('.shortcode_tab_item_title').removeClass('active');
    var whatopen = jQuery(this).attr('whatopen');
    jQuery(this).parents('.shortcode_tabs').find('.'+whatopen).addClass('active');
    jQuery(this).addClass('active');

    if (jQuery('.antigen_root_wrap').parent().hasClass('active')) {
      //jQuery('.def_header').removeClass('antibody').addClass('antigen');
      colorChangeAntigen();
      singleElementSizeChangeAntigen();
      jQuery('.antigen-adv-search').css('cssText','display:block !important');
      jQuery('.antibody-adv-search').css('display','none');
      jQuery('#search_input').val('');
      resetGridIE();
     
    }else {
      //jQuery('.def_header').removeClass('antigen').addClass('antibody');
      colorChangeAntibody();
      singleElementSizeChangeAntibody();
      jQuery('.antigen-adv-search').css('display','none');
      jQuery('.antibody-adv-search').css('display','block');
      jQuery('#search_input').val('');
      resetGridIE();
     }
  });


/* Display clear symbol on search textbox */
/*jQuery(document).on('input', '.clearable', function(){
    jQuery(this)[tog(this.value)]('x');
}).on('mousemove', '.x', function( e ){
    jQuery(this)[tog(this.offsetWidth-18 < e.clientX-this.getBoundingClientRect().left)]('onX');   
}).on('click', '.onX', function(){
    jQuery(this).removeClass('x onX').val('');
    resetGridIE();
});*/

jQuery(document).on('input', 'input#search_input', function(){
    var io = jQuery(this).val().length ? 1 : 0 ;
    jQuery(this).next('.icon_clear').stop().fadeTo(300,io);
}).on('click', '.icon_clear', function() {
    jQuery(this).delay(300).fadeTo(300,0).prev('input').val('');
    resetGrid();
});

/* Display Items in Dropdownlist in Search Textbox */
jQuery("ul.search-option").on("click", ".search-option-init", function() {
    jQuery(this).closest("ul.search-option").children("li.search-option-hidden").toggle();
});

var allOption = jQuery("ul.search-option").children("li.search-option-hidden");
jQuery("ul.search-option").on("click","li.search-option-hidden", function() {
    allOption.removeClass("selected");
    jQuery(this).addClass("selected");
    jQuery("ul.search-option").children("li.search-option-init").html(jQuery(this).html());
    allOption.toggle();
});

  // Repeting opertaion
  RepeatingOperation = function(op, yieldEveryIteration) {

    //keeps count of how many times we have run heavytask() 
    //before we need to temporally check back with the browser.
    var count = 0;   

    this.step = function() {

      //Each time we run heavytask(), increment the count. When count
      //is bigger than the yieldEveryIteration limit, pass control back 
      //to browser and instruct the browser to immediately call op() so
      //we can pick up where we left off.  Repeat until we are done.
      if (++count >= yieldEveryIteration) {
        count = 0;

        //pass control back to the browser, and in 1 millisecond, 
        //have the browser call the op() function.  
        
        setTimeout(function() { op(); }, 8, [])

        //The following return statement halts this thread, it gives 
        //the browser a sigh of relief, your long-running javascript
        //loop has ended (even though technically we havn't yet).
        //The browser decides there is no need to alarm the user of
        //an unresponsive javascript process.
        return;
        }
      op();
    };
  };

  /* Determine size of single element */
  /* END SHORTCODE TABS */ 
  // array indexOf Function is not present in ie 7 - 8
  if (!Array.prototype.indexOf) {
    Array.prototype.indexOf = function (searchElement, fromIndex) {
      if ( this === undefined || this === null ) {
        throw new TypeError( '"this" is null or not defined' );
      }

      var length = this.length >>> 0; // Hack to convert object.length to a UInt32

      fromIndex = +fromIndex || 0;

      if (Math.abs(fromIndex) === Infinity) {
        fromIndex = 0;
      }

      if (fromIndex < 0) {
        fromIndex += length;
        if (fromIndex < 0) {
          fromIndex = 0;
        }
      }

      for (;fromIndex < length; fromIndex++) {
        if (this[fromIndex] === searchElement) {
          return fromIndex;
        }
      }

      return -1;
    };
  }    
});

 // ----------------------------------------------------------
    // A short snippet for detecting versions of IE in JavaScript
    // without resorting to user-agent sniffing
    // ----------------------------------------------------------
    // If you're not in IE (or IE version is less than 5) then:
    // ie === undefined
    // If you're in IE (>=5) then you can determine which version:
    // ie === 7; // IE7
    // Thus, to detect IE:
    // if (ie) {}
    // And to detect the version:
    // ie === 6 // IE6
    // ie > 7 // IE8, IE9 ...
    // ie < 9 // Anything less than IE9
    // ----------------------------------------------------------
     //https://gist.github.com/padolsey/527683#gistcomment-7599
    // UPDATE: Now using Live NodeList idea from @jdalton
     
var ie = (function(){
 
var undef,
v = 3,
div = document.createElement('div'),
all = div.getElementsByTagName('i');
while (
div.innerHTML = '<!--[if gt IE ' + (++v) + ']><i></i><![endif]-->',
all[0]
);
return v > 4 ? v : undef;
}());

jQuery(window).load(function() {
  jQuery('#dvLoading').fadeOut(2000);
});

jQuery(document).ready(function(){
  //assignTopPositionSubWrapper();

  setupEventListeners();
  create_range_for_ie();
});

function setupEventListeners(){
  singleElementListener();
  close_all_eventListener();
  expandSingleEventListener();
  searchEventListener();
  advanceSearchListener();
  expandAdvanceSearchListener();
  reset_page();
  resetGrid();
}

function sortUsingNestedText(parent, childSelector, keySelector) {
    var items = parent.children(childSelector).sort(function(a, b) {
        var vA = jQuery(keySelector, a).text();
        var vB = jQuery(keySelector, b).text();
        return (vA < vB) ? -1 : (vA > vB) ? 1 : 0;
    });
    parent.append(items);
}

function resetGrid() {
 sortUsingNestedText(jQuery('.antibody_root_wrap'),'.antibody_outer_wrap','.isbt');
  setTimeout(function() {
    sortUsingNestedText(jQuery('.antigen_root_wrap'),'.antigen_outer_wrap','.isbt');
      // Do something after 5 seconds
  }, 5); 
  setTimeout(function() {
    sortUsingNestedText(jQuery('.antigen_other_root_wrap'),'.antigen_other_outer_wrap','.rank');
  }, 5);
  setTimeout(function() {
    sortUsingNestedText(jQuery('.antibody_other_root_wrap'),'.antibody_other_outer_wrap','.rank');
  }, 5);
}

function reset_page(){
  jQuery('#clear_search').click(function(){
    jQuery('.result').empty();
    resetGridIE();
    jQuery('#search_input').val("");
    jQuery('div.advance_search').slideUp();
  
  });
}

function create_range_for_ie() {
  jQuery('#caucasian_slider').append("Min<input name='caucasian_slider-min' type='text'> - Max<input name='caucasian_slider-max' type='text'>");
  jQuery('#asian_slider').append("Min<input name='asian_slider-min' type='text'> - Max<input name='asian_slider-max' type='text'>");
  jQuery('#thermal_slider').append("Min<input name='thermal_slider-min' type='text'> - Max<input name='thermal_slider-max' type='text'>");
}


function searchEventListener(){
  jQuery('#submit_search').click(function(e){
    jQuery('#dvLoading').show();
    e.stopPropagation();
    e.preventDefault();
    var search_text = jQuery('#search_input').val();
    resetGridForSearchIE();
    filterSearchIE(search_text);
    jQuery('#dvLoading').fadeOut(3000);
  });

  jQuery('#ih_search_form').submit(function(e){
    e.stopPropagation();
    e.preventDefault();
    var search_text = jQuery('#search_input').val();
    resetGridForSearchIE();
    filterSearchIE(search_text);
    return false;
  });

  jQuery("#search_input").keyup(function() {
    if (!this.value) {
      resetGridIE();  
    }
  });
}
function expandAdvanceSearchListener() {
  jQuery('#advance_search').click(function(){
    if(jQuery('#adv-search').css('display') == 'none'){ 
       jQuery('#adv-search').show('slow'); 
       //sliderTextChange();
       jQuery('#advance_search span').text('[-]');
    } else { 
      jQuery('#adv-search').hide('slow'); 
      jQuery('#advance_search span').text('[+]');
    }
  })
}
function toggle_sub_divs(parent){
  parent.find('.blood_group_attr').toggleClass('quad_width');
}
function expandSingleEventListener(){
  jQuery('.full_expand').click(function(){
    jQuery('.controls .full_expand').show();
    jQuery('.expand_height .singleElement').height('auto');
    var $this = jQuery(this);
    var parent = $this.parents('.grid_wrap').css({width: '100%'});    
    toggle_sub_divs(parent);
    parent.addClass('expand_height').addClass('active');
    $this.hide();
    var $expandedSection = jQuery('.grid_spacer');
      $expandedSection.html(parent).css({width: '100%', height: 'auto'});
      $expandedSection.slideDown('slow');

      var highest = 0;
      jQuery('.expand_height .singleElement').each(function() {
        if (jQuery(this).height() > highest) {
          highest = jQuery(this).height();
        }      
      });
      jQuery('.expand_height .singleElement').height(highest);
  });
}

function close_all_eventListener(){
  jQuery('.close_single').click(function(e){
    e.stopPropagation();
    e.preventDefault();
  jQuery('.ie-display').slideUp('fast',function(){
    jQuery('.ie-display .ie-title,.ie-display .ie-text, .ie-display .exp_disp').html('');
  });
  jQuery('.singleElement.sub-active').show().toggleClass('sub-active');
  });

  jQuery('.close_all').click(function(e){
    e.stopPropagation();
    jQuery('.expand_height .singleElement').height('auto');
    e.preventDefault();
    jQuery('.grid_spacer').slideUp('slow');
    var $this = jQuery(this);
    var parent = $this.parents('.grid_wrap').css('width','');
    toggle_sub_divs(parent);
    parent.removeClass('expand_height').removeClass('active');
    $this.hide();
    $this.parents('.controls').find('.full_expand').show();
    root = jQuery(parent).parents('.root_wrap');
    parent.appendTo(root);
    resetGrid();
  });
}

function singleElementListener(){
  // jQuery('.singleElement').click(function(){
  //   var $this = jQuery(this);
  //   jQuery('.ie-display .ie-title,.ie-display .ie-text, .ie-display .exp_disp').html('');
  //   jQuery('.singleElement.sub-active').show().toggleClass('sub-active');
  //   jQuery('.ie-display .ie-title').html($this.find('.blood_group_name').html());
  //   jQuery('.ie-display .ie-text').html($this.find('.blood_group_attr').html());
  //   jQuery('.ie-text .comment .desc_title').unbind('click').click(function(){
  //     jQuery(this).next('.desc_text').slideToggle('fast');
  //   });
  //   $this.toggleClass('sub-active').hide();

  //   jQuery('.ie-display').slideDown('fast',function(){
  //     jQuery('html, body').animate({
  //       scrollTop: jQuery("#ih_search_form").offset().top
  //     }, 1000); 
  //   });
  // });
  var $antibody = jQuery('.root_wrap');
  jQuery('.blood_group_name').click(function(){
    // jQuery('.sub_wrap').isotope('destroy'); 
    jQuery('.expand_height .singleElement').height('auto');
    jQuery('.activeElement').removeClass('activeElement');
    $this= jQuery(this).parents('.singleElement');
    var parent = $this.parents('.grid_wrap');

    // if (!disableOtherActive(parent)) {
      parent.toggleClass('expand_height').toggleClass('active');
      parent.find('.disp_name').toggleClass('visible').html($this.find('.blood_group_name').html());
      parent.find('.disp_text').toggleClass('visible').html($this.find('.blood_group_attr').html());
      // parent.find('.comment').toggleClass('visible').html()); 
      parent.find('.full_expand').hide();
      var singleElementName = jQuery.trim(jQuery('.expand_height .disp_name span').text());    
    jQuery('.expand_height .singleElement .blood_group_name span').each(function() {      
      if (jQuery(this).text() == singleElementName) {        
        jQuery(this).parents('.singleElement').toggleClass('activeElement');
      }
    });
    });
}
function colorChangeAntibody() {
  jQuery('.def_header').removeClass('antigen').addClass('antibody');  
  jQuery('#antibody-head-inactive').removeAttr('id').attr('id','antibody-head-active');
  jQuery('#antigen-head-active').removeAttr('id').attr('id','antigen-head-inactive');
  jQuery('form#ih_search_form #search_input').removeClass('search_input_antigen').addClass('search_input_antibody'); 
  jQuery('#submit_search').removeClass('search_submit_antigen').addClass('search_submit_antibody');
  jQuery('#adv_submit_search').css('background', '#ec1a3f');
  jQuery('.result').removeClass('result-antigen').addClass('result-antibody');
  jQuery('#advance_search').removeClass('adv-search-link-antigen').addClass('adv-search-link-antibody');
  jQuery('.search-select').removeClass('search-select-antigen').addClass('search-select-antibody');
}
function singleElementSizeChangeAntibody() {
  jQuery('.antibody_wrap').each(function() {
    if (jQuery.trim(jQuery(this).find('.blood_group_name > span').text()).length > 8) {
      jQuery(this).addClass('oversized');
      var blockWidth = jQuery(this).find('.blood_group_name').find('span').width() + 30;
      jQuery(this).css('width', blockWidth);
    } 
  });
}
function colorChangeAntigen() {
  jQuery('.def_header').removeClass('antibody').addClass('antigen');
  jQuery('#antigen-head-inactive').removeAttr('id').attr('id','antigen-head-active');
  jQuery('#antibody-head-active').removeAttr('id').attr('id','antibody-head-inactive');
  jQuery('form#ih_search_form #search_input').removeClass('search_input_antibody').addClass('search_input_antigen');  
  jQuery('#submit_search').removeClass('search_submit_antibody').addClass('search_submit_antigen');
  jQuery('#adv_submit_search').css('background', '#00A79D');
    jQuery('.result').removeClass('result-antibody').addClass('result-antigen');
  jQuery('#advance_search').removeClass('adv-search-link-antibody').addClass('adv-search-link-antigen');
  jQuery('.search-select').removeClass('search-select-antibody').addClass('search-select-antigen');
}

function singleElementSizeChangeAntigen() {
  jQuery('.antigen_wrap').each(function() {
    if (jQuery.trim(jQuery(this).find('.blood_group_name > span').text()).length > 8) {
      jQuery(this).addClass('oversized');
      var blockWidth = jQuery(this).find('.blood_group_name').find('span').width() + 30;
      jQuery(this).css('width', blockWidth);
    } 
  });
}
function sliderTextChange() {
  jQuery('.search-slider').each(function() {
    //var content = jQuery(this).html();
    //var newContent = content.replace(avoid,'-');
   // alert(newContent);
    //jQuery(this).html(newContent);
    var content = jQuery(this).contents().filter(function() {return this.nodeType === 3;}).replace('-','');
    alert(content);
  });
}
function filterSearchIE(search_text){
  var search_terms = search_text.split(' ');
  search_text = search_text.toLowerCase();
  if (search_text.indexOf('series') > 0 || search_text.indexOf('Series') > 0 || search_terms.length == 1) {
    jQuery('.blood').filter(function(index){
        if(jQuery(this).data('value').toLowerCase().indexOf(search_terms[0].toLowerCase()) != -1){
          return true;
        }
      }).closest('.grid_wrap:not(.found)').addClass('found');
    
    hideNotFoundIE();
  }
  else
  {
    if (search_text.indexOf('isbt') > -1 || search_text.indexOf('isbtno') > -1) {
      search_terms = spliceForIsbt(search_terms);
      jQuery('.isbt').filter(function(index){
        if(String(jQuery(this).data('value')).toLowerCase().indexOf(search_terms[0].toLowerCase()) > -1){
          return true;
        }
      }).closest('.grid_wrap:not(.found)').addClass('found');
      hideNotFoundIE();
    }else{
      found_objects = [];
      var keywords = findKeyWordsIE(search_terms);
      found_objects = keyWordSearchIE(keywords.foundKeyWords,keywords.search_array);
      resultDisplay(resultCount(found_objects));
      add_found_class(found_objects);
    }
  }
}

function findKeyWordsIE(search_terms){
  var spliced_search_terms = search_terms.slice(0);
  var foundKeyWords = [];
  var keywords = {};
  for (var i = search_terms.length - 1; i >= 0; i--) {
    
    for (var j = antibodySearchTerms.length - 1; j >= 0; j--) {
    
      if(antibodySearchTerms[j] == search_terms[i].toLowerCase() ){
    
        foundKeyWords.push(antibodySearchTerms[j]);

        var index = spliced_search_terms.indexOf(search_terms[i]);
        if (index > -1) {
          spliced_search_terms.splice(index, 1);
        }
      }
    };
  };
  if (foundKeyWords.length>0) {
    searchRealatedActive = 0;
    // keyWordSearchIE(foundKeyWords,spliced_search_terms);
  };
  keywords.foundKeyWords = foundKeyWords;
  keywords.search_array = spliced_search_terms;
  return keywords;
  // hideNotFoundIE();
}

function keyWordSearchIE(foundKeyWords,search_array){
  var search_word='';
  // var found_objects = [];
  for (var i = foundKeyWords.length - 1; i >= 0; i--) {
    search_word = foundKeyWords[i].replace(/ /g,'.');
    for (var j = search_array.length - 1; j >= 0; j--) {
      jQuery('.'+search_word).each(function(i){
        if(String(jQuery(this).data('value')).toLowerCase().indexOf(search_array[j]) != -1){

          var search_data = String(jQuery(this).data('value')).toLowerCase().split(' ');
          for(var k = search_data.length-1; k >= 0 ; k-- ){
            if(search_data[k] == search_array[j].toLowerCase()){
             // console.log(jQuery(this));
              found_objects.push(jQuery(this));
            }
          }
        }
      });
      //search for positive and negative words
      if (searchRealatedActive != 1) {
        searchRealatedActive = 1;
        searchRelatedWordsIE(foundKeyWords,search_array[j].toLowerCase(),search_array);
      };
    }; 
  };
 
  return found_objects;
}

function resetGridForSearchIE(){
  jQuery('.singleElement').show().removeClass('found found2');
  jQuery('.grid_wrap').show().removeClass('found'); 
  resetGrid();
}

function resetGridIE(){
  jQuery('.singleElement').show().removeClass('found found2');
  jQuery('.grid_wrap').show().removeClass('found'); 
  resetGrid();
 // assignTopPositionSubWrapper();
}

function hideNotFoundIE(){
  if (jQuery('.grid_wrap').filter('.found').length < 1 && jQuery('.singleElement.found').length < 1) {
  //search term not found. Don't hide
  resetGridIE();
  }else{
    if (jQuery('.grid_wrap.found').length > 0 && jQuery('.singleElement.found').length < 1) {
      //single blood group search
      jQuery('.grid_wrap:not(.found)').hide();
    }else{
      //only show search if there are more than one key words
      showOnlyRelatedSearchIE();
      jQuery('.grid_wrap:not(.found)').hide();
      jQuery('.singleElement:not(.found)').hide();
      jQuery('.grid_wrap.found').each(function(){
        if (jQuery(this).find('.singleElement.found').length < 1 ) {
          jQuery(this).removeClass('found').hide();
        };
      });
    }
    assignTopPositionSubWrapper();
  }
}

function searchRelatedWordsIE(foundKeyWords,word,search_array){
 
  if (positiveWords.indexOf(word) != -1) {
    searchRealatedActive = 1;
    for (var i = positiveWords.length - 1; i >= 0; i--) {
      //remove first Element which has already been searched
      search_array.shift();
      search_array.unshift(positiveWords[i])
      keyWordSearchIE(foundKeyWords,search_array);
    };
  }
}

function showOnlyRelatedSearchIE(){
  if (jQuery('.singleElement.found2').length > 0) {
    jQuery('.singleElement.found:not(.found2)').removeClass('found').hide();
  };
}

function assignTopPositionSubWrapper(){
  jQuery('.sub_wrap').each(function(){
    $this = jQuery(this);
    if (!$this.parents('.grid_wrap').hasClass('active') && !$this.parents('.grid_wrap').hasClass('expanded')) {
      var children = 0;
      if ($this.parents('.grid_wrap').hasClass('found')) {
        children = $this.children().filter(':visible').length;
      }else{
       children = $this.children().length;
      }
      if (children < 10) {
      
        if(children <= 5)//one line of antigens
        {
          $this.css('bottom','10%');
        }
        else if (children <= 9) { //two lines of anigens
          $this.css('top','18%');
        };
      }else{
        $this.css('top','0');
      }
    }else{
      $this.css('top','0');
    }
  });
}

function spliceForIsbt(searchTerms){
  for (var i = searchTerms.length - 1; i >= 0; i--) {
    searchTerms[i] = searchTerms[i].toLowerCase();
  };
  var index = searchTerms.indexOf('isbt');
  if (index > -1) {
    searchTerms.splice(index, 1);
  }
  index = searchTerms.indexOf('isbtno');
  if (index > -1) {
    searchTerms.splice(index, 1);
  }
  return searchTerms;
}

function resultCount(found_objects){
  var antigen_count = 0;
  var antibody_count =0;
  result_count = {};
  for(var i =0; i< found_objects.length; i++)
  {
    if(jQuery(found_objects[i]).closest('.grid_wrap').hasClass('antigen_outer_wrap') || jQuery(found_objects[i]).closest('.grid_wrap').hasClass('antigen_other_outer_wrap')) {
      ++antigen_count;
    } else if (jQuery(found_objects[i]).closest('.grid_wrap').hasClass('antibody_outer_wrap') || jQuery(found_objects[i]).closest('.grid_wrap').hasClass('antibody_other_outer_wrap')) {
      ++antibody_count;
    }
  }
  result_count.antigen_count = antigen_count;
  result_count.antibody_count = antibody_count;
  return result_count;
}

function resultFound(no_of_result){
  jQuery('.result').empty();
  if ((no_of_result == 0) || (no_of_result == ""))
  {
    jQuery('.result').append("No Result found");
  }else {
    jQuery('.result').append(no_of_result +" results found");
  }
}

function resultDisplay(result_count){
  jQuery('.result').empty();
  
  if (((result_count.antigen_count == 0) || (result_count.antigen_count == "") ) && ((result_count.antibody_count == 0) || (result_count.antibody_count == "")))
  {
    jQuery('.result').append("No Result found");
  }else {
    jQuery('.result').append(result_count.antigen_count + " Antigen Characteristics & "+ result_count.antibody_count+" Antibody Characteristics "  +"found.");
  }
}

function add_found_class(found_objects) { 
  var i = 0;
  var ro = new RepeatingOperation(function() {   
      jQuery(found_objects[i]).closest('.singleElement:not(.found)').add('.grid_wrap:not(.found)').addClass('found');
    if (++i < found_objects.length) { 
      ro.step(); 
    } else { hideNotFoundIE(); }
  }, 2);
  ro.step();
}

function advanceSearchListener(){
  
  jQuery('#adv_submit_search').click(function(e){
    jQuery('#dvLoading').show();
    e.stopPropagation();
    e.preventDefault();
    resetGridIE();
    searchRealatedActive = 0;
    advance_search();
    jQuery('#dvLoading').fadeOut(2000);
    return false;
  });
}

function advance_search() {
  var keywords = [];
  var ranges = [];
  found_objects = [];
  Result_count = 0;
  jQuery('div.advance_search input').each(function(){
    if (jQuery(this).attr('type') != 'radio') {
  
    }else if (jQuery(this).is(':checked')) {
  
      var keyword = { key: jQuery(this).attr('name'), value: jQuery(this).val() } 
      keywords.push(keyword)
    };
  });
  jQuery('div.advance_search select').each(function(){
    var keyword = { key: jQuery(this).attr('name'), value: jQuery(this).val() } 
    keywords.push(keyword)
  });
 
  var temp_range  = {};
  temp_range.key = 'thermal';
  temp_range.min = parseInt(jQuery("input[name=thermal_slider-min]").val());
  temp_range.max = parseInt(jQuery("input[name=thermal_slider-max]").val());
  ranges.push(temp_range);
  temp_range.key = 'caucasian';
  temp_range.min = parseInt(jQuery("input[name=caucasian_slider-min]").val());
  temp_range.max = parseInt(jQuery("input[name=caucasian_slider-max]").val());
  ranges.push(temp_range);
  temp_range.key = 'asian';
  temp_range.min = parseInt(jQuery("input[name=asian_slider-min]").val());
  temp_range.max = parseInt(jQuery("input[name=asian_slider-max]").val());
  ranges.push(temp_range);

  
  found_objects = keyValueSearch2(keywords, ranges);
  // setTimeout(function() {
    resultDisplay(resultCount(found_objects));
    add_found_class(found_objects);
  // }, 5);
}

function keyValueSearch2(isbt_options, isbt_range){
  found_objects = [];
  result = 0;
  jQuery('.grid_wrap').each(function(index){
    // setTimeout(function() {
      jQuery(this).find('.singleElement').each(function(sindex){
        var flag = true;
        
        for (var i=0; i < isbt_options.length; i++)
        {
          if (!keyValueSingleElementSearch(isbt_options[i].key, isbt_options[i].value, jQuery(this)))
          {
            flag = false;
          } 
        }

        for (var i=0; i < isbt_range.length; i++)
        { 
          if (!keyValueRangeSearch(isbt_range[i].key,isbt_range[i].min, isbt_range[i].max, jQuery(this)))
          {
            flag = false;
          }
        }
        if (flag) {
          found_objects.push(jQuery(this));
        }
      })  
    // }, 3);
  });
  return found_objects;
}

function isbtOptionCheck(isbt_options, object) {
  var flag = true;
  var i=0
  var ro = new RepeatingOperation(function() {  
    if (!keyValueSingleElementSearch(isbt_options[i].key, isbt_options[i].value, jQuery(object)))
    {
      flag = false;
    } 
    if (++i < isbt_options.length) { 
      ro.step(); 
    } else { return flag; }
  }, 10);
  ro.step();
}

function isbtRangeCheck(isbt_range, object) {
  var flag = true;
  var i=0
  var ro = new RepeatingOperation(function() {  
    if (!keyValueRangeSearch(isbt_range[i].key,isbt_range[i].min, isbt_range[i].max, jQuery(object)))
    {
      flag = false;
    } 
    if (++i < isbt_range.length) { 
      ro.step(); 
    } else { return flag; }
  }, 10);
  ro.step();
}


function keyValueSingleElementSearch(key, value, object){
  value = value.toLowerCase();
  compare_value = 'no';
  var search_word=''; 
  var flag = false; 
  search_word = key.replace(/ /g,'');
  if (jQuery(object).find('.'+search_word).length == 0) {
    flag = true;
  }else {
    jQuery(object).find('.'+search_word).each(function(){
      original_value = String(jQuery(this).data('value')).toLowerCase();
      if (original_value.indexOf("no") > -1) {
        compare_value = 'no';
      }else {
        compare_value = 'yes';
      }

      if(compare_value.indexOf(value) == 0){
      //if(String(jQuery(this).data('value')).toLowerCase().indexOf(value) > -1){
        flag = true;
      }else{ 
        flag = false;
      }
    });
  }
  return flag;
}

function myTrim(x) {
  return x.replace(/[^\d+.\d\s+]/gi,'');
}

function keyValueRangeSearch(key, min, max, object){
  
  var search_word=''; 
  var flag = false; 
  var original_max = 100; 
  var original_min = 0;
  var range = "";
  given_min = min; given_max = max;
  // console.log(key);
  if (jQuery(object).find('.'+key).length == 0) {
    flag = true;
  }else {
    jQuery(object).find('.' + key).each(function(tindex){
      range = jQuery(this).data('value');
      range = String(range);
      range = myTrim(range);
      range = jQuery.map(range.split(" "), Number);
      range = range.sort(function(a, b){return a-b});

      switch(range.length) {
        case 0:
          original_max = 100; original_min = 0;
          break;
        case 1:
          original_max = range[0]; original_min = range[0];
          break;
        case 2:
          original_max = range[1]; original_min = range[0];
          break;
        default:
          original_max = 100; original_min = 0;
      }
      if ( ((given_min >= original_min) && (given_min <= original_max)) || ((given_max >= original_min) && (given_max <= original_max)) || ((original_min >= given_min) && (original_min <= given_max)) ) {
        flag = true;
      }else {
        flag = false;
      } 
       // console.log (key + range + "| O_MIN: " + original_min + " O_MAX: " + original_max + ' given_min:' + given_min + ' given_max: ' + given_max +"  Result:" + flag );
    });
  } 
  
  return flag;
}