<div class="<?php echo apply_filters('govuk_components_class', 'govuk-warning-text') ?>">
  <span class="<?php echo apply_filters('govuk_components_class', 'govuk-warning-text__icon'); ?>" aria-hidden="true">!</span>
  <strong class="<?php echo apply_filters('govuk_components_class', 'govuk-warning-text__text') ?>">
    <span class="<?php echo apply_filters('govuk_components_class', 'govuk-warning-text__assistive') ?>">Warning</span>
        <?php echo wp_kses_post(get_field('warning_text_text')) ?>
  </strong>
</div>
