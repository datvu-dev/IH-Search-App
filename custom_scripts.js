
registerFunctionsForIe();
var positiveWords = ['yes','most','some','rare','moderate','seen','unknown','occasional', 'weak', 'strong'];
var negativeWords = ['no', 'No'];
var antibodySearchTerms = ['anti','isbt','isbtno','rbc','frequency','asian','antigen','cord','cells','structure','papain','igm','igg','complement binding','htr','hdfn','compatible','caucasian','temperature','thermal','saline','degrees','degree','iat','suitable', 'elution', 'methods','method','comments'];
var antigenSearchTerms = [];
var found_objects = [];
var searchRealatedActive = 0;
var resultCount = 0;
var positive_string = 'yes most some rare moderate seen occasional unknown';
var stopWords = ['i','a','about','an','and','are','as','at','be','by','com','de','en','for','from','how','in','is','it','la','of','on','or','that','the','this','to','was','what','when','where','who','will','with','und','the','www'];
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
(function() {
  if (!window.console) {
    window.console = {};
  }
  // union of Chrome, FF, IE, and Safari console methods
  var m = [
    "log", "info", "warn", "error", "debug", "trace", "dir", "group",
    "groupCollapsed", "groupEnd", "time", "timeEnd", "profile", "profileEnd",
    "dirxml", "assert", "count", "markTimeline", "timeStamp", "clear"
  ];
  // define undefined methods as noops to prevent errors
  for (var i = 0; i < m.length; i++) {
    if (!window.console[m[i]]) {
      window.console[m[i]] = function() {};
    }    
  } 
})();
       
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
  singleElementSizeChange();
  bloodGroupNameAlignment();
  jQuery(document).on('click', '.shortcode_tab_item_title', function(){
    jQuery(this).parents('.shortcode_tabs').find('.shortcode_tab_item_body').removeClass('active');
    jQuery(this).parents('.shortcode_tabs').find('.shortcode_tab_item_title').removeClass('active');
    var whatopen = jQuery(this).attr('whatopen');
    jQuery(this).parents('.shortcode_tabs').find('.'+whatopen).addClass('active');
    jQuery(this).addClass('active');

    if (jQuery('.antigen_root_wrap').parent().hasClass('active')) {      
      colorChangeAntigen();
      //singleElementSizeChangeAntigen();
      var o = new Option("Antigen", "antigen");
      jQuery(o).html("Antigen");
      jQuery("#search_option").append(o);
      jQuery("#search_option option[value='antibody']").remove();      
      jQuery('#search_input').val('');
      resetGrid();
      
    }else
    {
      colorChangeAntibody();
      //singleElementSizeChangeAntibody();
      jQuery("#search_option option[value='antigen']").remove();
      jQuery('.antibody-adv-search').css('display','block');
      var o = new Option("Antibody", "antibody");
      jQuery(o).html("Antibody");
      jQuery("#search_option").append(o);
      jQuery('#search_input').val('');
      resetGrid();
    }
    if (!ie || ie >= 8) {
      //jQuery('.root_wrap').isotope('layout');
      
    }

  });
  /* END SHORTCODE TABS */ 


  (function($) {
    window.q = {
      // An empty jQuery object safely not bound to a DOM element.
      jq: $({}),
      // This should be 12-50.
      wait: 15,
      // This is arbitrary but shouldn't change, just don't call it 'fx'.
      queueName: 'default',
      // My bastard child of _.delay and $.queue()
      queue: function (func) {
        var args = Array.prototype.slice.call(arguments, 1);
        return this.jq.queue(this.queueName, function (next) {
          return func.apply(null, args);
        });
      },
      dequeue: function () {
        setTimeout(this._dequeue, this.wait);
      },
      _dequeue: function () {
        // At this point "this" is now the window.
        // Asynchronous functions are weird.
        _this = window.q;
        _this.jq.dequeue(_this.queueName);

        // If there's something left in the queue, schedule a dequeue().
        if (_this.jq.queue(_this.queueName).length) {
          _this.dequeue();
        }
      }
    };

    // Automatically run dequeue on document ready and window load as these are
    // the two events most likely to be used for queue().
    $(function(){
      window.q.dequeue();
    });

    $(window).load(function(){
      window.q.dequeue();
    });
  })(jQuery);

/* Display clear symbol on search textbox */
/*jQuery(document).on('input', 'input#search_input', function(){
    var io = jQuery(this).val().length ? 1 : 0 ;
    jQuery(this).next('.icon_clear').stop().fadeTo(300,io);
}).on('click', '.icon_clear', function() {
    jQuery(this).delay(300).fadeTo(300,0).prev('input').val('');
    resetGrid();
});*/

jQuery(document).on('input keyup keypress', 'input#search_input', function() {
    var len = jQuery(this).val().length;
    if (len > 0) {
      jQuery(this).next('.icon_clear').show();
    }
    else {
      jQuery(this).next('.icon_clear').hide();
    }
}).on('click','.icon_clear', function() {
    jQuery('input#search_input').val('');
    jQuery('.icon_clear').hide();
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

var columns;


// rerun function when window is resized 
jQuery(window).on('resize', function() {
  setColumns();
});

// the function to decide the number of columns
function setColumns() {
  if(jQuery(window).width() <= 650) {
    columns = 1;
  } else if((jQuery(window).width() >= 651) && (jQuery(window).width() <= 979))  {
    columns = 2;
  }
  else {
    columns = 3;
  }
}

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
        // alert("braek");
        setTimeout(function() { op(); }, 10, [])

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
  
});


if (ie && ie < 8) {}else {
  //not IE 7 load isotope and continue as normal
  //loadjscssfile("wp-content/themes/gt3-wp-trend/js/isotope.pkgd.min.js", "js");
    jQuery(document).ready( function(){ checkIsotope(); });
  }//end if ie > 8

  function checkIsotope(){
    if (typeof(Isotope) === "function") {
    init();
  }else{
    setTimeout(checkIsotope,100);
  }
}

function init(){
  
  var $antibody = jQuery('.antibody_root_wrap');
  $antibody.isotope({
    // options
    itemSelector: '.grid_wrap',
    transitionDuration: '0.7s',
    layoutMode: 'masonry',
    getSortData: {
      isbtno: '.isbtno',
      name: '.name'
    },
    masonry: {
      gutter:17,
      columnWidth: '.column-width-isotope'
    }
  });


  var $antigen = jQuery('.antigen_root_wrap');
  $antigen.isotope({
    // options
    itemSelector: '.grid_wrap',
    transitionDuration: '0.7s',
    layoutMode: 'masonry',
    getSortData: {
      isbtno: '.isbtno',
      name: 'name'
    },
    masonry: {
      gutter:17,
      // rowHeight:'.grid_spacer',
      columnWidth: '.column-width-isotope'
    }
  });

  var $antigenother = jQuery('.antigen_other_root_wrap');
   $antigenother.isotope({
    // options
    itemSelector: '.antigen_other_outer_wrap',
    transitionDuration: '0.7s',
    layoutMode: 'masonry',
    getSortData: {
      isbtno: '.isbtno',
      name: 'name',
      rank: '.rank'
    },
    masonry: {
      gutter:17,
      // rowHeight:'.grid_spacer',
       columnWidth: '.column-width-isotope'
    }
  });

   var $antibodyother = jQuery('.antibody_other_root_wrap');
   $antibodyother.isotope({
    // options
    itemSelector: '.antibody_other_outer_wrap',
    transitionDuration: '0.7s',
    layoutMode: 'masonry',
    getSortData: {
      isbtno: '.isbtno',
      name: 'name',
      rank: '.rank'
    },
    masonry: {
      gutter:17,
      // rowHeight:'.grid_spacer',
       columnWidth: '.column-width-isotope'
    }
  });
  jQuery('.antibody_root_wrap').isotope({ sortBy: 'isbtno' });
  jQuery('.antibody_other_root_wrap').isotope({ sortBy: 'rank' });
  jQuery('.antigen_root_wrap').isotope({ sortBy: 'isbtno' });
  jQuery('.antigen_other_root_wrap').isotope({ sortBy: 'rank' });
  registerClickFunctions();

  assignTopPositionSubWrapper();
}

