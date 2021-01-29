<?php

/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */
$thumbnail_url = get_the_post_thumbnail_url() != '' ? get_the_post_thumbnail_url() : get_stylesheet_directory_uri() . '/dist/img/square-placeholder.jpg';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('ent-Excerpt ent-Excerpt--search'); ?>>
	<div class="ent-Excerpt_Body">
		<div class="ent-Excerpt_Columns">
			<div class="ent-Excerpt_Column">
				<div class="ent-Excerpt_Thumbnail">
					<img src="<?php echo $thumbnail_url; ?>" alt="<?php the_title(); ?>" />
				</div>
			</div>
			<div class="ent-Excerpt_Column">
				<?php
				the_title(sprintf('<h2 class="ent-Excerpt_Title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
				?>
				<p class="ent-Excerpt_Details"><?php echo get_the_date(get_option('date_format')); ?></p>
				<?php if (get_the_excerpt() != '') : ?>
					<p class="ent-Excerpt_Content"><?php
																					the_excerpt();
																					?></p>
				<?php endif; ?>
				<a class="ent-Excerpt_Link" href="<?php the_permalink(); ?>" title="Read more">
					<?php get_template_part('/template-parts/icons/icon', 'arrow-right'); ?>
					Read more
				</a>
			</div>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->