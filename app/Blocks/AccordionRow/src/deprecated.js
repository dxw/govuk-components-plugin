import { useBlockProps, InnerBlocks, RichText } from '@wordpress/block-editor';

const v1 = {
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
	}
}

export default v1;