function assignTopPositionSubWrapper(){
  jQuery('.sub_wrap').each(function(){

    $this = jQuery(this);
    if (!$this.parents('.grid_wrap').hasClass('active') && !$this.parents('.grid_wrap').hasClass('expanded')) {
      var children = 0;
      var isbtname_length = 0;
      isbtname = $this.parents('.grid_wrap').find('.name').data('value');
      isbtname_length = isbtname.split(" ").length;
        if ($this.parents('.grid_wrap').hasClass('found')) {
          children = $this.find('.singleElement').filter(':visible').length;
        }else{
          children = $this.find('.singleElement').length;
        }
      };
    //console.log(children + '::'+ $this.find('.singleElement').first().attr('class'));
      $this.css('bottom','10%');
      /*if (children < 10) {
        //pos = children/4;
        if((children <= 5) && (isbtname_length < 2))//one line of antigens
        {
          $this.css('bottom','10%');
        }
        else if((children <= 9)  && (isbtname_length < 2)) { //two lines of anigens
          $this.css('bottom','10%');
        };
      }else{
        $this.css('top','0');
      }
    }else{
      $this.css('top','0');
    }*/
  
});
}
function registerClickFunctions(){
  window.q.queue(advanceSearchListener);
  window.q.queue(searchButtonClick);
  window.q.queue(singleElementClickFunction);
  //clear search input and reset grid
  jQuery('#clear_search').click(function(){
    jQuery('.expand4 .close_all').trigger('click');
    jQuery('.result').hide();
     resetGrid();
     jQuery('#search_input').val("");
     jQuery('#ih_search_form').trigger("reset");
     resetAdvanceSearch();
     //jQuery('div.advance_search').slideUp();
  
  });

  jQuery('.logo').click(function(){
    jQuery('.result').hide();
     resetGrid();
     jQuery('#search_input').val("");
     jQuery('#ih_search_form').trigger("reset");
     resetAdvanceSearch();
     
     jQuery('div.advance_search').slideUp();
  
  });
  jQuery('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = jQuery(this.hash);
      target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        jQuery('html,body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
  jQuery('.close_all').click(function(e){
    e.stopPropagation();    
    jQuery('.controls .full_expand').show();
    jQuery('.expand4 .singleElement').height('auto');
    if (jQuery('.root_wrap').find('.grid_wrap.expand4').length>0){
      close_other_wrappers();
      // if (jQuery('.sub_wrap').data('isotope')) {
      // console.log('close click')
      jQuery('.sub_wrap').isotope('destroy');
      // };
      //jQuery('.sub_wrap .singleElement').css( {position:'relative',left:'auto',top:'auto'} );
    }
    jQuery(this).closest('.controls').find('.full_expand').show();
    $antibody = jQuery('.root_wrap');
    $antibody.find('.grid_wrap.active').toggleClass('active').toggleClass('expand_height').find('.disp_name,.disp_text').toggleClass('visible');
    assignTopPositionSubWrapper();
    $antibody.isotope('layout');
    return false;
  });

  jQuery('.full_expand').click( function(e){
    
    e.stopPropagation();
    jQuery('.expand4 .close_all').trigger('click');
    jQuery('.expand_height .close_all').trigger('click');
    $this = jQuery(this);
    $antibody = jQuery('.root_wrap');
    close_other_wrappers();
    console.log($this.parents('.grid_wrap').find('.singleElement').length);
    if ($this.parents('.grid_wrap').find('.singleElement:visible').length > 1 ) {      
      var parent = $this.parents('.grid_wrap').addClass('expand4').addClass('expanded');
      toggle_sub_divs(parent);
      assignTopPositionSubWrapper();

      sub_wrap = jQuery('.grid_wrap.expand4 .sub_wrap');
      sub_wrap.isotope({
        itemSelector: '.singleElement',
        transitionDuration: '0.7s',
        layoutMode: 'masonry',
        masonry: {
          gutter:15,
          columnWidth:'.grid_spacer_single_element'
        }      
      });
      jQuery(this).hide();
    
    
      var highest = 0;
      jQuery('.expand4 .singleElement').each(function() {
        if (jQuery(this).height() > highest) {
          highest = jQuery(this).height();
        }      
      });
      jQuery('.expand4 .singleElement').height(highest);      

      $antibody.isotope('layout');

      jQuery('html,body').animate({
        scrollTop: jQuery(this).parents('.grid_wrap').offset().top
      }, 1000);    
    
    }
    else if ($this.parents('.grid_wrap').find('.singleElement:visible').length == 1) {
      $this.parents('.grid_wrap').find('.singleElement .blood_group_name').trigger('click');
    }
    //jQuery(this).trigger('click');
    return false;
  });

  //reset page on clear search input
  jQuery("#search_input").keyup(function() {
    if (!this.value) {
        resetGrid();
    }
  });

  //comment show 
  jQuery('.comment .desc_title').click(function(){
    jQuery(this).next('.desc_text').slideToggle('fast',function(){
      jQuery('.grid_wrap.expand4 .sub_wrap').isotope('layout');
      jQuery('.root_wrap').isotope('layout');
      if (jQuery(this).is(':visible')) {
          jQuery(this).prev().find('span').text('[-]');

        }
        else {
          jQuery(this).prev().find('span').text('[+]');
        }
    });
  });
}

function advanceSearchListener(){
  jQuery('#advance_search').click(function(){
    jQuery('div.advance_search').slideToggle(function() {
      if (jQuery(this).is(':visible')) {
        jQuery('#advance_search span').text('[-]');
      } else {
        jQuery('#advance_search span').text('[+]');
      }
    });
  });

  jQuery('#adv_submit_search').click(function(e){
    jQuery('#dvLoading').show();    
    e.stopPropagation();
    e.preventDefault();
    resetGridForSearch();
    searchRealatedActive = 0;
    advance_search();
    // hideNotFound();
    jQuery('#dvLoading').fadeOut(2000);
    return false;
  });
}


function advance_search() {
  // console.log("Advance search start");
  var keywords = [];
  var ranges = [];
  found_objects = [];
  Result_count = 0;
  jQuery('div.advance_search input').each(function(){
    if (jQuery(this).attr('type') != 'radio') {
      // console.log(jQuery(this).attr('name')+': '+jQuery(this).val());
    }else if (jQuery(this).is(':checked')) {
      // console.log(jQuery(this).attr('name')+':'+jQuery(this).val());
      var keyword = { key: jQuery(this).attr('name'), value: jQuery(this).val() } 
      keywords.push(keyword)
    };
  });
  jQuery('div.advance_search select').each(function(){
    var keyword = { key: jQuery(this).attr('name'), value: jQuery(this).val() } 
    keywords.push(keyword)
  });
 
  jQuery('div.advance_search #thermal_slider').each(function() {
    var temp_range = {};
   jQuery(this).find('.tooltip').each(function() {
     temp_range.key = "thermal";
     if (jQuery(this).find('.min').length > 0) {
       temp_range.min = jQuery(this).find('.min').text();
      }
         if ( jQuery(this).find('.max').length > 0) {   
       temp_range.max = jQuery(this).find('.max').text();
     }
   });
   // console.log(temp_range.key + " - " + temp_range.min + " - " + temp_range.max);
   ranges.push(temp_range);
  });

  jQuery('div.advance_search #caucasian_slider').each(function() {
    var range = {};
   jQuery(this).find('.tooltip').each(function() {
     
      range.key = 'caucasian';
     if (jQuery(this).find('.min').length > 0) {
       range.min = jQuery(this).find('.min').text();
      }
         if ( jQuery(this).find('.max').length > 0) {   
       range.max = jQuery(this).find('.max').text();
     }
   });
   ranges.push(range);
  });

  jQuery('div.advance_search #antibody_caucasian_slider').each(function() {
    var range = {};
   jQuery(this).find('.tooltip').each(function() {
     
      range.key = 'antigen_caucasian';
     if (jQuery(this).find('.min').length > 0) {
       range.min = jQuery(this).find('.min').text();
      }
         if ( jQuery(this).find('.max').length > 0) {   
       range.max = jQuery(this).find('.max').text();
     }
   });
   ranges.push(range);
  });

  jQuery('div.advance_search #asian_slider').each(function() {
    var range = {};
   jQuery(this).find('.tooltip').each(function() {
     
      range.key = 'asian';
     if (jQuery(this).find('.min').length > 0) {
       range.min = jQuery(this).find('.min').text();
      }
         if ( jQuery(this).find('.max').length > 0) {   
       range.max = jQuery(this).find('.max').text();
     }
   });
   // console.log(range.key + " - " + range.min + " - " + range.max);
   ranges.push(range);
  });
  //console.log(keywords)
  //console.log(ranges)
  found_objects = keyValueSearch2(keywords, ranges);
  console.log(found_objects.length);
  resultDisplay(resultCount(found_objects));
  add_found_class(found_objects);
  //console.log(found_objects);
  // resultCount(found_objects);

}

function singleElementClickFunction(){

  var $antibody = jQuery('.root_wrap');
  jQuery('.blood_group_name').click(function(){    
    jQuery('.expand_height .full_expand').show();
    jQuery('.expand4 .close_all').trigger('click');
    jQuery('.activeElement').removeClass('activeElement');
    jQuery('.sub_wrap').isotope('destroy'); 
    $this= jQuery(this).parents('.singleElement');
    var parent = $this.parents('.grid_wrap');

    if (!disableOtherActive(parent)) {
      parent.toggleClass('expand_height').toggleClass('active');
      parent.find('.disp_name').toggleClass('visible').html($this.find('.blood_group_name').html());
      parent.find('.disp_text').toggleClass('visible').html($this.find('.blood_group_attr').html());

      
    }
    else
    {
      parent.find('.disp_name').html($this.find('.blood_group_name').html());
      parent.find('.disp_text').html($this.find('.blood_group_attr').html());
      
    }
    expandHeightAlignment();

    //comment show 
    jQuery('.disp_text .comment .desc_title').click(function(){
      jQuery(this).next('.desc_text').slideToggle('fast',function(){
        jQuery('.root_wrap').isotope('layout');
        if (jQuery(this).is(':visible')) {
          jQuery(this).prev().find('span').text('[-]');

        }
        else {
          jQuery(this).prev().find('span').text('[+]');
        }
      });
    });
    jQuery(parent).find('.full_expand').hide();
    var singleElementName = jQuery.trim(jQuery('.expand_height .disp_name span').text());    
    jQuery('.expand_height .singleElement .blood_group_name span').each(function() {      
      if (jQuery(this).text() == singleElementName) {        
        jQuery(this).parents('.singleElement').toggleClass('activeElement');
      }
    });

    assignTopPositionSubWrapper();
    $antibody.isotope('layout');

  });
}

function colorChangeAntibody() {
  jQuery('body').removeClass('antigen_content_body').addClass('antibody_content_body');
  jQuery('.pre_footer a').css('color','#ec1a3f');
  jQuery('.def_header').removeClass('antigen').addClass('antibody');  
  jQuery('#antibody-head-inactive').removeAttr('id').attr('id','antibody-head-active');
  jQuery('#antigen-head-active').removeAttr('id').attr('id','antigen-head-inactive');
  jQuery('form#ih_search_form #search_input').removeClass('search_input_antigen').addClass('search_input_antibody'); 
  jQuery('#submit_search').removeClass('search_submit_antigen').addClass('search_submit_antibody');
  jQuery('#adv_submit_search').css('background', '#ec1a3f');
  jQuery('#clear_search').css('background','#ec1a3f');
  jQuery('.result').removeClass('result-antigen').addClass('result-antibody');
  jQuery('#advance_search').removeClass('adv-search-link-antigen').addClass('adv-search-link-antibody');
  jQuery('#dvLoading').removeClass('antigen-load').addClass('antibody-load');
  jQuery('.search-select').removeClass('search-select-antigen').addClass('search-select-antibody');
}
function singleElementSizeChange() {
  jQuery('.singleElement').each(function() {
    if (jQuery.trim(jQuery(this).find('.blood_group_name > span').text()).length > 8) {
      //alert(jQuery.trim(jQuery(this).find('.blood_group_name > span').text()));
      jQuery(this).removeClass('oversized').addClass('oversized');
      //jQuery(this).hide();
      //var blockWidth = jQuery(this).find('.blood_group_name').find('span').width() + 30;
      //jQuery(this).css('width', blockWidth);
    } 
  });
}
function colorChangeAntigen() {
  jQuery('body').removeClass('antibody_content_body').addClass('antigen_content_body');
  jQuery('.pre_footer a').css('color','#00A79D');
  jQuery('.def_header').removeClass('antibody').addClass('antigen');
  jQuery('#antigen-head-inactive').removeAttr('id').attr('id','antigen-head-active');
  jQuery('#antibody-head-active').removeAttr('id').attr('id','antibody-head-inactive');
  jQuery('form#ih_search_form #search_input').removeClass('search_input_antibody').addClass('search_input_antigen');  
  jQuery('#submit_search').removeClass('search_submit_antibody').addClass('search_submit_antigen');
  jQuery('#adv_submit_search').css('background', '#00A79D');
  jQuery('#clear_search').css('background','#00A79D');
  jQuery('.result').removeClass('result-antibody').addClass('result-antigen');
  jQuery('#advance_search').removeClass('adv-search-link-antibody').addClass('adv-search-link-antigen');
  jQuery('#dvLoading').removeClass('antibody-load').addClass('antigen-load');
  jQuery('.search-select').removeClass('search-select-antibody').addClass('search-select-antigen');
}

/*function singleElementSizeChangeAntigen() {
  jQuery('.antigen_wrap').each(function() {
    if (jQuery.trim(jQuery(this).find('.blood_group_name > span').text()).length > 8) {
      jQuery(this).addClass('oversized');
      //var blockWidth = jQuery(this).find('.blood_group_name > span').width() + 70;
      //jQuery(this).css('width', blockWidth);
    } 
  });
}*/
function bloodGroupNameAlignment() {
  jQuery('.blood_group_name').each(function() {
    if (jQuery(this).find('span').find('sup').text() != '') {      
      jQuery(this).css('line-height', '23px');
    }
    else {
      jQuery(this).css('line-height', '32px');
    }
  });
  
}
function expandHeightAlignment() {
  jQuery('.expand_height .disp_name').each(function() {
    if (jQuery(this).find('span').find('sup').text() != '') {      
      //alert(jQuery(this).find('span').find('sup').text());
      jQuery(this).css('line-height', '20px');
    }
    else {
      jQuery(this).css('line-height', '27px');
    }
  });
}

function tog(v){
  return v?'addClass':'removeClass';
} 
function toggle_sub_divs(parent){
  parent.find('.blood_group_attr').toggleClass('quad_width');
}
   
function disableOtherActive(parent){
  if(parent.hasClass('active')){
    return parent.hasClass('active');
  }
  else
  {
    close_other_wrappers();
    return false;
  }

}

function close_other_wrappers(){
  if (jQuery('.root_wrap').find('.grid_wrap.active').length>0) {
    jQuery('.root_wrap').find('.grid_wrap.active').toggleClass('active').toggleClass('expand_height').find('.disp_name,.disp_text').toggleClass('visible');
    
  }
  else if (jQuery('.root_wrap').find('.grid_wrap.expand4').length>0) 
  {
    var parent = jQuery('.root_wrap').find('.grid_wrap.expand4').toggleClass('expand4 expanded');
    toggle_sub_divs(parent);
  };
}

function searchButtonClick(){
  
  jQuery('#submit_search').click(function(e){
    jQuery('#ih_search_form').trigger('submit');
  });

  jQuery('#ih_search_form').submit(function(e){
    jQuery('#dvLoading').show();
    jQuery('.expand4 .close_all').trigger('click');
    jQuery('.expand_height .close_all').trigger('click');
    e.preventDefault();
    e.stopPropagation();
    search_text = jQuery('#search_input').val();
    search_option = jQuery('#search_option').val();
    console.log(search_option);
    resetGridForSearch();
    close_other_wrappers();
    if (search_text.replace(/ /g,'').length > 0) {
      filterSearchWithOption(search_text, search_option);
      console.log("Search text:" + search_text);
    };
    hideNotFound();
    if (resultCount == 0) {
      jQuery('.result').show();
    }
    jQuery('#dvLoading').fadeOut(2000);
    //alert(resultCount);
    return false;
  });
}

/*function searchWithOptions(search_text, option){
  switch(option) {
        case 'isbt':
          filterSearch(search_text);
          break;
        case 'isbtno':
          filterSearch(search_text);
          break;
        case 'comment':
          searchInComments(search_text);
          break;
        default:
          filterSearch(search_text);
      }
      
}*/

function findIsbt(search_text){
  search_text = search_text.toLowerCase();
  search_text = search_text.replace("-", " ");
  var search_terms = search_text.split(' ');
  console.log(search_terms)
  search_terms = spliceForIsbt(search_terms);
      jQuery('.isbt').filter(function(index){
        if(String(jQuery(this).data('value')).indexOf(search_terms[0]) > -1){
        console.log(jQuery(this).data('value'));
          
          return true;
        }
      }).closest('.grid_wrap:not(.found)').addClass('found');
     // hideNotFound();
}

// function oldSearch(search_text){
//   if (search_text.length>1) {
//     var searchInput = filterSearchTerms(search_text);

//     if (searchInput == -1) {
//       var nodesFound = getTextNodesIn2('.grid_wrap');
//       var result = searchTextNodes(nodesFound,search_text);
//     }else{
//       var nodes = searchForNodes(searchInput);
//       nodesFound = [];
//       for (var i = nodes[0].length - 1; i >= 0; i--) {
//         nodesFound.push(getTextNodesInParent(nodes[0][i]));
//       };
  
//       searchTextNodes(nodesFound[0],nodes[1]);
//     }
//     hideNotFound();
//   }else{
//     jQuery('.root_wrap').isotope('layout');
//   }
// }

function getTextNodesInParent(parent){
  
  return getTextNodesIn2(parent);
}

function searchForNodes(searchInput){
 
 var searchNodes = [];
 var search_terms=''; 
 originalArray = searchInput.slice(0);
  for (var i = originalArray.length - 1; i >= 0; i--) {
   search_terms = originalArray[i].toLowerCase();
    if(jQuery('.'+search_terms).length>0){
    
      var index = originalArray.indexOf(search_terms);
      if (index > -1) {
        searchInput.splice(index, 1);
      }
      
      if (originalArray.indexOf('.'+search_terms) < 0) {
      searchNodes.push('.'+search_terms);
      }
    }
  };
  return [searchNodes,searchInput];
}

function filterSearchTerms(searchText){
  words = formatStringForWords(searchText);
  if (words.length <= 1) {
    return -1;
  }
  else{
    return words;
  }
}

function formatStringForWords(text){
  s = text;
  s = s.replace(/(^\s*)|(\s*$)/gi,"");
  s = s.replace(/[ ]{2,}/gi," ");
  s = s.replace(/\n /,"\n");
  return s.split(' ');
}

var getTextNodesIn2 = function(el) {
  return jQuery(el).find(":not(iframe)").addBack().contents().filter(function() {
    return this.nodeType == 3;
  });
};


function getTextNodesIn(node,searchText,includeWhitespaceNodes) {
  var textNodes = [], nonWhitespaceMatcher = /\S/;
  function getTextNodes(node) {
    if (node.nodeType == 3) {
        if (includeWhitespaceNodes || !nonWhitespaceMatcher.test(node.nodeValue)) {
          textNodes.push(node);
        }
    } else {
      for (var i = 0, len = node.childNodes.length; i < len; ++i) {
          getTextNodes(node.childNodes[i]);
      }
    }
  }
  getTextNodes(node);
  var result = searchTextNodes(textNodes,searchText);
  return result;
}

function searchTextNodes(textNodes, searchText){
  searchText = searchText.join(' ');
  for (var i = textNodes.length - 1; i >= 0; i--) {
    
    if (textNodes[i].nodeValue.toLowerCase().indexOf(searchText.toLowerCase())>=0) {
      
      jQuery(textNodes[i]).parents('.singleElement:not(.found)').addClass('found');
      
    }
  };
  return 'back from search';
}

function resetGridForSearch(){
  jQuery('.result').hide();
  resultCount = 0;
  jQuery('.singleElement').show().removeClass('found found2');
  jQuery('.grid_wrap').show().removeClass('found');
  jQuery('.antibody_root_wrap').isotope({ sortBy: 'isbtno' });
  jQuery('.antigen_root_wrap').isotope({ sortBy: 'isbtno' });
  //jQuery('.root_wrap').isotope('layout');
}

function resetGrid(){
  jQuery('.singleElement').show().removeClass('found found2');
  jQuery('.grid_wrap').show().removeClass('found');
  jQuery('.root_wrap').isotope({ filter: '*' });
  jQuery('.antibody_root_wrap').isotope({ sortBy: 'isbtno' });
  jQuery('.antigen_root_wrap').isotope({ sortBy: 'isbtno' });
  assignTopPositionSubWrapper();
  jQuery('.result').hide();
}
function resetAdvanceSearch() {
  jQuery('.adv-search-select').each(function() {
    jQuery(this).prop('selectedIndex',0);
  });
}
function hideNotFound(){
  //check if search result is zero
  if (jQuery('.grid_wrap').filter('.found').length < 1 && jQuery('.singleElement.found').length < 1) {
  //search term not found. Don't hide 
  resetGrid();
  }else{
    if (jQuery('.grid_wrap.found').length > 0 && jQuery('.singleElement.found').length < 1) {
      //single blood group search
      jQuery('.grid_wrap:not(.found)').hide();
    }else{
      //only show search if there are more than one key words
      showOnlyRelatedSearch();        
      jQuery('.grid_wrap:not(.found)').hide();
      jQuery('.singleElement:not(.found)').hide();
      jQuery('.grid_wrap.found').each(function(){
        if (jQuery(this).find('.singleElement.found').length < 1 ) {
          jQuery(this).removeClass('found').hide();
        };
      });  
    }
    assignTopPositionSubWrapper();
    jQuery('.root_wrap').isotope('layout');

  }
}
  // hacks and functions for IE
function registerFunctionsForIe(){
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
}

function resultCount(found_objects){
  var antigen_count = 0;
  var antibody_count =0;
  result_count = {};
  // console.log(found_objects);
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
  console.log("antibody: " + result_count.antibody_count + " antigen: " +  result_count.antigen_count + result_count );
  return result_count;
}

function resultFound(no_of_result){
  //jQuery('.result').css('display','block');  
  /* if ((no_of_result != 0) || (no_of_result != "")) {
    jQuery('.result').append(no_of_result +" result found");
  }
  else {
    alert('No');
    jQuery('.result').append("No Result found");
     jQuery('.result').show();
  }*/
}

function resultDisplay(result_count){
  /*jQuery('.result').empty();
  
  if (((result_count.antigen_count == 0) || (result_count.antigen_count == "") ) && ((result_count.antibody_count == 0) || (result_count.antibody_count == "")))
  {
    jQuery('.result').append("No Result found");
  }else {
    jQuery('.result').append(result_count.antigen_count + " Antigen Characteristics & "+ result_count.antibody_count+" Antibody Characteristics "  +"found.");
  }*/
}

/*function searchInComments(search_text) {
  search_text = search_text.toLowerCase();
  jQuery('.search').filter(function(index){
    var value = jQuery(this).data('value').toLowerCase();
    if(value.indexOf(search_text) > -1){
      //resultFound('Antibody Comments -');
      //alert('yes');
      resultCount++;
      console.log('found text!');
      return true;
    }
    //console.log("value: " + value);
    //console.log("Search Text: " + search_text);
  }).closest('.singleElement:not(.found)').add('.grid_wrap:not(.found)').addClass('found');
}*/

function filterSearchWithOption(search_text, option){
  search_text = search_text.toLowerCase();
  search_text1 = search_text.replace("-", " ");
  var search_terms = search_text1.split(' ');
  
  if( option === "blood") {
    jQuery('.blood_grp_hero_name').filter(function(index){
      if(jQuery(this).data('value').indexOf(search_terms[0]) != -1){
        resultFound('One');
        resultCount++;
        return true;
      }
    }).closest('.grid_wrap:not(.found)').addClass('found');
    // hideNotFound();
  }

  if (option === "isbtno") {
    jQuery('.isbtno').filter(function(index){
        value = String(jQuery(this).data('value'));
      if(value.indexOf(search_terms[0]) > -1){
        resultCount++;
        return true;
      }
    }).closest('.grid_wrap:not(.found)').addClass('found');    
    // hideNotFound();
  }


  if (option === "isbt") {
    jQuery('.isbt').filter(function(index){
      if(String(jQuery(this).data('value')).indexOf(search_terms[0]) != -1){
        resultCount++;
        return true;
      }
    }).closest('.grid_wrap:not(.found)').addClass('found'); 
    // hideNotFound();
  }

  if (option === "antibody") {
    jQuery('.blood_group_name').filter(function(index){
      var value = String(jQuery(this).data('value')).toLowerCase();      
      if (search_terms.length > 1) {
        groupName = search_terms[0] + " " + search_terms[1];
      }
      else if (search_terms.length == 1) {
        groupName = search_terms[0];
      }     
      if(value.indexOf(groupName) > -1){
        resultCount++;
        return true;
      }
    }).closest('.singleElement:not(.found)').addClass('found').closest('.grid_wrap:not(.found)').addClass('found');       
  }

  if (option === "antigen") {
    jQuery('.blood_group_name').filter(function(index){
      var value = String(jQuery(this).data('value')).toLowerCase();    
      if (search_terms.length > 1) {
        groupName = search_terms[0] + " " + search_terms[1];
      }
      else if (search_terms.length == 1) {
        groupName = search_terms[0];
      }     
      if(value.indexOf(groupName) > -1){
        resultCount++;
        return true;
      }
    }).closest('.singleElement:not(.found)').addClass('found').closest('.grid_wrap:not(.found)').addClass('found');   
  }

  if (option === "comment") {
    

    jQuery('.isbt').filter(function(index){
      if(String(jQuery(this).data('value')).indexOf(search_terms[0]) != -1){
        resultCount++;
        return true;
      }
    }).closest('.grid_wrap:not(.found)').addClass('found');  

    jQuery('.blood_grp_hero_name').filter(function(index){
      if(jQuery(this).data('value').indexOf(search_terms[0]) != -1){
        resultFound('One');
        resultCount++;
        return true;
      }
    }).closest('.grid_wrap:not(.found)').addClass('found');

    jQuery('.blood_group_name').filter(function(index){
      var value = String(jQuery(this).data('value')).toLowerCase();      
      if (search_terms.length > 1) {
        groupName = search_terms[0] + " " + search_terms[1];
      }
      else if (search_terms.length == 1) {
        groupName = search_terms[0];
      }      
      if(value.indexOf(groupName) > -1){
        resultCount++;
        return true;
      }
    }).closest('.singleElement:not(.found)').addClass('found').closest('.grid_wrap:not(.found)').addClass('found'); 

    jQuery('.caucasian').filter(function(index){
      if(String(jQuery(this).data('value')).indexOf(search_terms[0]) != -1){
        resultFound('One');
        resultCount++;
        return true;
      }
    }).closest('.singleElement:not(.found)').addClass('found').closest('.grid_wrap:not(.found)').addClass('found');
   
   if (jQuery('.head1').hasClass('active')) {
    if (search_terms[0].indexOf('0') != 0) {
      jQuery('.thermal').filter(function(index){
        var inputNum = parseInt(search_terms[0],10);
        if (String(jQuery(this).data('value')).indexOf(' ') == -1) {
          var value = String(jQuery(this).data('value'));
          //console.log(jQuery(this).data('value'));
          if (inputNum == parseInt(value,10)) {
            resultCount++;
            return true;
          }
        }
        else if (String(jQuery(this).data('value')).indexOf(' ') > -1 ) {
          var value = String(jQuery(this).data('value')).split(' ');
          //console.log(jQuery(this).data('value'));
          if ((inputNum >= parseInt(value[0],10)) && (inputNum <= parseInt(value[1],10))) {
            resultCount++;
            return true;
          }
        }
        
      }).closest('.singleElement:not(.found)').addClass('found').closest('.grid_wrap:not(.found)').addClass('found');
    }

    jQuery('.elution').filter(function(index){
      var value = jQuery(this).data('value').toLowerCase();
      if(value.indexOf(search_text) > -1){
        //resultFound('Antibody Comments -');
        //alert('yes');
        resultCount++;
        //console.log('found text!');
        return true;
      }
    }).closest('.singleElement:not(.found)').addClass('found').closest('.grid_wrap:not(.found)').addClass('found');
   }

    if (jQuery('.head2').hasClass('active')) {
      jQuery('.asian').filter(function(index){
      if(String(jQuery(this).data('value')).indexOf(search_terms[0]) != -1){
        resultFound('One');
        resultCount++;
        return true;
      }
      }).closest('.singleElement:not(.found)').addClass('found').closest('.grid_wrap:not(.found)').addClass('found');

      jQuery('.anti_struct_wrap').filter(function(index){
        var value = jQuery(this).data('value').toLowerCase();
        if(value.indexOf(search_terms[0]) != -1){
          //resultFound('One');
          resultCount++;
          return true;
        }
      }).closest('.singleElement:not(.found)').addClass('found').closest('.grid_wrap:not(.found)').addClass('found');
    }   

    if (resultCount == 0) {
      jQuery('.comment-content').filter(function(index){
        var value = jQuery(this).data('value').toLowerCase();
        if(value.indexOf(search_text) > -1){
          //resultFound('Antibody Comments -');
          //alert('yes');
          resultCount++;
          //console.log('found text!');
          return true;
        }
      }).closest('.singleElement:not(.found)').addClass('found').closest('.grid_wrap:not(.found)').addClass('found');
    }
    // jQuery('.search').filter(function(index){
    //   if(jQuery(this).data('value').indexOf(search_terms[0]) != -1){
    //     //resultFound('Antibody Comments -');
    //     return true;
    //   }
    // }).closest('.grid_wrap:not(.found)').addClass('found');

   //searchInComments(search_text);

  }
  
}

function filterSearch(search_text){
  search_text = search_text.toLowerCase();
  search_text = search_text.replace("-", " ");
  var search_terms = search_text.split(' ');
  if (search_text.indexOf('series') > 0 || search_text.indexOf('Series') > 0 || search_terms.length == 1) {
    jQuery('.blood').filter(function(index){
      if(jQuery(this).data('value').indexOf(search_terms[0]) != -1){
        resultFound('One');
        return true;
      }
    }).closest('.grid_wrap:not(.found)').addClass('found');
    jQuery('.blood_group_name').filter(function(index){
        
      if(jQuery(this).data('value').indexOf(search_terms[0]) != -1){
        resultFound('One');
        return true;
      }
    }).closest('.grid_wrap:not(.found)').addClass('found');
    jQuery('.isbt').filter(function(index){
        if(String(jQuery(this).data('value')).indexOf(search_terms[0]) > -1){
          return true;
        }
      }).closest('.grid_wrap:not(.found)').addClass('found');    
    hideNotFound();
  } 
  else
  {
    if (search_text.indexOf('isbt') > -1 || search_text.indexOf('isbtno') > -1) {
      search_terms = spliceForIsbt(search_terms);
      jQuery('.isbt').filter(function(index){
        if(String(jQuery(this).data('value')).indexOf(search_terms[0]) > -1){
          return true;
        }
      }).closest('.grid_wrap:not(.found)').addClass('found');
      resultFound('One');
      hideNotFound();
    }else{  
      found_objects = []; 
      var keywords = findKeyWords(search_terms);
      keyWordSearch(keywords.foundKeyWords,keywords.search_array);
      //resultFound(found_objects.length);
      resultDisplay(resultCount(found_objects));
      add_found_class(found_objects);
      // hideNotFound();
    }
  }
}

function spliceForIsbt(searchTerms){
  // console.log(searchTerms + " isbt")
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

function findKeyWords(search_terms){
  var spliced_search_terms = search_terms.slice(0);
  var keywords = {};
  var foundKeyWords = [];

  for (var i = search_terms.length - 1; i >= 0; i--) {
    for (var j = antibodySearchTerms.length - 1; j >= 0; j--) {
      if(antibodySearchTerms[j] == search_terms[i] ){
        foundKeyWords.push(antibodySearchTerms[j]);
        var index = spliced_search_terms.indexOf(search_terms[i]);
        if (index > -1) {
          spliced_search_terms.splice(index, 1);
        }
      }
    };
  };
  if (foundKeyWords.length > 0) {
    searchRealatedActive = 0;
    // found_objects = keyWordSearch(foundKeyWords,spliced_search_terms);
  };
  keywords.foundKeyWords = foundKeyWords;
  keywords.search_array = spliced_search_terms;
  return keywords;
}


function keyWordSearch(foundKeyWords,search_array){
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
        searchRelatedWords(foundKeyWords,search_array[j].toLowerCase(),search_array);
      };
    }; 
  };
 
  return found_objects;
}

