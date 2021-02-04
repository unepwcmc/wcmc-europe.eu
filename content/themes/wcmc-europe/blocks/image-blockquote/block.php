<?php

/**
 * Image Blockquote Block
 * Created by UNEP-WCMC
 * With Genesis Custom Blocks for Gutenberg - https://wpengine.co.uk/genesis-custom-blocks/
 */

$text = block_field('text', false);

$overlay_opacity = block_field('overlay-opacity', false);

$image = block_field('background-image-id', false);
$image_url = wp_get_attachment_image_src($image, 'full-size')[0];
?>

<div class="image-blockquote">
  <img src="<?php echo $image_url; ?>" alt="<?php echo $text; ?>" class="image-blockquote_background-image" style="opacity: <?php echo $overlay_opacity; ?>">
  <div class="image-blockquote_content">
    <h4 class="image-blockquote_text"><?php echo $text; ?></h4>
  </div>
</div>