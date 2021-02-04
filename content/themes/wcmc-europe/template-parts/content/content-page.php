<?php

/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */
global $template;
$post_classes_array = ['ent-Entry'];
if (basename($template) !== 'front-page.php') {
	array_push($post_classes_array, 'rte-RichText');
}
$post_classes = implode(' ', $post_classes_array);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
	<header class="ent-Entry_Header">
		<?php the_title('<h1 class="ent-Entry_Title utl-ScreenReaderOnly">', '</h1>'); ?>
	</header><!-- .ent-Entry_Header -->
	<div class="ent-Entry_Body">
		<div class="ent-Entry_Content">

			<?php
			the_content();

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __('Pages:'),
					'after'  => '</div>',
				)
			);
			?>

		</div><!-- .ent-Entry_Content -->
	</div>
</article><!-- #post-## -->