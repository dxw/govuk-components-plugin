import { RichText, useBlockProps, useInnerBlocksProps } from '@wordpress/block-editor';

export default function Save({ attributes }) {
    const { title, panelId } = attributes

    const blockProps = useBlockProps.save(
        {
            className:'govuk-tabs__panel'
        }
    );

    const { children, ...innerBlocksProps } = useInnerBlocksProps.save(blockProps);
    
    
    return (
        <div { ...innerBlocksProps } id={ panelId }>
            <h2 className='govuk-heading-l'>
                <RichText.Content value={ title } />
            </h2>
            { children }
        </div>
    );
}