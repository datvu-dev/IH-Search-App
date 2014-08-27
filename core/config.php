<?php

#Change this
$themename = "Trend Theme";
$themeshort = "trend_";

if (!defined("GT3THEME_INSTALLED")) {
    define("GT3THEME_INSTALLED", true);
}

#ADD SUPPORT FOR CUSTOM FONTS (NOT GOOGLE)
$themeconfig['custom_fonts'] = false;
#JUST FILENAME WITHOUT EXT
$themeconfig['custom_fonts_array'] = array(
    array(
        "font_family" => "Arial",
        "font_file_name" => "default_font",
        "font_weight" => "normal",
        "font_style" => "normal",
        "svg_id" => "default_font",
    ),array(
        "font_family" => "proxima_nova_rgregular",
        "font_file_name" => "mark_simonson_-_proxima_nova_regular-webfont",
        "font_weight" => "normal",
        "font_style" => "normal",
        "svg_id" => "default_font",
    ),
);

/*echo "<pre>";
print_r($themeconfig['custom_fonts_array']);
echo "</pre>";*/

?>