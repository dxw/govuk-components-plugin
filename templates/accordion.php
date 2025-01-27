<?php

$accordionId = 'accordion-default-' . $args['govuk-components-accordion-count'];
$rowCount = 0;

?>

<div class="<?php echo apply_filters('govuk_components_class', 'govuk-accordion') ?>" data-module="govuk-accordion" id="<?php echo $accordionId ?>">
	<?php if (have_rows('accordion_sections')) :
		while (have_rows('accordion_sections')) : the_row();
			$rowCount++;
			$headingId = $accordionId . '-heading-' . $rowCount;
			$accordionSectionHeadingId = false;
			if (get_sub_field('attach_id_to_accordion_section_heading') && get_sub_field('accordion_section_heading_id')) {
				$accordionSectionHeadingId = get_sub_field('accordion_section_heading_id');
			}
			?>
            <div class="<?php echo apply_filters('govuk_components_class', 'govuk-accordion__section') ?>">
                <div class="<?php echo apply_filters('govuk_components_class', 'govuk-accordion__section-header') ?>">
                    <h2 class="<?php echo apply_filters('govuk_components_class', 'govuk-accordion__section-heading') ?>" <?php echo esc_attr($accordionSectionHeadingId) ? 'id="' . esc_attr($accordionSectionHeadingId) . '"' : '' ?>>
                    <span class="<?php echo apply_filters('govuk_components_class', 'govuk-accordion__section-button') ?>" id="<?php echo esc_attr($headingId) ?>">
                    <?php echo wp_kses_post(get_sub_field('accordion_section_heading')); ?>
                    </span>
                    </h2>
                </div>
                <div id="<?php echo esc_attr($accordionId) ?>-content-<?php echo $rowCount ?>" class="<?php echo apply_filters('govuk_components_class', 'govuk-accordion__section-content') ?>">
					<?php echo wp_kses_post(get_sub_field('accordion_section_content')); ?>
                </div>
            </div>
		<?php endwhile; ?>
	<?php endif; ?>
</div>
