<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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

<?php
get_footer();