function add_found_class(found_objects) { 
  // console.log(found_objects);
  // for(var i =0; i< found_objects.length; i++) {
  //   jQuery(found_objects[i]).closest('.singleElement:not(.found)').add('.grid_wrap:not(.found)').addClass('found');
  // }
  var i = 0;
  var ro = new RepeatingOperation(function() {   
      jQuery(found_objects[i]).closest('.singleElement:not(.found)').add('.grid_wrap:not(.found)').addClass('found');
    if (++i < found_objects.length) { 
      ro.step(); 
    } else { hideNotFound(); jQuery('div.advance_search').slideUp(); jQuery('#advance_search span').text('[+]');}
  }, 5);
  ro.step();
}



// find key and value
function keyValueSearch(key,value){
  var search_word='';
  
  search_word = key.replace(/ /g,'');
  jQuery('.'+search_word).each(function(){
    if(String(jQuery(this).data('value')).toLowerCase().indexOf(value) != -1){
      var search_data = String(jQuery(this).data('value')).toLowerCase().split(' ');
      for(var k = search_data.length-1; k >= 0 ; k-- ){
        if(search_data[k] == value.toLowerCase()){  
          jQuery(this).closest('.singleElement:not(.found)').add('.grid_wrap:not(.found)').addClass('found');
          // jQuery('.singleElement:not(.found)').hide();  
        }
      }
    }
  });
  //search for positive and negative words
  if (searchRealatedActive != 1) {
    searchRelatedWords(foundKeyWords,search_array[j].toLowerCase(),search_array);
  };
  hideNotFound();
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
      if (original_value.indexOf("no") > -1 || original_value.indexOf("absent") > -1 ) {
        //console.log("Positive word: " + original_value);
        compare_value = 'no';
      }else {
        compare_value = 'yes';
      }
      if (original_value.indexOf(value) > -1) {
        flag = true;
      } else {
        if(compare_value.indexOf(value) == 0){
        // if(String(jQuery(this).data('value')).toLowerCase().indexOf(value) > -1){
          flag = true;
          // console.log("Positive word: " + original_value);
        }else{ 
          flag = false;
        }
      }
       // console.log(jQuery(this).data('value'));console.log('key =>' + key + ' | Actual Value=> '+ jQuery(this).data('value') + " | finding Value => " + value + " | Result: " + flag );
    });
  }
    // console.log('2 key =>' + key + ' | Actual Value=> '+ jQuery(this).data('value') + " | finding Value => " + value + " | Result: " + flag );
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

