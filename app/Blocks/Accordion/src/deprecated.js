import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';

const v1 = {
	save:() => {
		const blockProps = useBlockProps.save(
			{
				className:"govuk-accordion",
				id:"accordion-default"
			}
		);
		return (
		<div data-module="govuk-accordion" { ...blockProps }>
			<InnerBlocks.Content />
		</div>
		)
	}
}

export default v1;