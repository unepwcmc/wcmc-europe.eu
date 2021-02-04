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

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php

		if (is_single()) {
			the_title('<h1 class="entry-title">', '</h1>');
		} elseif (is_front_page() && is_home()) {
			the_title('<h3 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>');
		} else {
			the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
		}
		?>
	</header><!-- .entry-header -->
	<div class="post-body">
		<div class="entry-content">
			<?php
			the_content();
			?>
		</div><!-- .entry-content -->

		<?php if ('' !== get_the_post_thumbnail() && !is_single()) : ?>
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
					<?php the_post_thumbnail('thumbnail'); ?>
				</a>
			</div><!-- .post-thumbnail -->
		<?php endif; ?>
	</div>

	<hr class="hr-white">
</article><!-- #post-## -->