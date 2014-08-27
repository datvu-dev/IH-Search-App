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
                            <div class='antigen_root_wrap'>
                                <div class="grid_spacer"></div>
                                <?php
                                $antigen_cat_slug = 'antigen-root';
                                $antigen_cat = get_category_by_slug( $antigen_cat_slug );
                                $children_cat = get_categories('child_of='.$antigen_cat->cat_ID);
                                $children_cat = sort_cat_by_isbtno($children_cat);
                                foreach ($children_cat as $child_cat) {
                                    
                                    if (function_exists('get_terms_meta'))
                                    {
                                    $blood_grp_name = get_terms_meta($child_cat->cat_ID, 'blood-group-name');
                                    $blood_grp_isbtno = get_terms_meta($child_cat->cat_ID, 'isbtno');
                                    $antigen_count = get_terms_meta($child_cat->cat_ID, 'antigen_count');
                                   
                                    }                                   

                                    ?>

                                    <div class='antigen_outer_wrap'>
                                        <div class='antibody_info_wrap '>
                                            <div class='isbt_name'>
                                                <div class='isbt_root'>
                                                    ISBT NO.<h4><?echo $blood_grp_isbtno[0];?></h4>
                                                </div>
                                                <div class='blood_grp_hero_name'>
                                                    <h1><? echo $child_cat->name;?></h1>
                                                    <div class='name_sub'>
                                                        <span class='blood_grp_full_name'>
                                                        <?echo $blood_grp_name[0];?></span>
                                                        <span class='antigen_count'>[<?echo $antigen_count[0];?>]</span>
                                                    </div>
                                                </div>  
                                            </div>
                                            <a class='full_expand' href="">EXP</a>
                                        </div>
                                        <div class='sub_antigen_wrap'>
                                   <?php $args = array('category' => $child_cat->cat_ID,'posts_per_page' => 30);

                                    $myposts = get_posts( $args );
                                    
                                
                                     $myposts = sort_antigen_posts_by_isbtno($myposts);
                                    
                                    foreach ($myposts as $one_post) {
                                         $meta_group = get_group('post_1',1,$one_post->ID);
                                         
                                        ?>

                                      <div id="<?echo sanitize_title($one_post->post_title);?>"  class='antigen_wrap post_<?echo $one_post->ID;?>'>
                                        
                                            <div class='blood_group_name'>Anti-<?php echo $meta_group['antigen_meta_antigen_name'][1];?></div>
                                            <div class='blood_group_attr'>
                                           <div class='isbtno'><span class='desc_title'>ISBT No.</span><span class='desc_text'><?php echo $meta_group['antigen_meta_isbt_antigen_no'][1];?></span></div>
                                            <div class='rbc_freq_wrap'>
                                                <div class='rbc_freq_title'>RBC Antigen Frequency (%)</div>
                                                <div class='rbc_freq_text'>
                                                    <div class='cauasian'><span class='desc_title'>Cauasian</span><span class='desc_text'><?php echo $meta_group['antigen_meta_caucasian_rbc_antigen_frequency'][1];?>%</span></div>
                                                    <div class='asian'><span class='desc_title'>Asian</span><span class='desc_text'><?php echo $meta_group['antigen_meta_asian_rbc_antigen_frequency'][1];?>%</span></div>
                                                </div>
                                            </div>
                                            <div class='adult_site_wrap'>
                                                <div class='adult_site_title'>
                                                    Adult Antigen Site No. (per RBC)
                                                </div>
                                                <div class='adult_site_text'>
                                                    <span class='desc_text'><?php echo $meta_group['antigen_meta_adult_antigen_site_no'][1];?></span>
                                                </div>
                                            </div>
                                            <div class='anti_cord_wrap'>
                                                <div class='anti_cord_title'>
                                                    Antigen Presence on Cord Cells
                                                </div>
                                                <div class='anti_cord_text'>
                                                    <span class='desc_text'><?php echo $meta_group['antigen_meta_antigen_presence_on_cord_cells'][1];?></span>
                                                </div>
                                            </div>
                                             <div class='anti_struct_wrap'>
                                                <div class='anti_struct_title'>
                                                    <?//print_r( get_label('antigen_meta_antigen_structure')); ?>
                                                    Antigen Structure
                                                </div>
                                                <div class='anti_struct_text'>
                                                    <span class='desc_text'><?php echo $meta_group['antigen_meta_antigen_structure'][1];?></span>
                                                </div>
                                            </div>
                                            <div class='anti_papain_wrap'>
                                                <div class='anti_papain_title'>
                                                    <?//print_r( get_label('antigen_meta_antigen_structure')); ?>
                                                    Antigen Destroyed By Papain
                                                </div>
                                                <div class='anti_papain_text'>
                                                    <span class='desc_text'><?php echo $meta_group['antigen_meta_antigen_destroyed_by_papain'][1];?></span>
                                                </div>
                                            </div>
                                             <div class='anti_comment_wrap'>
                                                <div class='anti_struct_title'>
                                                    <?//print_r( get_label('antigen_meta_antigen_structure')); ?>
                                                    Antigen Comments
                                                </div>
                                                <div class='anti_comment_text'>
                                                    <span class='desc_text'><?php echo $meta_group['antigen_meta_antigen_comments'][1];?></span>
                                                </div>
                                            
                                        </div>
                                      </div> 
                                      </div>
                                    <?}?>
                                      </div>
                                      </div>

                               <? }
                               
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