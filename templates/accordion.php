<?php

$accordionId = 'accordion-default-' . $args['govuk-components-accordion-count'];
$rowCount = 0;

?>

<div class="<?php echo apply_filters('govuk_components_class', 'govuk-accordion') ?>" data-module="govuk-accordion" id="<?php echo $accordionId ?>">
    <?php if (have_rows('accordion_sections')) :
        while (have_rows('accordion_sections')) : the_row(); $rowCount++;
        $headingId = $accordionId . '-heading-' . $rowCount;
        ?>
        <div class="<?php echo apply_filters('govuk_components_class', 'govuk-accordion__section') ?>">
            <div class="<?php echo apply_filters('govuk_components_class', 'govuk-accordion__section-header') ?>">
                <h2 class="<?php echo apply_filters('govuk_components_class', 'govuk-accordion__section-heading') ?>">
                    <span class="<?php echo apply_filters('govuk_components_class', 'govuk-accordion__section-button') ?>" id="<?php echo $headingId ?>">
                    <?php the_sub_field('accordion_section_heading'); ?>
                    </span>
                </h2>
            </div>
            <div id="<?php echo $accordionId ?>-content-<?php echo $rowCount ?>" class="<?php echo apply_filters('govuk_components_class', 'govuk-accordion__section-content') ?>" aria-labelledby="<?php echo $headingId ?>">
                <?php the_sub_field('accordion_section_content'); ?>
            </div>
        </div>
        <?php endwhile; ?>
    <?php endif; ?>
</div>
