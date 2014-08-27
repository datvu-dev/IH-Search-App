<?php header("Content-type: text/css");
$wp_include = "../../../../wp-load.php";
$i = 0;
while (!file_exists($wp_include) && $i++ < 10) {
    $wp_include = "../$wp_include";
}

require($wp_include);

global $themeconfig;
if ($themeconfig['custom_fonts'] == true) {
    if (is_array($themeconfig['custom_fonts_array'])) {
        foreach ($themeconfig['custom_fonts_array'] as $id => $font) {
            if ($font['font_file_name']!=="default_font") {
                echo "
                @font-face {
                    font-family: '".$font['font_family']."';
                    src: url('".THEMEROOTURL."/css/../fonts/".$font['font_file_name'].".eot');
                    src: url('".THEMEROOTURL."/css/../fonts/".$font['font_file_name'].".eot?#iefix') format('embedded-opentype'),
                         url('".THEMEROOTURL."/css/../fonts/".$font['font_file_name'].".woff') format('woff'),
                         url('".THEMEROOTURL."/css/../fonts/".$font['font_file_name'].".ttf') format('truetype'),
                         url('".THEMEROOTURL."/css/../fonts/".$font['font_file_name'].".svg#".$font['svg_id']."') format('svg');
                    font-weight: ".$font['font_weight'].";
                    font-style: ".$font['font_style'].";

                }
                ";
            }
        }
    }
}

if (isset($_COOKIE['trend_color1'])) {
    $themecolor1 = $_COOKIE['trend_color1'];
} else {
    $themecolor1 = gt3_get_theme_option("theme_color1");
}
/*if (isset($_COOKIE['theme_color2'])) {
    $themecolor2 = $_COOKIE['theme_color2'];
} else {
    $themecolor2 = gt3_get_theme_option("theme_color2");
}*/
$additional_font = gt3_get_theme_option("additional_font");

#Fonts & colors
$footer_background_color = gt3_get_theme_option("footer_background_color");
$footer_text_color = gt3_get_theme_option("footer_text_color");
$content_text_color = gt3_get_theme_option("content_text_color");
$text_headers_font = gt3_get_theme_option("text_headers_font");
$main_content_font = gt3_get_theme_option("main_content_font");

$h1_font_size = gt3_get_theme_option("h1_font_size");
$h1_line_height = substr(gt3_get_theme_option("h1_font_size"), 0, -2);
$h1_line_height = (int)$h1_line_height+2;$h1_line_height = $h1_line_height."px";

$h2_font_size = gt3_get_theme_option("h2_font_size");
$h2_line_height = substr(gt3_get_theme_option("h2_font_size"), 0, -2);
$h2_line_height = (int)$h2_line_height+2;$h2_line_height = $h2_line_height."px";

$h3_font_size = gt3_get_theme_option("h3_font_size");
$h3_line_height = substr(gt3_get_theme_option("h3_font_size"), 0, -2);
$h3_line_height = (int)$h3_line_height+2;$h3_line_height = $h3_line_height."px";

$h4_font_size = gt3_get_theme_option("h4_font_size");
$h4_line_height = substr(gt3_get_theme_option("h4_font_size"), 0, -2);
$h4_line_height = (int)$h4_line_height+2;$h4_line_height = $h4_line_height."px";

$h5_font_size = gt3_get_theme_option("h5_font_size");
$h5_line_height = substr(gt3_get_theme_option("h5_font_size"), 0, -2);
$h5_line_height = (int)$h5_line_height+2;$h5_line_height = $h5_line_height."px";

$h6_font_size = gt3_get_theme_option("h6_font_size");
$h6_line_height = substr(gt3_get_theme_option("h6_font_size"), 0, -2);
$h6_line_height = (int)$h6_line_height+2;$h6_line_height = $h6_line_height."px";

$main_content_font_size = gt3_get_theme_option("main_content_font_size");
$main_content_line_height = gt3_get_theme_option("main_content_line_height");
?>
/* *** MAIN COLOR: #0aa4ca *** */

