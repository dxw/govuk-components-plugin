import { useBlockProps, InnerBlocks, RichText } from '@wordpress/block-editor';

const v1 = {
	attributes: {
		header: {
			type: 'string',
			source: 'html',
			selector: '.govuk-accordion__section-button'
		},
		isSelected: {
			type: 'boolean',
			default: false
		},
		index: {
			type: 'number',
			default: 0
		}
	},
	save:({ attributes }) => {
	const { header, index = 0 } = attributes;
	const blockProps = useBlockProps.save({
		className: "govuk-accordion__section"
		});

		return (
			<div { ...blockProps }>
				<div className="govuk-accordion__section-header">
					<h2 className="govuk-accordion__section-heading">
						<span className="govuk-accordion__section-button" id={`accordion-default-heading-${index}`}>
							<RichText.Content value={ header }
							/>
						</span>
					</h2>
				</div>
				<div className="govuk-accordion__section-content" id={`accordion-default-content-${index}`}>
					<InnerBlocks.Content />
				</div>
			</div>
		);
	},
	migrate: (attributes) => {
		return {
			...attributes,
			header: attributes.header || '',
			isSelected: attributes.isSelected !== undefined ? attributes.isSelected : false,
			index: attributes.index !== undefined ? attributes.index : 0
		};
	}
}

export default v1;