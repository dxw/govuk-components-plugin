import { __ } from '@wordpress/i18n';
import { InspectorControls, useBlockProps, useInnerBlocksProps } from '@wordpress/block-editor';
import { PanelBody } from '@wordpress/components';

export default function Edit( { attributes, setAttributes } ) {

	const { showAll } = attributes;

	const blockProps = useBlockProps(
		{
			className:"govuk-accordion",
			id:"accordion-default"
		}
	);

	const innerBlocksProps = useInnerBlocksProps( blockProps, {
		defaultBlock: 'govuk-components/accordion-row',
		template: [ [ 'govuk-components/accordion-row' ] ],
		templateInsertUpdatesSelection: true,
		allowedBlocks: ['govuk-components/accordion-row'] 
	} );

	const toggleAll = () => {
		setAttributes({showAll: !showAll})
	}

	return (
		<>
			<InspectorControls>
				<PanelBody title='When to use this component' initialOpen={ true }>
					<p>
						Only use an accordion if there’s evidence it’s helpful for the user to:
					</p>
					<ul style={{ paddingLeft: '20px', listStyle: 'disc' }}>
						<li>
							see an overview of multiple, related sections of content
						</li>
						<li>
							choose to show and hide sections that are relevant to them
						</li>
						<li>
							look across information that might otherwise be on different pages
						</li>
					</ul>
					<p>
						For example, an accordion can work well if the user needs to reveal and compare information that’s relevant to them.
					</p>
					<p>
						Accordions can also work well for people who use a service regularly. For example, users of caseworking systems who need to do familiar tasks quickly.
					</p>
					<p>
						Test with users to decide if using an accordion outweighs the potential problems with hiding content.
					</p>
					<p>
						<a
							href="https://design-system.service.gov.uk/components/accordion/"
							target="_blank"
						>
							Learn more about accordions in the GOV.UK Design System ↗
						</a>
					</p>
				</PanelBody>
				
			</InspectorControls>
			<div className='govuk-frontend-supported'>
				<div className="govuk-accordion__controls">
					<button type="button" className="govuk-accordion__show-all" aria-expanded="false" onClick={toggleAll}>
						<span className="govuk-accordion-nav__chevron govuk-accordion-nav__chevron--down"></span>
						<span className="govuk-accordion__show-all-text">{showAll ? 'Hide all sections' : 'Show all sections'}</span>
					</button>
				</div>
				<div data-module="govuk-accordion" { ...innerBlocksProps }> 
				</div>
			</div>
		</>
		
	);
}