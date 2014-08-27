<?php get_header();
#Emulate default settings for page without personal ID
$pagebuilder = gt3_get_default_pb_settings();
gt3_the_pb_custom_bg_and_color($pagebuilder);
$current_page_sidebar = $pagebuilder['settings']['layout-sidebars'];
?>

<div class="content_wrapper">
    <?php if (gt3_get_theme_option("show_breadcrumb_area") !== "no") { ?>
        <div class="page_title_block">
            <div class="container">
                <?php gt3_the_breadcrumb(); ?>
            </div>
        </div>
    <?php } ?>
    <div class="container">
        <div class="content_block <?php echo $pagebuilder['settings']['layout-sidebars'] ?> row">
            <div class="fl-container <?php echo (($pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "span9" : "span12"); ?>">
                <div class="row">
                    <div class="posts-block <?php echo (($pagebuilder['settings']['layout-sidebars'] == "left-sidebar" || $pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "span9" : "span12"); ?>">
                        <div class="contentarea">
                            <?php
                                echo '<div class="row-fluid"><div class="span12">';
                                while (have_posts()) : the_post();
                                    get_template_part("bloglisting");
                                endwhile; gt3_get_theme_pagination();
                                echo '</div><div class="clear"></div></div>';
                            ?>
                        </div>
                    </div>
                    <?php get_sidebar('left'); ?>
                </div>
            </div>
            <?php get_sidebar('right'); ?>
            <div class="clear"></div>
        </div>
    </div>
</div>

<?php get_footer(); ?>