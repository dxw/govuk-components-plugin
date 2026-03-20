import { useBlockProps, InnerBlocks, RichText } from '@wordpress/block-editor';
import { addFilter, applyFilters } from '@wordpress/hooks';

export default function save( { attributes } ) {
	const header = attributes.header ? attributes.header : '';

	const { index } = attributes;

	const classArray = [
		'classNames1',
		'classNames2 gov'
	]

	if(typeof myData === 'object') {
		Object.keys(myData).forEach(key => {
		classArray.forEach((el, index) => {
			if (el === key) {
				el += ' ';
				el += myData[key]
				classArray[index] = el;
				
			}
		});
	});
	}
	
	
	const blockProps = useBlockProps.save({
		className: "govuk-accordion__section ons-details ons-js-details"
	});

	return (
		<div { ...blockProps }>
			<div className={classArray[0]}>
				<h2 className="govuk-accordion__section-heading">
					<span className="govuk-accordion__section-button ons-details__heading ons-js-details-heading" id={`accordion-default-heading-${index}`}>
						<RichText.Content value={ header }
						/>
					</span>
				</h2>
    		</div>
			<div className="govuk-accordion__section-content ons-details__content ons-js-details-content" id={`accordion-default-content-${index}`}>
				<InnerBlocks.Content />
			</div>
		</div>
	);
}
