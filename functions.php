<?php

require_once("core/loader.php");

if (!isset($content_width)) $content_width = 940;

function gt3_get_theme_pagebuilder($postid, $args = array())
{
    $pagebuilder = get_post_meta($postid, "pagebuilder", true);
    if (!is_array($pagebuilder)) {
        $pagebuilder = array();
    }

    if (!isset($pagebuilder['settings']['show_content_area'])) {
        $pagebuilder['settings']['show_content_area'] = "yes";
    }
    if (!isset($pagebuilder['settings']['show_page_title'])) {
        $pagebuilder['settings']['show_page_title'] = "yes";
    }
    if (!isset($pagebuilder['settings']['show_breadcrumb'])) {
        $pagebuilder['settings']['show_breadcrumb'] = "yes";
    }
    if (!isset($pagebuilder['settings']['show_breadcrumb_area'])) {
        $pagebuilder['settings']['show_breadcrumb_area'] = "yes";
    }
    if (isset($args['not_prepare_sidebars']) && $args['not_prepare_sidebars'] == "true") {

    } else {
        if (!isset($pagebuilder['settings']['layout-sidebars']) || $pagebuilder['settings']['layout-sidebars'] == "default") {
            $pagebuilder['settings']['layout-sidebars'] = gt3_get_theme_option("default_sidebar_layout");
        }
    }

    return $pagebuilder;
}

function gt3_get_theme_sidebars_for_admin()
{
    $theme_sidebars = gt3_get_theme_option("theme_sidebars");
    if (!is_array($theme_sidebars)) {
        $theme_sidebars = array();
    }

    return $theme_sidebars;
}

function gt3_get_theme_option($optionname, $defaultValue="")
{
    global $themeshort;
    $returnedValue = get_option($themeshort . $optionname, $defaultValue);

    if (gettype($returnedValue) == "string") {
        return stripslashes($returnedValue);
    } else {
        return $returnedValue;
    }
}

function gt3_the_theme_option($optionname, $beforeoutput = "", $afteroutput = "")
{
    global $themeshort;
    $returnedValue = get_option($themeshort . $optionname);

    if (strlen($returnedValue) > 0) {
        echo $beforeoutput . stripslashes($returnedValue) . $afteroutput;
    }
}

function gt3_get_text($optionname, $beforeoutput = "", $afteroutput = "")
{
    global $themeshort;
    $returnedValue = get_option($themeshort . $optionname);

    if (strlen($returnedValue) > 0) {
        return $beforeoutput . stripslashes($returnedValue) . $afteroutput;
    }
}

function gt3_get_if_strlen($str, $beforeoutput = "", $afteroutput = "")
{
    if (strlen($str) > 0) {
        return $beforeoutput . $str . $afteroutput;
    }
}

function gt3_the_text($optionname, $beforeoutput = "", $afteroutput = "")
{
    global $themeshort;
    $returnedValue = get_option($themeshort . $optionname);

    if (strlen($returnedValue) > 0) {
        echo $beforeoutput . stripslashes($returnedValue) . $afteroutput;
    }
}

function gt3_delete_theme_option($optionname)
{
    global $themeshort;
    return delete_option($themeshort . $optionname);
}

function gt3_update_theme_option($optionname, $optionvalue)
{
    global $themeshort;
    if (update_option($themeshort . $optionname, $optionvalue)) {
        return true;
    }
}

function gt3_messagebox($actionmessage)
{
    $compile = "<div class='admin_message_box fadeout'>" . $actionmessage . "</div>";
    return $compile;
}

function gt3_breaksToBR($content, $changeto = "")
{

    $content = nl2br($content);
    $content = str_replace("\r\n", "", $content);
    $content = str_replace("\n", "", $content);

    return $content;
}


function gt3_theme_comment($comment, $args, $depth)
{
    $max_depth_comment = $args['max_depth'];
    if ($max_depth_comment > 4) {
        $max_depth_comment = 4;
    }
    $GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>" class="stand_comment">
        <div class="commentava wrapped_img">
            <?php echo get_avatar($comment->comment_author_email, 70); ?>
            <div class="img_inset"></div>
        </div>
        <div class="thiscommentbody">
            <div class="comment_info">
                <span class="author_name"><?php printf('%s', get_comment_author_link()) ?> <?php edit_comment_link('(Edit)', '  ', '') ?></span>
                <span class="date"><?php printf('%1$s', get_comment_date("F d, Y")) ?></span>
                <?php comment_reply_link(array_merge($args, array('before' => ' <span class="comments">', 'after' => '</span>', 'depth' => $depth, 'reply_text' => __('Reply','theme_localization'), 'max_depth' => $max_depth_comment))) ?>
            </div>
            <?php if ($comment->comment_approved == '0') : ?>
            <p><em><?php _e('Your comment is awaiting moderation.','theme_localization'); ?></em></p>
            <?php endif; ?>
            <?php comment_text() ?>
        </div>
        <div class="clear"></div>
    </div>
    <?php
}


