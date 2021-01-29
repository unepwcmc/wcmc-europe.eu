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

<article id="post-<?php the_ID(); ?>" <?php post_class('ent-Entry rte-RichText'); ?>>
	<header class="ent-Entry_Header">
		<?php
		the_title(sprintf('<h2 class="ent-Entry_Title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
		?>
		<div class="ent-Entry_Details">
			<?php
			echo get_the_date(get_option('date_format'));
			echo get_the_tag_list(' - ', ', ', '');
			?>
		</div>
	</header><!-- .entry-header -->
	<div class="ent-Entry_Body">
		<div class="ent-Entry_Content">
			<?php
			the_excerpt();
			?>
			<a class="ent-Entry_Link" href="<?php the_permalink(); ?>" title="Read more">
				<?php get_template_part('/template-parts/icons/icon', 'arrow-right'); ?>
				Read more
			</a>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->