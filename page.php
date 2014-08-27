<?php get_header();
the_post();

/* LOAD PAGE BUILDER ARRAY */
$pagebuilder = gt3_get_theme_pagebuilder(get_the_ID());
$pf = get_post_format();
if (empty($pf)) $pf = "text";
$pfIcon = gt3_get_pf_icon($pf);
$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
gt3_the_pb_custom_bg_and_color($pagebuilder);
$current_page_sidebar = $pagebuilder['settings']['layout-sidebars'];
?>

    <div class="content_wrapper">
        <?php if ($pagebuilder['settings']['show_breadcrumb_area'] !== "no" && gt3_get_theme_option("show_breadcrumb_area") !== "no") { ?>
            <div class="page_title_block">
                <div class="container">
                    <h1 class="title"><?php the_title(); ?></h1>
                    <?php gt3_the_breadcrumb(); ?>
                </div>
            </div>
        <?php } ?>
        <div class="container">
            <div class="content_block <?php echo $pagebuilder['settings']['layout-sidebars'] ?> row">
                <div
                    class="fl-container <?php echo(($pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "span9" : "span12"); ?>">
                    <div class="row">
                        <div
                            class="posts-block <?php echo(($pagebuilder['settings']['layout-sidebars'] == "left-sidebar" || $pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "span9" : "span12"); ?>">
                            <div class="contentarea">

                                <?php
                                echo '<div class="row-fluid"><div class="span12">';
                                the_content(__('Read more!', 'theme_localization'));
                                echo '</div><div class="clear"></div></div>';

                                wp_link_pages(array('before' => '<div class="page-link"><span>' . __('Pages', 'theme_localization') . ': </span>', 'after' => '</div>'));
                                ?>

                            </div>
                            <!-- .contentarea -->
                        </div>
                        <?php get_sidebar('left'); ?>
                    </div>
                    <div class="clear"><!-- ClearFix --></div>
                </div>
                <!-- .fl-container -->
                <?php get_sidebar('right'); ?>
                <div class="clear"><!-- ClearFix --></div>
            </div>
        </div>
        <!-- .container -->
    </div><!-- .content_wrapper -->

<?php get_footer(); ?>