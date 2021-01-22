<details class="<?php echo apply_filters('govuk_components_class', 'govuk-details') ?>" data-module="govuk-details">
    <summary class="<?php echo apply_filters('govuk_components_class', 'govuk-details__summary') ?>">
        <span class="<?php echo apply_filters('govuk_components_class', 'govuk-details__summary-text') ?>">
            <?php echo wp_kses_post(get_field('details_summary')) ?>
        </span>
    </summary>
    <div class="<?php echo apply_filters('govuk_components_class', 'govuk-details__text') ?>">
        <?php echo wp_kses_post(get_field('details_text')) ?>
    </div>
</details>
