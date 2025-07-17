import { __ } from '@wordpress/i18n';
import { RichText, useBlockProps, useInnerBlocksProps } from '@wordpress/block-editor';
import { useEffect } from 'react';

const TEMPLATE = [
    [
        "core/paragraph",
        {
            placeholder: __( 'Add text, or type / to choose a block' ),
        },
    ]
]

function toKebabCase(str) {
    return str.replace(/([a-z])([A-Z])/g, "$1-$2")
    .replace(/[\s_]+/g, '-')
    .toLowerCase();
}

function handleTitleChange(newTitle, setAttributes) {
    const kebabCase = toKebabCase(newTitle);
    console.log(kebabCase);
    setAttributes({
        title: newTitle,
        panelId: kebabCase
    })
}

export default function Edit({ attributes, setAttributes }) {
    const { title, panelId } = attributes;

    const blockProps = useBlockProps(
        {
            className:'govuk-tabs__panel',
            id: panelId
        }
    );

    const { children, ...innerBlocksProps} = useInnerBlocksProps(
        blockProps,
        {
            template: TEMPLATE,
		}
    );

    return (
        <>
            <div {...innerBlocksProps}>
                <h2 className='govuk-heading-l'>
                    <RichText 
                        value= {title}
                        onChange={ (newTitle) => handleTitleChange(newTitle, setAttributes)}
                        placeholder={__('Tab title')}
                    />
                </h2>
                { children }
            </div>
        </>
        
    );
}