<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 */

get_header(); ?>

<div class="lyt-Container">
	<div class="lyt-Container_Inner">
		<div class="lyt-Container_Body">
			<section class="lyt-Primary">
				<div class="lyt-Primary_Body">
					<?php get_template_part( 'template-parts/content/content', 'none' ); ?>
				</div>
			</section>
		</div>
	</div>
</div>

<?php get_footer();
