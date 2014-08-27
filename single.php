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
                                <div class="row-fluid">
                                    <div class="span12 module_cont module_blog module_none_padding">
                                        <div class="blog_post_page global_left">
                                            <div class="blogpost_date">
                                                <div class="blogpost_date-month"><?php echo get_the_time("M") ?></div>
                                                <div class="blogpost_date-day"><?php echo get_the_time("d") ?></div>
                                            </div>                         
                                            <section class="blog_post-topline">
                                                <h2 class="blog_post-title"><?php echo the_title(); ?></h2>

                                                <div class="blog_post-meta">
                                                    <span>by <?php echo the_author_posts_link(); ?></span>
                                                    <span><?php the_category(', '); ?></span>
                                                    <?php the_tags("<span>Tags: ", ', ', '</span>'); ?>
                                                </div>
                                            </section>                                                           
                                            <?php include("ext/pf_type1.php"); ?>
                                            <div class="blog_post_content">
                                                <article class="contentarea">
                                                    <?php
                                                    global $contentAlreadyPrinted;
                                                    if ($contentAlreadyPrinted !== true) {
                                                        the_content(__('Read more!', 'theme_localization'));
                                                    }
                                                    wp_link_pages(array('before' => '<div class="page-link"><span>' . __('Pages', 'theme_localization') . ': </span>', 'after' => '</div>'));
                                                    ?>
                                                </article>
                                            </div>
                                        </div>
                                            <section class="blogpost_user_meta">
                                                <div class="author-ava">
                                                    <?php echo get_avatar(get_the_author_meta('ID'), 70); ?>
                                                </div>
                                                <div class="author-name"><h4>About the Author: <?php the_author_posts_link(); ?></h4></div>
                                                <div
                                                    class="author-description"><?php the_author_meta('description'); ?></div>
                                                <div class="clear"></div>
                                            </section>

                                            <section class="blog_post-footer">
                                                <div class="prev_next_links">
                                                    <div class="fleft"><?php previous_post_link('<i class="stand_icon icon-angle-left"></i>&nbsp; %link') ?></div>
                                                    <div class="fright"><?php next_post_link('%link &nbsp;<i class="stand_icon icon-angle-right"></i>') ?></div>
                                                </div>
                                                <div class="blogpost_share">
                                                    Share this:&nbsp;&nbsp;&nbsp;
                                                    <a target="_blank"
                                                       href="http://www.facebook.com/share.php?u=<?php echo get_permalink(); ?>"
                                                       class="share_facebook"><i
                                                            class="stand_icon icon-facebook-sign"></i></a>
                                                    <a target="_blank"
                                                       href="https://twitter.com/intent/tweet?text=<?php echo get_the_title(); ?>&amp;url=<?php echo get_permalink(); ?>"
                                                       class="share_tweet"><i class="stand_icon icon-twitter"></i></a>
                                                    <a target="_blank"
                                                       href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>&media=<?php echo (strlen($featured_image[0])>0) ? $featured_image[0] : gt3_get_theme_option("logo"); ?>"
                                                       class="share_pinterest"><i class="stand_icon icon-pinterest"></i></a>
                                                    <a target="_blank"
                                                       href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>"
                                                       class="share_gplus"><i class="icon-google-plus-sign"></i></a>
                                                    <div class="clear"></div>
                                                </div>
                                                <div class="clear"></div>
                                            </section>
                                        
                                        <!--.blog_post_page -->
                                    </div>
                                </div>

                                <?php

                                if (defined("GT3PBVERSION") && gt3_get_theme_option("related_posts") == "on") {

                                    if ($pagebuilder['settings']['layout-sidebars'] == "no-sidebar") {
                                        $posts_per_line = 4;
                                    } else {
                                        $posts_per_line = 3;
                                    }

                                    echo '<div class="row-fluid"><div class="span12 module_cont module_small_padding module_feature_posts">';
                                    echo do_shortcode("[feature_posts
                                heading_color=''
                                heading_size='h4'
                                heading_text='" . __('Featured Works', 'theme_localization') . "'
                                number_of_posts=" . $posts_per_line . "
                                posts_per_line=" . $posts_per_line . "
                                sorting_type='random'
                                related='yes'
                                post_type='post'][/feature_posts]");
                                    echo '</div></div>';
                                }

                                ?>

                                <div class="row-fluid">
                                    <div class="span12">
                                        <?php comments_template(); ?>
                                    </div>
                                </div>

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

<?php get_footer() ?>