function keyValueSearch2(isbt_options, isbt_range){
  found_objects = [];
  result = 0;
  jQuery('.grid_wrap').each(function(index){
    // console.log ("grid_wrap: " + index);
    jQuery(this).find('.singleElement').each(function(sindex){
      // console.log ("singleElement: " + sindex);
      var flag = true;
      for (var i=0; i < isbt_options.length; i++)
      {
        // console.log( "key: " + isbt_options[i].key + " value: " + isbt_options[i].value );  
        
        if (!keyValueSingleElementSearch(isbt_options[i].key, isbt_options[i].value, jQuery(this)))
        {
          flag = false;
        } 
        // console.log("key: " + isbt_options[i].key + " value: " + isbt_options[i].value + ' single result: ' + flag);
        
      }

      for (var i=0; i < isbt_range.length; i++)
      { 
        // console.log("min: " + isbt_range[i].min + " max: " + isbt_range[i].max);  
        if (!keyValueRangeSearch(isbt_range[i].key,isbt_range[i].min, isbt_range[i].max, jQuery(this)))
        {
          flag = false;
        }
      }
      
         // console.log( i +" Key:" + isbt_range[i].key +" min: " + isbt_range[i].min + " max: " + isbt_range[i].max + ' single result: ' + flag);
      if (flag) {
        // jQuery(this).closest('.singleElement:not(.found)').add('.grid_wrap:not(.found)').addClass('found');
        found_objects.push(jQuery(this));
      }

    })  
  });
  // console.log(found_objects.count)
  return found_objects;
}

