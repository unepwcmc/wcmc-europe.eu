<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

get_header(); ?>

<div class="lyt-Container">
	<div class="lyt-Container_Inner">
		<div class="lyt-Container_Body">
			<!-- primary  -->
			<section class="lyt-Primary">
				<div class="lyt-Primary_Body">
					<? get_template_part( 'template-parts/content/content', 'none' ); ?>
				</div>
			</section>
		</div>
	</div>
</div>

<?php dynamic_sidebar('after-content'); ?>

<?php get_footer();
