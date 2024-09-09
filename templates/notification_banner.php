<?php

$bannerHeadingId = 'govuk-notification-banner-' . $args['govuk-components-notification-banner-count'] . '-title';
?>
<div class="<?php echo apply_filters('govuk_components_class', 'govuk-notification-banner') ?>" role="region" aria-labelledby="<?php echo $bannerHeadingId ?>" data-module="govuk-notification-banner">
  <div class="<?php echo apply_filters('govuk_components_class', 'govuk-notification-banner__header') ?>">
    <h2 class="<?php echo apply_filters('govuk_components_class', 'govuk-notification-banner__title') ?>" id="<?php echo $bannerHeadingId ?>">
      <?php echo wp_kses_post(get_field('notification_banner_title')); ?>
    </h2>
  </div>
  <div class="<?php echo apply_filters('govuk_components_class', 'govuk-notification-banner__content') ?>">
    <p class="<?php echo apply_filters('govuk_components_class', 'govuk-notification-banner__heading') ?>">
      <?php echo wp_kses_post(get_field('notification_banner_text')); ?>
    </p>
  </div>
</div>