function searchRelatedWords(foundKeyWords,word,search_array){ 

  if (positiveWords.indexOf(word) != -1) {
    searchRealatedActive = 1;
    for (var i = positiveWords.length - 1; i >= 0; i--) {
      //remove first Element which has already been searched
      search_array.shift();
      search_array.unshift(positiveWords[i])
      keyWordSearch(foundKeyWords,search_array);
    };
  }
}

function showOnlyRelatedSearch(){
  if (jQuery('.singleElement.found2').length > 0) {
   jQuery('.singleElement.found:not(.found2)').removeClass('found').hide();
  };
}

function loadjscssfile(filename, filetype){
  if (filetype=="js"){ //if filename is a external JavaScript file
    var fileref=document.createElement('script')
    fileref.setAttribute("type","text/javascript")
    fileref.setAttribute("src", filename)
  }
  else if (filetype=="css"){ //if filename is an external CSS file
    var fileref=document.createElement("link")
    fileref.setAttribute("rel", "stylesheet")
    fileref.setAttribute("type", "text/css")
    fileref.setAttribute("href", filename)
  }
  if (typeof fileref!="undefined")
  document.getElementById("script_add").appendChild(fileref)
}

// --- new version -- //

//slider

function extractCommonWords(string) {
  string = "Click the button to display the array values after the split."
  string = string.replace('/\s\s+/i', ''); // replace whitespace
  string = string.replace('/[^a-zA-Z0-9 -]/', ''); // only take alphanumerical characters, but keep the spaces and dashes too…
  string = string.toLowerCase(); // make it lowercase
  strarr = string.split(" "); 
}