#Get all pages for create portfolio page
function gt3_getAllPagesForSelect()
{
    $compile = array();
    $pages = get_pages();
    if (is_array($pages)) {
        foreach ($pages as $pagg) {
            $compile[$pagg->ID] = $pagg->post_title;
        }
    }
    return $compile;
}


#Custom paging
function gt3_get_theme_pagination($range = 10, $type = "")
{
    if ($type == "show_in_shortcodes") {
        global $paged, $wp_query_in_shortcodes;
        $wp_query = $wp_query_in_shortcodes;
    } else {
        global $paged, $wp_query;
    }

    if(empty($paged)){
        $paged = (get_query_var('page')) ? get_query_var('page') : 1;
    }

    // $paged - number of the current page
    // How much pages do we have?
    #if (!$max_page) {
    $max_page = $wp_query->max_num_pages;
    #}
    if ($max_page > 1) {
        echo '<ul class="pagerblock">';
    }
    // We need the pagination only if there are more than 1 page
    if ($max_page > 1) {
        if (!$paged) {
            $paged = 1;
        }
        // On the first page, don't put the First page link
        if ($paged != 1) {
            //echo "<li><a class='btn_firstpage' href=" . get_pagenum_link(1) . ">First Page</a></li>";
        }
        // To the previous page
        $ppl = "<span class='btn_prev'></span>";
        #echo "<li>" . get_previous_posts_link($ppl) . "</li>";
        // We need the sliding effect only if there are more pages than is the sliding range
        if ($max_page > $range) {
            // When closer to the beginning
            if ($paged < $range) {
                for ($i = 1; $i <= ($range + 1); $i++) {
                    echo "<li><a href='" . get_pagenum_link($i) . "'";
                    if ($i == $paged) echo " class='current'";
                    echo ">$i</a></li>";
                }
            } // When closer to the end
            elseif ($paged >= ($max_page - ceil(($range / 2)))) {
                for ($i = $max_page - $range; $i <= $max_page; $i++) {
                    echo "<li><a href='" . get_pagenum_link($i) . "'";
                    if ($i == $paged) echo " class='current'";
                    echo ">$i</a></li>";
                }
            }
            // Somewhere in the middle
            elseif ($paged >= $range && $paged < ($max_page - ceil(($range / 2)))) {
                for ($i = ($paged - ceil($range / 2)); $i <= ($paged + ceil(($range / 2))); $i++) {
                    echo "<li><a href='" . get_pagenum_link($i) . "'";
                    if ($i == $paged) echo " class='current'";
                    echo ">$i</a></li>";
                }
            }
        } // Less pages than the range, no sliding effect needed
        else {
            for ($i = 1; $i <= $max_page; $i++) {
                echo "<li><a href='" . get_pagenum_link($i) . "'";
                if ($i == $paged) echo " class='current'";
                echo ">$i</a></li>";
            }
        }
        // Next page
        $npl = "<span class='btn_next'></span>";
        #echo "<li>" . get_next_posts_link($npl) . "</li>";
        // On the last page, don't put the Last page link
        if ($paged != $max_page) {
            //echo " <li><a class='btn_lastpage' href=" . get_pagenum_link($max_page) . ">Last Page</a></li>";
        }
    }
    if ($max_page > 1) {
        echo '</ul>';
    }
}


if (!function_exists('gt3_crop_str')) {
    function gt3_crop_str($string, $limit)
    {

        $substring_limited = substr($string, 0, $limit);
        $compile = substr($substring_limited, 0, strrpos($substring_limited, ' '));
        $comacheck = substr($compile, -1);
        if ($comacheck == ",") {
            $compile = substr($compile, 0, -1);
        }
        if ($comacheck == ".") {
            $compile = substr($compile, 0, -1);
        }

        return $compile;

    }
}

function gt3_socsm($socname, $class = "", $title = "")
{
    if (strlen(gt3_get_theme_option($socname)) > 0) {
        return "<li><a target='_blank' href='" . gt3_get_theme_option($socname) . "' class='{$class}' title='{$title}'></a></li>";
    } else {
        return false;
    }
}