::selection {background:#<?php echo $themecolor1; ?>;}
::-moz-selection {background:#<?php echo $themecolor1; ?>;}

footer,
.flickr_widget_wrapper a .flickr_border,
.dribbble_widget_wrapper a .flickr_border,
header .sub-menu {
	border-color:#<?php echo $themecolor1; ?>;
}

header .menu > li:before {
	border-top: 4px solid #<?php echo $themecolor1; ?>;
}
a,
.page_title_block .breadcrumbs a:hover,
.widget_nav_menu ul li a:hover,
.widget_archive ul li a:hover,
.widget_pages ul li a:hover,
.widget_categories ul li a:hover,
.widget_recent_entries ul li a:hover,
header .menu > li:hover > a,
header .menu > li.current-menu-parent > a,
header .menu > li.current-menu-item > a,
.blog_post_content .blog_post-topline .blog_post-meta span a:hover,
.prev_next_links .fleft a:hover,
.prev_next_links .fright a:hover,
.gallery_back a:hover,
.commentlist .comment_info span a:hover,
.module_blog .blogpost_title:hover,
header .sub-menu li:hover > a, 
header .sub-menu li.current-menu-parent > a, 
header .sub-menu li.current-menu-item > a,
header .search_box input,
.pre_footer a,
header .sub-menu li:hover > a:before, 
header .sub-menu li.current-menu-parent > a:before, 
header .sub-menu li.current-menu-item > a:before,
.widget_nav_menu ul li a:hover:before,
.widget_archive ul li a:hover:before,
.widget_pages ul li a:hover:before,
.widget_categories ul li a:hover:before,
.widget_recent_entries ul li a:hover:before,
.widget_nav_menu ul li.current-menu-item > a:before,
.widget_nav_menu ul li.current-menu-parent > a:before,
.testimonials_heading,
.blog_post_page .blog_post-topline .blog_post-meta span a:hover,
section.blogpost_user_meta .author-name h4 a {
	color:#<?php echo $themecolor1; ?>;
}
.columns2 .portfolio_item .gallery_title a:hover,
.columns3 .portfolio_item .gallery_title a:hover,
.columns4 .portfolio_item .gallery_title a:hover,
.ui-widget-content a,
.featured_items_title a:hover,
.widget_nav_menu ul li.current_page_item > a,
.mobile_menu_wrapper li > a:hover,
h5.shortcode_accordion_item_title:hover, 
h5.shortcode_toggles_item_title:hover,
.shortcode_tab_item_title:hover,
.shortcode_social_icon.type4:hover i,
.comment_info .author_name a,
.module_portfolio_masonry .optionset li.selected a,
.module_portfolio_masonry .optionset li a:hover,
.module_faq .shortcode_toggles_item_title:hover span.ico_faq:before {
	color:#<?php echo $themecolor1; ?>!important;
}
.ui-widget-content a:hover {
	color:#616367!important;
}

.nivo-directionNav a:hover,
.widget_flickr .flickr_badge_image .flickr_wrapper,
.featured_items .img_block .featured_item_fadder {
	background-color:#<?php echo $themecolor1; ?>;
}

.portfolio_item_img_fx a,
hr.header_line,
.panel_toggler,
.shortcode_accordion_item_title:hover .ico:before, 
.shortcode_toggles_item_title:hover .ico:before,
.shortcode_accordion_item_title:hover .ico:after, 
.shortcode_toggles_item_title:hover .ico:after,
.gallery_item .gallery_fadder,
.portfolio_image_fadder,
.masonry_pf_image_fadder {
	background-color:#<?php echo $themecolor1; ?>!important;
}
.wpcf7-submit:hover {
	background:#404040!important;
}
.header .menu > li:before {
	border-top-color:#<?php echo $themecolor1; ?>;
}

/*For plugin modules*/
.most_popular .price_item_title,
.shortcode_button.btn_type1:hover,
.shortcode_button.btn_type5,
.most_popular .price_item_btn a,
blockquote.shortcode_blockquote.type5:before,
.dropcap.type5,
.gallery_item .gallery_zoom_ico,
.featured_items .featured_link_ico,
.highlighted_colored {
	background-color:#<?php echo $themecolor1; ?>;
}
.most_popular .price_item_cost h2,
.dropcap.type2,
.posts-block .pagerblock li a:hover,
.posts-block .pagerblock li a.current,
.module_blog .pagerblock li a:hover,
.module_blog .pagerblock li a.current,
.module_blog_masonry .pagerblock li a:hover,
.module_blog_masonry .pagerblock li a.current,
.module_portfolio .pagerblock li a:hover,
.module_portfolio .pagerblock li a.current,
.optionset li a:hover,
.optionset li.selected a,
blockquote.shortcode_blockquote.type2:before,
.iconbox_wrapper:hover .ico,
.iconbox_wrapper:hover p,
.iconbox_wrapper:hover h5 {
	color:#<?php echo $themecolor1; ?>;
}
.preview_meta a:hover {
	color:#<?php echo $themecolor1; ?>!important;
}
.module_cont hr.type3,
.shortcode_promoblock {
	border-color:#<?php echo $themecolor1; ?>;
}

/* *** F O N T   F A M I L I E S  *** */

* {
    font-family:<?php echo $main_content_font; ?>;
}
.shortcode_promoblock h6,
.testimonials_company,
.shortcode_accordion_item_title,
.shortcode_toggles_item_title,
.block404 h4 {
	font-family:<?php echo $main_content_font; ?>!important;
}

/* ***  F O N T   S E T T I N G S  *** */

p, td, div,
blockquote p {
    font-size:<?php echo $main_content_font_size;?>;
    line-height:<?php echo $main_content_line_height;?>;
}

header .top_line .call_us,
header .top_line .slogan {
    line-height:14px;
    font-size:11px;
}

header .menu > li > a {
	font-family:<?php echo $additional_font; ?>;
}

h1, h2, h3, h4, h5, h6,
h1 span, h2 span, h3 span, h4 span, h5 span, h6 span,
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
    text-decoration:none!important;
    padding:0;
    color:#<?php gt3_the_theme_option("header_text_color"); ?>;
}

* {
    font-family:<?php echo $main_content_font; ?>;
	
}

input, button, select, textarea {
	font-family:<?php echo $main_content_font; ?>;
}

h1, h2, h3, h4,
h1 span, h2 span, h3 span, h4 span,
h1 a, h2 a, h3 a, h4 a {
	font-family:'<?php echo $text_headers_font; ?>';
}

h1, h1 span, h1 a {
	font-size:<?php echo $h1_font_size; ?>;
	line-height:<?php echo $h1_line_height; ?>;
}
h2, h2 span, h2 a {
    font-size:<?php echo $h2_font_size; ?>;
    line-height:<?php echo $h2_line_height; ?>;
}
h3, h3 span, h3 a {
    font-size:<?php echo $h3_font_size; ?>;
    line-height:<?php echo $h3_line_height; ?>;
}
h4, h4 span, h4 a {
    font-size:<?php echo $h4_font_size; ?>;
    line-height:<?php echo $h4_line_height; ?>;
}
h5, h5 span, h5 a {
    font-size:<?php echo $h5_font_size; ?>;
    line-height:<?php echo $h5_line_height; ?>;
}
h6, h6 span, h6 a {
    font-size:<?php echo $h6_font_size; ?>;
    line-height:<?php echo $h6_line_height; ?>;
}

.clean_bg_cont {
	background-color:#<?php gt3_the_theme_option("clean_bg_color"); ?>
}
.pre_footer {
    background-color:#<?php gt3_the_theme_option("footer_widget_area"); ?>;
}

footer, footer .copyright {
    color:#<?php gt3_the_theme_option("footer_text"); ?> !important;
}

.page_title_block .title {
    color:#<?php gt3_the_theme_option("pagetitle_header_text_color"); ?> !important;
}

header .sub-menu {
    background-color: #<?php gt3_the_theme_option("bg_in_2nd_level_menu"); ?>;
}

header .sub-menu li .sub-menu {
    background-color: #<?php gt3_the_theme_option("bg_in_3rd_level_menu"); ?>;
}

header .sub-menu li a {
    color: #<?php gt3_the_theme_option("main_menu_submenu_text_color"); ?>;
}

header .menu > li > .sub-menu {
	border-top: #<?php gt3_the_theme_option("border_in_2nd_level_menu"); ?> 3px solid;
    border-bottom: #<?php gt3_the_theme_option("border_in_2nd_level_menu"); ?> 3px solid;
}
header .menu > li > .sub-menu:before {
	border-left: 4px solid transparent;
	border-right: 4px solid transparent;
	border-bottom: 4px solid #<?php gt3_the_theme_option("border_in_2nd_level_menu"); ?>;
}

header .menu > li > .sub-menu > li > .sub-menu {
	border-top: 3px solid #<?php gt3_the_theme_option("border_in_3rd_level_menu"); ?>;
	border-bottom: 3px solid #<?php gt3_the_theme_option("border_in_3rd_level_menu"); ?>;
}