// Otherwise, the HTML will be inserted into the handle.
// One level of HTML is supported.
// var MaxTip = jQuery.Link({
//   target: '-tooltip-<div class="tooltip"></div>',
//   method: function ( value ) {

//     // The tooltip HTML is 'this', so additional
//     // markup can be inserted here.
//     jQuery(this).html(
//       '<span class="max">' + value + '</span>'
//     );
//   }
// });
// var MinTip = jQuery.Link({
//   target: '-tooltip-<div class="tooltip"></div>',
//   method: function ( value ) {

//     // The tooltip HTML is 'this', so additional
//     // markup can be inserted here.
//     jQuery(this).html(
//       '<span class="min">' + value + '</span>'
//     );
//   }
// });


// jQuery("#thermal_slider").noUiSlider({
//   start: [0, 40],
//   connect: true,
//   range: {
//     'min': 0,
//     '30%': 30,
//     'max': 40
//   },
//   serialization: {
//     lower: [ MinTip ],
//     upper: [ MaxTip ]
//   }
// });

// jQuery("#asian_slider").noUiSlider({
//   start: [0, 100],
//   connect: true,
//   range: {
//     'min': 0,
//     '30%': 30,
//     'max': 100
//   },
//   serialization: {
//     lower: [ MinTip ],
//     upper: [ MaxTip ]
//   }
// });