function gt3_get_pf_icon($pf)
{
    $icon = '';
    switch ($pf) {
        case "default":
            $icon = "blog_text";
            break;
        case "image":
            $icon = "blog_slider";
            break;
        case "video":
            $icon = "blog_video";
            break;
        case "audio":
            $icon = "blog_audio";
            break;
    }

    return $icon;
}



function gt3_the_breadcrumb() {
    $showOnHome = 1;
    $delimiter = '';
    $home = __('Home','theme_localization');
    $showCurrent = 1;
    $before = '<span class="current">';
    $after = '</span>';

    global $post;
    $homeLink = home_url();

    if (is_home() || is_front_page()) {

    if ($showOnHome == 1) echo '<div class="breadcrumbs"><span>' . $home . '</span></div>';

    } else {

    echo '<div class="breadcrumbs"><a href="' . $homeLink . '">' . $home . '</a>' . $delimiter . '';

        if ( is_category() ) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
            echo $before . 'Archive "' . single_cat_title('', false) . '"' . $after;

        }
        #PORTFOLIO
        elseif ( get_post_type() == 'port' ) {

            the_terms( $post->ID, 'portcat', '', '', '' );

            if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

        } elseif ( is_search() ) {
            echo $before . 'Search for "' . get_search_query() . '"' . $after;

        } elseif ( is_day() ) {
        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
        echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
            echo $before . get_the_time('d') . $after;

        } elseif ( is_month() ) {
        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo $before . get_the_time('F') . $after;

        } elseif ( is_year() ) {
            echo $before . get_the_time('Y') . $after;

        } elseif ( is_single() && !is_attachment() ) {
            if ( get_post_type() != 'post' ) {

                $parent_id  = $post->post_parent;
                if ($parent_id>0) {
                    $breadcrumbs = array();
                    while ($parent_id) {
                        $page = get_page($parent_id);
                    $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                        $parent_id  = $page->post_parent;
                    }
                    $breadcrumbs = array_reverse($breadcrumbs);
                    for ($i = 0; $i < count($breadcrumbs); $i++) {
                        echo $breadcrumbs[$i];
                        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
                    }
                    if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
                } else {
                    echo $before . get_the_title() . $after;
                }

            } else {
                $cat = get_the_category(); $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                echo $cats;
                if ($showCurrent == 1) echo $before . get_the_title() . $after;
            }

        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;

        } elseif ( is_attachment() ) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID); $cat = $cat[0];
            echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
            echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
            if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

        } elseif ( is_page() && !$post->post_parent ) {
            if ($showCurrent == 1) echo $before . get_the_title() . $after;

        } elseif ( is_page() && $post->post_parent ) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
            $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo $breadcrumbs[$i];
                if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
            }
            if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

        } elseif ( is_tag() ) {
            echo $before . 'Tag "' . single_tag_title('', false) . '"' . $after;

        } elseif ( is_author() ) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . 'Author ' . $userdata->display_name . $after;

        } elseif ( is_404() ) {
            echo $before . 'Error 404' . $after;
        }



        if ( get_query_var('paged') ) {
        /*if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
            echo $delimiter. 'Page' . ' ' . get_query_var('paged');
        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';*/
        }

        echo '</div>';

    }
}

function gt3_is_now_custom_font_selected($field_name_in_admin_panel) {
    global $themeconfig;
    if (is_array($themeconfig['custom_fonts_array'])) {
        foreach ($themeconfig['custom_fonts_array'] as $id => $font) {
            if ($font['font_family'] == $field_name_in_admin_panel) {
                return true;
            }
        }
    }
    return false;
}


