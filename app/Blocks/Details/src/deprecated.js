import { RichText, useBlockProps, InnerBlocks } from '@wordpress/block-editor';

const v1 = {
	attributes: {
		summary: {
			type: "string",
			default: ""
		},
		previewOpen: {
			type: "boolean",
			default: false
		}
	},
	save: ( { attributes } ) => {
		const summary = attributes.summary ? attributes.summary : '';
		const blockProps = useBlockProps.save( { className: 'govuk-details' } );
		
		return (
			<details { ...blockProps }>
				<summary className="govuk-details__summary">
					<span className="govuk-details__summary-text">
						<RichText.Content value={ summary } />
					</span>	
				</summary>
				<div className='govuk-details__text'>
					<InnerBlocks.Content />
				</div>
			</details>
		);
	}
};

export default v1;
