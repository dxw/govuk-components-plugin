import { __ } from '@wordpress/i18n';
import { useBlockProps, useInnerBlocksProps } from '@wordpress/block-editor';
import BlockInspector from './components/InspectorPanels/BlockInspector';

const TEMPLATE = [
	[
		'core/paragraph',
		{
			placeholder: __( 'Add text, or type / to choose a block' )
		},
	],
];

export default function Edit() {

	const blockProps = useBlockProps(
		{ className: "govuk-inset-text" }
	);

	const innerBlockProps = useInnerBlocksProps(
		blockProps,
		{
			template: TEMPLATE,
			allowedBlocks: ['core/paragraph', 'core/list']
		}
	);

	return (
		<>
			<BlockInspector />
			<div { ...innerBlockProps }>
				{ innerBlockProps.children }
			</div>
		</>
		
	);
}