function gt3_the_pb_custom_bg_and_color($pagebuilder) {
    $cover = ''; $bgcolor = ''; $bgimg = ''; $repeat = ''; $fullcolor = ''; $fullimg  = ''; $classimg  = '';
    if (!isset($pagebuilder['page_settings']['page_layout']['layout_type'])) {$pagebuilder['page_settings']['page_layout']['layout_type'] = "default";}

    $default_on_start = false;

    if ($pagebuilder['page_settings']['page_layout']['layout_type'] == "default") {
        $default_on_start = true;
        $page_layout = gt3_get_theme_option("default_theme_layout");
        unset($pagebuilder['page_settings']['page_layout']['img']['attachid'], $pagebuilder['page_settings']['page_layout']['color']['hash']);
    } else {
        $page_layout = $pagebuilder['page_settings']['page_layout']['layout_type'];
    }

    switch ($page_layout) {
        case "clean":
            echo '<div class="layout_trigger clean_bg_cont"></div>';
            break;

        case "boxed":
            if ($default_on_start == true) {
                if (isset($pagebuilder['page_settings']['page_layout']['img']['attachid']) && $pagebuilder['page_settings']['page_layout']['img']['attachid'] > 0) {
                    $bgimg = wp_get_attachment_url( $pagebuilder['page_settings']['page_layout']['img']['attachid'] );
                } else {
                    $bgimg = gt3_get_theme_option("bg_img");
                }
                if (isset($pagebuilder['page_settings']['page_layout']['color']['hash']) && strlen($pagebuilder['page_settings']['page_layout']['color']['hash'])>0) {
                    $bgcolor = $pagebuilder['page_settings']['page_layout']['color']['hash'];
                } else {
                    $bgcolor = gt3_get_theme_option("default_bg_color");
                }
            } else {
                if (isset($pagebuilder['page_settings']['page_layout']['img']['attachid']) && $pagebuilder['page_settings']['page_layout']['img']['attachid'] > 0) {
                    $bgimg = wp_get_attachment_url( $pagebuilder['page_settings']['page_layout']['img']['attachid'] );
                } else {
                    $bgimg = "";
                }
                if (isset($pagebuilder['page_settings']['page_layout']['color']['hash']) && strlen($pagebuilder['page_settings']['page_layout']['color']['hash'])>0) {
                    $bgcolor = $pagebuilder['page_settings']['page_layout']['color']['hash'];
                } else {
                    $bgcolor = "";
                }
            }

            echo '<div class="layout_trigger boxed_bg_cont" style="background-image:url('.$bgimg.'); background-repeat: repeat; background-color:#'.$bgcolor.';"></div>';
            break;

        case "bgimage":
            if (isset($pagebuilder['page_settings']['page_layout']['img']['attachid']) && $pagebuilder['page_settings']['page_layout']['img']['attachid'] > 0) {
                $bgimg = wp_get_attachment_url( $pagebuilder['page_settings']['page_layout']['img']['attachid'] );
            } else {
                $bgimg = gt3_get_theme_option("bg_img");
            }
            if (isset($pagebuilder['page_settings']['page_layout']['color']['hash']) && strlen($pagebuilder['page_settings']['page_layout']['color']['hash'])>0) {
                $bgcolor = $pagebuilder['page_settings']['page_layout']['color']['hash'];
            } else {
                $bgcolor = gt3_get_theme_option("default_bg_color");
            }
            echo '<div class="layout_trigger image_bg_cont" style="background-image:url('.$bgimg.'); background-repeat: no-repeat; background-color:#'.$bgcolor.';"></div>';
            break;
    }
}

if (!function_exists('gt3_get_default_pb_settings')) {
    function gt3_get_default_pb_settings()
    {
        $pagebuilder['settings']['layout-sidebars'] = gt3_get_theme_option("default_sidebar_layout");
        $pagebuilder['settings']['left-sidebar'] = "Default";
        $pagebuilder['settings']['right-sidebar'] = "Default";
        $pagebuilder['settings']['bg_image']['status'] = gt3_get_theme_option("show_bg_img_by_default");
        $pagebuilder['settings']['bg_image']['src'] = gt3_get_theme_option("bg_img");
        $pagebuilder['settings']['custom_color']['status'] = gt3_get_theme_option("show_bg_color_by_default");
        $pagebuilder['settings']['custom_color']['value'] = gt3_get_theme_option("default_bg_color");
        $pagebuilder['settings']['bg_image']['type'] = gt3_get_theme_option("default_bg_img_position");

        if (gt3_get_theme_option("show_breadcrumb") == "on") {
            $pagebuilder['settings']['show_breadcrumb'] = "yes";
        } else {
            $pagebuilder['settings']['show_breadcrumb'] = "no";
        }

        return $pagebuilder;
    }
}

if (!function_exists('gt3_get_selected_pf_images')) {
    function gt3_get_selected_pf_images($pagebuilder)
    {
        if (!isset($compile)) {
            $compile = '';
        }
        if (isset($pagebuilder['post-formats']['images']) && is_array($pagebuilder['post-formats']['images'])) {
            if (count($pagebuilder['post-formats']['images']) == 1) {
                $onlyOneImage = "oneImage";
            } else {
                $onlyOneImage = "";
            }
            $compile .= '
                <div class="slider-wrapper theme-default">
                    <div class="nivoSlider ' . $onlyOneImage . '">
            ';

            if (is_array($pagebuilder['post-formats']['images'])) {
                foreach ($pagebuilder['post-formats']['images'] as $imgid => $img) {
                    $compile .= '
                        <img src="' . aq_resize($img['src'], "1170", "563", true, true, true) . '" data-thumb="' . aq_resize($img['src'], "1170", "563", true, true, true) . '" alt="" />
                    ';
                }
            }

            $compile .= '
                    </div>
                </div>
            ';

        }
        return $compile;
    }
}

