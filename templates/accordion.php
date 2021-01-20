<?php

$accordionId = 'accordion-default-' . $args['govuk-components-accordion-count'];
$rowCount = 0;

?>

<div class="govuk-accordion" data-module="govuk-accordion" id="<?php echo $accordionId ?>">
    <?php if (have_rows('accordion_sections')) :
        while (have_rows('accordion_sections')) : the_row(); $rowCount++; 
        $headingId = $accordionId . '-heading-' . $rowCount;
        ?>
        <div class="govuk-accordion__section">
            <div class="govuk-accordion__section-header">
                <h2 class="govuk-accordion__section-heading">
                    <span class="govuk-accordion__section-button" id="<?php echo $headingId ?>">
                    <?php the_sub_field('accordion_section_heading'); ?>
                    </span>
                </h2>
            </div>
            <div id="<?php echo $accordionId ?>-content-<?php echo $rowCount ?>" class="govuk-accordion__section-content" aria-labelledby="<?php echo $headingId ?>">
                <?php the_sub_field('accordion_section_content'); ?>
            </div>
        </div>
        <?php endwhile; ?>
    <?php endif; ?>
</div>
