import { __ } from '@wordpress/i18n';
import { useBlockProps, useInnerBlocksProps } from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data';
import { useEffect } from '@wordpress/element'
import BlockInspector from './components/InspectorControls/BlockInspector';

export default function Edit({ attributes, setAttributes, clientId }) {
	const { tabs } = attributes;

	const blockProps = useBlockProps(
        {
		    className: 'govuk-tabs',
        }
    );
	
	const { children, ...innerBlocksProps } = useInnerBlocksProps(
		blockProps,
        {
            defaultBlock: 'govuk-components/tab-panel',
            template: [
				['govuk-components/tab-panel', {}]
			],
	    }
    );

	const tabPanelBlocks = useSelect((select) => {
		const { getBlockOrder, getBlock } = select('core/block-editor');
		const panelIds = getBlockOrder(clientId);

		return panelIds.map((id) => getBlock(id));
	}, [clientId]) 

	useEffect(() => {
		const tabTitles = tabPanelBlocks.map((block) => {
			const title = block.attributes.title ?? 'Tab title';
			const id = block.attributes.panelId;

			return { title, id };
		})

		setAttributes({ tabs: tabTitles })
	}, [tabPanelBlocks])

	return (
		<>
			<BlockInspector />
			<div { ...innerBlocksProps }>
				<ul className="govuk-tabs__list">
					{tabs.map((tab) => {
						return (
							<li>
								<a>
									{tab.title}
								</a>
							</li>
						)
					})}
				</ul>
				{ children }
			</div>
		</>
	);
}