if (!function_exists('gt3_HexToRGB')) {
    function gt3_HexToRGB($hex) {
        $color = array();

        if(strlen($hex) == 3) {
            $color['r'] = hexdec(substr($hex, 0, 1) . $r);
            $color['g'] = hexdec(substr($hex, 1, 1) . $g);
            $color['b'] = hexdec(substr($hex, 2, 1) . $b);
        }
        else if(strlen($hex) == 6) {
            $color['r'] = hexdec(substr($hex, 0, 2));
            $color['g'] = hexdec(substr($hex, 2, 2));
            $color['b'] = hexdec(substr($hex, 4, 2));
        }

        return $color['r'].",".$color['g'].",".$color['b'];
    }
}

if (!function_exists('gt3_smarty_modifier_truncate')) {
    function gt3_smarty_modifier_truncate($string, $length = 80, $etc = '... ',
                                      $break_words = false, $middle = false)
    {
        if ($length == 0)
            return '';

        if (mb_strlen($string, 'utf8') > $length) {
            $length -= mb_strlen($etc, 'utf8');
            if (!$break_words && !$middle) {
                $string = preg_replace('/\s+\S+\s*$/su', '', mb_substr($string, 0, $length + 1, 'utf8'));
            }
            if (!$middle) {
                return mb_substr($string, 0, $length, 'utf8') . $etc;
            } else {
                return mb_substr($string, 0, $length / 2, 'utf8') . $etc . mb_substr($string, -$length / 2, utf8);
            }
        } else {
            return $string;
        }
    }
}

// custom code

//remove auto p and br in wordpress
remove_filter('the_content', 'wpautop');

add_action( 'wp_enqueue_scripts', 'add_custom_javascript');
 
function add_custom_javascript() {
    // wp_enqueue_script('jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js', array('jquery'), '1.8.6');
    wp_register_script( 'jquery-nouislider-min', get_template_directory_uri() . '/js/jquery.nouislider.min.js' );
    wp_enqueue_script( 'jquery-nouislider-min' );
    wp_register_style( 'jquery-nouislider', get_template_directory_uri() . '/css/jquery.nouislider.css', array(), '20120208', 'all' );
    wp_enqueue_style( 'jquery-nouislider' );
    //wp_enqueue_script( 'prefect-js', get_stylesheet_directory_uri() . '/js/perfectMasonry.js',array('jquery','isotope-js'),'1.0.0',true );
    // wp_enqueue_script( 'custom_scripts-js', get_stylesheet_directory_uri() . '/custom_scripts.js',array('jquery','isotope-js'),'1.0.0',false );
}

if(!function_exists('logit')){
  function logit( $message ) {
    if( WP_DEBUG === true ){
      if( is_array( $message ) || is_object( $message ) ){
        error_log( print_r( $message, true ) );
      } else {
        error_log( $message );
      }
    }
  }
}

function sort_antigen_posts_by_isbtno($myposts){
$size = count($myposts);
    $temp = null;
    
    for ($i = 0; $i < $size; $i++) {
         if ($i+1 > $size) {
            break;
        }
        for ($j = 0; $j < $size; $j++) {
            if ($j+1 > $size) {
            break;
            }
          
            $first_meta_group = get_group('post_1',1,$myposts[$j]->ID);

            $second_meta_group = get_group('post_1',1,$myposts[$j+1]->ID);

            if ($first_meta_group['antigen_meta_isbt_antigen_no'] > $second_meta_group['antigen_meta_isbt_antigen_no']) {
                
                $temp = $myposts[$j];
                $myposts[$j] = $myposts[$j+1];
                $myposts[$j+1] = $temp;
            }
        
            
            
        }

    }
    return array_trim($myposts);
}

