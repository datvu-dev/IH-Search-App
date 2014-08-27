<?php
$pf = get_post_format();
if (empty($pf)) $pf = "text";
$pfIcon = gt3_get_pf_icon($pf);
$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
$pagebuilder = gt3_get_theme_pagebuilder(get_the_ID());

if(get_the_category()) $categories = get_the_category();
$post_categ = '';
$separator = ', ';
if ($categories) {
    foreach($categories as $category) {
        $post_categ = $post_categ .'<a href="'.get_category_link( $category->term_id ).'">'.$category->cat_name.'</a>'.$separator;
    }
}

if(get_the_tags() !== '') {
    $posttags = get_the_tags();

}
if ($posttags) {
    $post_tags = '';
    $post_tags_compile = '<span class="preview_meta_tags">tags:';
    foreach($posttags as $tag) {
        $post_tags = $post_tags . '<a href="?tag='.$tag->slug.'">'.$tag->name .'</a>'. ', ';
    }
    $post_tags_compile .= ' '.trim($post_tags, ', ').'</span>';
} else {
    $post_tags_compile = '';
}
?>

<div <?php post_class("blog_post_preview global_left theme_blog_listing"); ?>>
	<div class="preview_wrapper">
        <div class="global_date boxed_date">
            <div class="boxed_date_month"><?php the_time("M"); ?></div>
            <div class="boxed_date_day"><?php the_time("d"); ?></div>
        </div>
		<div class="global_preview">
			<div class="preview_topblock">
                <h2><a class="blogpost_title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<div class="preview_meta">										
                    <span class="preview_meta_author">by <?php the_author_meta('display_name'); ?></span>
                    <span class="preview_categ">in <?php echo trim($post_categ, ', '); ?></span>
                    <span class="preview_meta_comments"><a href="<?php echo get_comments_link(); ?>"><?php echo __('Comments','theme_localization').": " . get_comments_number(get_the_ID()); ?></a></span>
                    <?php echo $post_tags_compile; ?>
				</div>
            </div>
			<?php include ("ext/pf_type1.php"); ?>
            <article class="contentarea">
                <?php
                if (has_excerpt()) {
                    the_excerpt();
                } else {
                    the_content(__('Read more!','theme_localization'));
                }
                ?>
            </article>
		</div><!-- .global_preview -->
	</div>
</div>