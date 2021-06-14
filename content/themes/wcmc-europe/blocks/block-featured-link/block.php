<?php

/**
 * Featured Link Block
 * Created by UNEP-WCMC
 * With Genesis Custom Blocks for Gutenberg - https://wpengine.co.uk/genesis-custom-blocks/
 */

$text = block_field('text', false);

$link_text = block_field('link-text', false);
$link_url = block_field('link-url', false);

$image = block_field('image-id', false);
$image_url = wp_get_attachment_image_src($image, 'full-size')[0];

?>

<div class="featured-link">
  <div class="featured-link__columns">
    <div class="featured-link__column">
      <div class="featured-link__image-wrapper">
        <img class="featured-link__image" src="<?php echo $image_url; ?>" alt="<?php echo $text; ?>">
      </div>
    </div>
    <div class="featured-link__column">
      <div class="featured-link__content">
        <h3 class="featured-link__title"><?php echo $text; ?></h3>
        <a class="featured-link__link" href="<?php echo $link_url; ?>"><?php echo $link_text; ?></a>
      </div>
    </div>
  </div>
</div>
