<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

get_header(); ?>

<div class="lyt-Container">
	<div class="lyt-Container_Inner">
		<div class="lyt-Container_Body">
			<section class="lyt-Primary">
				<div class="lyt-Primary_Body">
					<?php get_template_part('template-parts/content/content', 'none'); ?>
				</div>
			</section>
		</div>
	</div>
</div>

<?php get_footer();