function sort_antibody_posts_by_rank($myposts){
$size = count($myposts);
    $temp = null;
    
    for ($i = 0; $i < $size; $i++) {
         if ($i+1 > $size) {
            break;
        }
        for ($j = 0; $j < $size; $j++) {
            if ($j+1 > $size) {
            break;
            }
          
            $first_meta_group = get_group('post_2',1,$myposts[$j]->ID);

            $second_meta_group = get_group('post_2',1,$myposts[$j+1]->ID);

            if ($first_meta_group['antibody_sort_rank'] > $second_meta_group['antibody_sort_rank']) {
                
                $temp = $myposts[$j];
                $myposts[$j] = $myposts[$j+1];
                $myposts[$j+1] = $temp;
            }
        
            
            
        }

    }
    return array_trim($myposts);
}

function sort_other_posts_by_rank($myposts){
$size = count($myposts);
    $temp = null;
    
    for ($i = 0; $i < $size; $i++) {
         if ($i+1 > $size) {
            break;
        }
        for ($j = 0; $j < $size; $j++) {
            if ($j+1 > $size) {
            break;
            }
          
            $first_meta_group = get_group('post_1',1,$myposts[$j]->ID);

            $second_meta_group = get_group('post_1',1,$myposts[$j+1]->ID);

            if ($first_meta_group['post_1_other_blood_group_sort_rank'] > $second_meta_group['post_1_other_blood_group_sort_rank']) {
                
                $temp = $myposts[$j];
                $myposts[$j] = $myposts[$j+1];
                $myposts[$j+1] = $temp;
            }
        
            
            
        }

    }
    return array_trim($myposts);
}


function array_trim($ar){
    $size = count($ar);
  for($i=0;$i<$size;$i++){
    if(empty($ar[$i]))
      unset($ar[$i]);
}
  return $ar;
};

function sort_cat_by_isbtno($mycats){
  
$size = count($mycats);
    $temp = null;
    logit($mycats);
    for ($i = 0; $i < $size; $i++) {
         if ($i+1 >= $size) {
            break;
        }
        for ($j = 0; $j < $size; $j++) {
            if ($j+1 >= $size) {
            break;
            }

            $prev_isbtno = get_terms_meta(current($mycats)->cat_ID, 'isbtno');
            
            $next_isbtno = get_terms_meta(next($mycats)->cat_ID, 'isbtno');
            if (($prev_isbtno > $next_isbtno )&& ($prev_isbtno!=null)) {
                //logit('Pass: '.$i.'j: '.$j);
                //logit(var_dump($prev_isbtno));
                //logit('$$$$$$$');
                //logit(var_dump($next_isbtno));
                $temp = $mycats[$j];
                $mycats[$j] = $mycats[$j+1];
                $mycats[$j+1] = $temp;
            }
        }
    }
    return array_trim($mycats);
}  

function sort_other_cat_by_rank($mycats){
    
$size = count($mycats);
    if ($size > 1) {
      
    
        $temp = null;
        
        for ($i = 0; $i < $size; $i++) {
             if ($i+1 > $size) {
                break;
            }
            for ($j = 0; $j < $size-1-$i; $j++) {
                // if ($j+1 > $size) {
                // break;
                // }
                
                $curr_rank = (int)get_terms_meta(current($mycats)->cat_ID, 'other-group-series-rank');
           
                $next_rank = (int)get_terms_meta(next($mycats)->cat_ID, 'other-group-series-rank');
             
             
                if ($curr_rank < $next_rank) {
                    
                    $temp = $mycats[$j];
                    $mycats[$j] = $mycats[$j+1];
                    $mycats[$j+1] = $temp;
                }
            }
        }
    }
    // logit('BLAH BLHA AKLSJALKSJLKSAJLKSJLAKSJA $$$$');
    // logit( get_terms_meta($mycats[0]->cat_ID, 'other-group-series-rank'));
    // logit( get_terms_meta($mycats[1]->cat_ID, 'other-group-series-rank'));
    // logit($mycats);
    return array_trim($mycats);
}  

// get label function to fix broken plugin function


function get_label_post($metaKey,$post_id){
             if($metaKey){
                global $postMeta,$post;
                if ($post_id !== null) {
                    $postType= get_post_type( $post_id );
                }else{
                    $postType= get_post_type( $post->ID );
                }
                
                $label = null;
                $pm_options= get_option($postMeta->options['post_meta']);
                //var_dump($metaKey);
                $groups=$pm_options[$postType]['group'];
                
                foreach($groups as $group ){
                foreach($group['field'] as $field){
                    //var_dump($field['meta_key']);
                      if($field['meta_key'] == $metaKey){
                            $label = $field['title'];
                            break;
                        }           
                    
                }
                
                }
                
                return $label;
             }
        }
?>