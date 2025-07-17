import { useBlockProps, useInnerBlocksProps } from '@wordpress/block-editor';

export default function Save({ attributes }) {
    const { tabs } = attributes;

    const blockProps = useBlockProps.save(
        {
		    className: 'govuk-tabs',
            "data-module": 'govuk-tabs'
        }
    );
    const { children, ...innerBlocksProps } = useInnerBlocksProps.save(blockProps);

    return (
            <div { ...innerBlocksProps }>
                <h2 className="govuk-tabs__title">
					Content
				</h2>
				<ul className="govuk-tabs__list">
                    {tabs.map((tab) => {
                        return (
                            <li className='govuk-tabs__list-item'>
                                <a className='govuk-tabs__tab' href={ '#' + tab.id }>
                                    { tab.title }
                                </a>
                            </li>
                        )
                    })}
				</ul>
                {children}
            </div>
    );
}