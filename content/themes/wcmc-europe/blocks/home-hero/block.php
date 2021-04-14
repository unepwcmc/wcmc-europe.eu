<?php

/**
 * Home Hero Block
 * Created by UNEP-WCMC
 * With Block Lab for Gutenberg - https://getblocklab.com/
 */

// Variables
$title = block_field('title', false);
$text = block_field('text', false);
$dark_text = block_field('dark-text', false);

$image = block_field('background-image-id', false);
$image_url = wp_get_attachment_image_src($image, 'full-size')[0];

$overlay_opacity = block_field('overlay-opacity', false);

?>

<div class="home-hero<?php if ($dark_text) echo ' home-hero--dark'; ?>">
  <div class="home-hero__inner">
    <div class="home-hero__body">
      <div class="home-hero__content">
        <h2 class="home-hero__title"><?php echo $title; ?></h2>
        <div class="home-hero__text"><?php echo $text; ?></div>
      </div>
    </div>
  </div>
  <?php if ($image_url) : ?>
    <img src="<?php echo $image_url; ?>" alt="<?php echo $title; ?>" class="home-hero__background-image">
  <?php endif; ?>
  <div class="home-hero__overlay" style="opacity: <?php echo $overlay_opacity; ?>;"></div>
</div>