<a href="<?php echo esc_url(get_field('button_link')); ?>" role="button" draggable="false" class="<?php echo apply_filters('govuk_components_class', 'govuk-button'); ?><?php echo apply_filters('govuk_components_class', ' ' . esc_attr(get_field('button_style'))); ?>" data-module="govuk-button">
	<?php echo esc_attr(get_field('button_text')); ?>
	<?php if ('govuk-button--start' == get_field('button_style')) { ?>
        <svg class="govuk-button__start-icon" xmlns="http://www.w3.org/2000/svg" width="17.5" height="19"
             viewBox="0 0 33 40" aria-hidden="true" focusable="false">
            <path fill="currentColor" d="M0 0h13l20 20-20 20H0l20-20z"/>
        </svg>
	<?php } ?>
</a>