<?php

/**
 * Full Width Carousel Block
 * Created by UNEP-WCMC
 * With Block Lab for Gutenberg - https://getblocklab.com/
 */
?>

<div class="carousel-full">

  <?php if ( block_rows( 'cells' ) ) : ?>

    <div class="carousel-full__cells">
      <?php $index = 0; ?>
      <?php while ( block_rows( 'cells' ) ) : block_row( 'cells' ); ?>
        <?php if ($index < 1): ?>
          <?php
            $title = block_sub_value('title');
            $label = block_sub_value('label');

            $background_image = block_sub_value('imageId');
            $background_image_url = wp_get_attachment_image_src($background_image, 'full-size')[0];
          ?>
          <div class="carousel-full__cell">
            <div class="carousel-full__content">
              <h3 class="carousel-full__label">
                <?php echo $label; ?>
              </h4>
              <h4 class="carousel-full__title">
                <?php echo $title; ?>
              </h4>
              <p class="carousel-full__link">
                View more
                <?php get_template_part( 'template-parts/icons/icon', 'arrow' ); ?>
              </p>
            </div>
            <img
              src="<?php echo $background_image_url; ?>"
              alt="<?php echo $title; ?>"
              class="carousel-full__background-image"
            >
          </div>
          <?php $index++; ?>
        <?php endif; ?>

      <?php endwhile; ?>

    </div>

  <?php endif; ?>

  <?php get_template_part( 'template-parts/carousel/faux', 'buttons' ); ?>
</div>