// jQuery("#caucasian_slider").noUiSlider({
//   start: [0, 100],
//   connect: true,
//   range: {
//     'min': 0,
//     '30%': 30,
//     'max': 100
//   },
//   serialization: {
//     lower: [ MinTip ],
//     upper: [ MaxTip ]
//   }
// });
// jQuery("#antibody_caucasian_slider").noUiSlider({
//   start: [0, 100],
//   connect: true,
//   range: {
//     'min': 0,
//     '30%': 30,
//     'max': 100
//   },
//   serialization: {
//     lower: [ MinTip ],
//     upper: [ MaxTip ]
//   }
// });

// RepeatingOperation = function(op, yieldEveryIteration) {

//   //keeps count of how many times we have run heavytask() 
//   //before we need to temporally check back with the browser.
//   var count = 0;   

//   this.step = function() {

//     //Each time we run heavytask(), increment the count. When count
//     //is bigger than the yieldEveryIteration limit, pass control back 
//     //to browser and instruct the browser to immediately call op() so
//     //we can pick up where we left off.  Repeat until we are done.
//     if (++count >= yieldEveryIteration) {
//       count = 0;

//       //pass control back to the browser, and in 1 millisecond, 
//       //have the browser call the op() function.  
//       // alert("braek");
// setTimeout(function() { op(); }, 4, [])

//       //The following return statement halts this thread, it gives 
//       //the browser a sigh of relief, your long-running javascript
//       //loop has ended (even though technically we havn't yet).
//       //The browser decides there is no need to alarm the user of
//       //an unresponsive javascript process.
//       return;
//       }
//     op();
//   };
// };

(function($) {
  window.q = {
    // An empty jQuery object safely not bound to a DOM element.
    jq: $({}),
    // This should be 12-50.
    wait: 15,
    // This is arbitrary but shouldn't change, just don't call it 'fx'.
    queueName: 'default',
    // My bastard child of _.delay and $.queue()
    queue: function (func) {
      var args = Array.prototype.slice.call(arguments, 1);
      return this.jq.queue(this.queueName, function (next) {
        return func.apply(null, args);
      });
    },
    dequeue: function () {
      setTimeout(this._dequeue, this.wait);
    },
    _dequeue: function () {
      // At this point "this" is now the window.
      // Asynchronous functions are weird.
      _this = window.q;
      _this.jq.dequeue(_this.queueName);

      // If there's something left in the queue, schedule a dequeue().
      if (_this.jq.queue(_this.queueName).length) {
        _this.dequeue();
      }
    }
  };

  // Automatically run dequeue on document ready and window load as these are
  // the two events most likely to be used for queue().
  $(function(){
    window.q.dequeue();
  });

  $(window).load(function(){
    window.q.dequeue();
  });
})(jQuery);

var _st = window.setTimeout;


//spiner
/**
 * Copyright (c) 2011-2014 Felix Gnass
 * Licensed under the MIT license
 */
