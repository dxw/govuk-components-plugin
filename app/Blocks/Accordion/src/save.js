import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';
import { applyFilters } from '@wordpress/hooks';
import { addFilter } from '@wordpress/hooks';
import { createInterpolateElement } from '@wordpress/element';

export default function save({attributes}) {

	const { accordionClass, accordionControls } = attributes

	const finalClassName = `govuk-accordion ${accordionClass}`.trim()

	const interpolatedControls = accordionControls 
        ? createInterpolateElement(accordionControls, {
            div: <div />,
            a: <a />
        }) 
        : null;

	const blockProps = useBlockProps.save(
		{
			className:finalClassName,
			id:"accordion-default"
		}
	);

	return (
		<div data-module="govuk-accordion" { ...blockProps }>
			{
				interpolatedControls && (
					<div className="accordion-controls">
                    	{ interpolatedControls }
                	</div>
				)
			}
			<InnerBlocks.Content />
		</div>
	);
}