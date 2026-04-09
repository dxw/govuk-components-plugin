<?php
/** @var string $content */
?>
<div <?php echo get_block_wrapper_attributes(['class' => 'govuk-inset-text']); ?>>
    <?php echo wp_kses_post($content) ?>
</div>