(function(root, factory) {

  /* CommonJS */
  if (typeof exports == 'object')  module.exports = factory()

  /* AMD module */
  else if (typeof define == 'function' && define.amd) define(factory)

  /* Browser global */
  else root.Spinner = factory()
}
(this, function() {
  "use strict";

  var prefixes = ['webkit', 'Moz', 'ms', 'O'] /* Vendor prefixes */
    , animations = {} /* Animation rules keyed by their name */
    , useCssAnimations /* Whether to use CSS animations or setTimeout */

  /**
   * Utility function to create elements. If no tag name is given,
   * a DIV is created. Optionally properties can be passed.
   */
  function createEl(tag, prop) {
    var el = document.createElement(tag || 'div')
      , n

    for(n in prop) el[n] = prop[n]
    return el
  }

  /**
   * Appends children and returns the parent.
   */
  function ins(parent /* child1, child2, ...*/) {
    for (var i=1, n=arguments.length; i<n; i++)
      parent.appendChild(arguments[i])

    return parent
  }

  /**
   * Insert a new stylesheet to hold the @keyframe or VML rules.
   */
  var sheet = (function() {
    var el = createEl('style', {type : 'text/css'})
    ins(document.getElementsByTagName('head')[0], el)
    return el.sheet || el.styleSheet
  }())

  /**
   * Creates an opacity keyframe animation rule and returns its name.
   * Since most mobile Webkits have timing issues with animation-delay,
   * we create separate rules for each line/segment.
   */
  function addAnimation(alpha, trail, i, lines) {
    var name = ['opacity', trail, ~~(alpha*100), i, lines].join('-')
      , start = 0.01 + i/lines * 100
      , z = Math.max(1 - (1-alpha) / trail * (100-start), alpha)
      , prefix = useCssAnimations.substring(0, useCssAnimations.indexOf('Animation')).toLowerCase()
      , pre = prefix && '-' + prefix + '-' || ''

    if (!animations[name]) {
      sheet.insertRule(
        '@' + pre + 'keyframes ' + name + '{' +
        '0%{opacity:' + z + '}' +
        start + '%{opacity:' + alpha + '}' +
        (start+0.01) + '%{opacity:1}' +
        (start+trail) % 100 + '%{opacity:' + alpha + '}' +
        '100%{opacity:' + z + '}' +
        '}', sheet.cssRules.length)

      animations[name] = 1
    }

    return name
  }

  /**
   * Tries various vendor prefixes and returns the first supported property.
   */
  function vendor(el, prop) {
    var s = el.style
      , pp
      , i

    prop = prop.charAt(0).toUpperCase() + prop.slice(1)
    for(i=0; i<prefixes.length; i++) {
      pp = prefixes[i]+prop
      if(s[pp] !== undefined) return pp
    }
    if(s[prop] !== undefined) return prop
  }

  /**
   * Sets multiple style properties at once.
   */
  function css(el, prop) {
    for (var n in prop)
      el.style[vendor(el, n)||n] = prop[n]

    return el
  }

  /**
   * Fills in default values.
   */
  function merge(obj) {
    for (var i=1; i < arguments.length; i++) {
      var def = arguments[i]
      for (var n in def)
        if (obj[n] === undefined) obj[n] = def[n]
    }
    return obj
  }

  /**
   * Returns the absolute page-offset of the given element.
   */
  function pos(el) {
    var o = { x:el.offsetLeft, y:el.offsetTop }
    while((el = el.offsetParent))
      o.x+=el.offsetLeft, o.y+=el.offsetTop

    return o
  }

  /**
   * Returns the line color from the given string or array.
   */
  function getColor(color, idx) {
    return typeof color == 'string' ? color : color[idx % color.length]
  }

  // Built-in defaults

  var defaults = {
    lines: 12,            // The number of lines to draw
    length: 7,            // The length of each line
    width: 5,             // The line thickness
    radius: 10,           // The radius of the inner circle
    rotate: 0,            // Rotation offset
    corners: 1,           // Roundness (0..1)
    color: '#000',        // #rgb or #rrggbb
    direction: 1,         // 1: clockwise, -1: counterclockwise
    speed: 1,             // Rounds per second
    trail: 100,           // Afterglow percentage
    opacity: 1/4,         // Opacity of the lines
    fps: 20,              // Frames per second when using setTimeout()
    zIndex: 2e9,          // Use a high z-index by default
    className: 'spinner', // CSS class to assign to the element
    top: '50%',           // center vertically
    left: '50%',          // center horizontally
    position: 'absolute'  // element position
  }

  /** The constructor */
  function Spinner(o) {
    this.opts = merge(o || {}, Spinner.defaults, defaults)
  }

  // Global defaults that override the built-ins:
  Spinner.defaults = {}

  merge(Spinner.prototype, {

    /**
     * Adds the spinner to the given target element. If this instance is already
     * spinning, it is automatically removed from its previous target b calling
     * stop() internally.
     */
    spin: function(target) {
      this.stop()

      var self = this
        , o = self.opts
        , el = self.el = css(createEl(0, {className: o.className}), {position: o.position, width: 0, zIndex: o.zIndex})
        , mid = o.radius+o.length+o.width

      css(el, {
        left: o.left,
        top: o.top
      })
        
      if (target) {
        target.insertBefore(el, target.firstChild||null)
      }

      el.setAttribute('role', 'progressbar')
      self.lines(el, self.opts)

      if (!useCssAnimations) {
        // No CSS animation support, use setTimeout() instead
        var i = 0
          , start = (o.lines - 1) * (1 - o.direction) / 2
          , alpha
          , fps = o.fps
          , f = fps/o.speed
          , ostep = (1-o.opacity) / (f*o.trail / 100)
          , astep = f/o.lines

        ;(function anim() {
          i++;
          for (var j = 0; j < o.lines; j++) {
            alpha = Math.max(1 - (i + (o.lines - j) * astep) % f * ostep, o.opacity)

            self.opacity(el, j * o.direction + start, alpha, o)
          }
          self.timeout = self.el && setTimeout(anim, ~~(1000/fps))
        })()
      }
      return self
    },

    /**
     * Stops and removes the Spinner.
     */
    stop: function() {
      var el = this.el
      if (el) {
        clearTimeout(this.timeout)
        if (el.parentNode) el.parentNode.removeChild(el)
        this.el = undefined
      }
      return this
    },

    /**
     * Internal method that draws the individual lines. Will be overwritten
     * in VML fallback mode below.
     */
    lines: function(el, o) {
      var i = 0
        , start = (o.lines - 1) * (1 - o.direction) / 2
        , seg

      function fill(color, shadow) {
        return css(createEl(), {
          position: 'absolute',
          width: (o.length+o.width) + 'px',
          height: o.width + 'px',
          background: color,
          boxShadow: shadow,
          transformOrigin: 'left',
          transform: 'rotate(' + ~~(360/o.lines*i+o.rotate) + 'deg) translate(' + o.radius+'px' +',0)',
          borderRadius: (o.corners * o.width>>1) + 'px'
        })
      }

      for (; i < o.lines; i++) {
        seg = css(createEl(), {
          position: 'absolute',
          top: 1+~(o.width/2) + 'px',
          transform: o.hwaccel ? 'translate3d(0,0,0)' : '',
          opacity: o.opacity
          //animation: useCssAnimations && addAnimation(o.opacity, o.trail, start + i * o.direction, o.lines) + ' ' + 1/o.speed + 's linear infinite'
        })

        if (o.shadow) ins(seg, css(fill('#000', '0 0 4px ' + '#000'), {top: 2+'px'}))
        ins(el, ins(seg, fill(getColor(o.color, i), '0 0 1px rgba(0,0,0,.1)')))
      }
      return el
    },

    /**
     * Internal method that adjusts the opacity of a single line.
     * Will be overwritten in VML fallback mode below.
     */
    opacity: function(el, i, val) {
      if (i < el.childNodes.length) el.childNodes[i].style.opacity = val
    }

  })


  function initVML() {

    /* Utility function to create a VML tag */
    function vml(tag, attr) {
      return createEl('<' + tag + ' xmlns="urn:schemas-microsoft.com:vml" class="spin-vml">', attr)
    }

    // No CSS transforms but VML support, add a CSS rule for VML elements:
    sheet.addRule('.spin-vml', 'behavior:url(#default#VML)')

    Spinner.prototype.lines = function(el, o) {
      var r = o.length+o.width
        , s = 2*r

      function grp() {
        return css(
          vml('group', {
            coordsize: s + ' ' + s,
            coordorigin: -r + ' ' + -r
          }),
          { width: s, height: s }
        )
      }

      var margin = -(o.width+o.length)*2 + 'px'
        , g = css(grp(), {position: 'absolute', top: margin, left: margin})
        , i

      function seg(i, dx, filter) {
        ins(g,
          ins(css(grp(), {rotation: 360 / o.lines * i + 'deg', left: ~~dx}),
            ins(css(vml('roundrect', {arcsize: o.corners}), {
                width: r,
                height: o.width,
                left: o.radius,
                top: -o.width>>1,
                filter: filter
              }),
              vml('fill', {color: getColor(o.color, i), opacity: o.opacity}),
              vml('stroke', {opacity: 0}) // transparent stroke to fix color bleeding upon opacity change
            )
          )
        )
      }

      if (o.shadow)
        for (i = 1; i <= o.lines; i++)
          seg(i, -2, 'progid:DXImageTransform.Microsoft.Blur(pixelradius=2,makeshadow=1,shadowopacity=.3)')

      for (i = 1; i <= o.lines; i++) seg(i)
      return ins(el, g)
    }

    Spinner.prototype.opacity = function(el, i, val, o) {
      var c = el.firstChild
      o = o.shadow && o.lines || 0
      if (c && i+o < c.childNodes.length) {
        c = c.childNodes[i+o]; c = c && c.firstChild; c = c && c.firstChild
        if (c) c.opacity = val
      }
    }
  }

  var probe = css(createEl('group'), {behavior: 'url(#default#VML)'})

  if (!vendor(probe, 'transform') && probe.adj) initVML()
  else useCssAnimations = vendor(probe, 'animation')

  return Spinner

}));

//start spin

var opts = {
  lines: 9, // The number of lines to draw
  length: 28, // The length of each line
  width: 17, // The line thickness
  radius: 30, // The radius of the inner circle
  corners: 1, // Corner roundness (0..1)
  rotate: 0, // The rotation offset
  direction: 1, // 1: clockwise, -1: counterclockwise
  color: '#000', // #rgb or #rrggbb or array of colors
  speed: 1, // Rounds per second
  trail: 60, // Afterglow percentage
  shadow: false, // Whether to render a shadow
  hwaccel: false, // Whether to use hardware acceleration
  className: 'spinner', // The CSS class to assign to the spinner
  zIndex: 2e9, // The z-index (defaults to 2000000000)
  top: '50%', // Top position relative to parent
  left: '50%' // Left position relative to parent
};
var target = document.getElementById('spin');
var spinner = new Spinner(opts).spin(target);
