import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText } from '@wordpress/block-editor';
import BlockInspector from './components/InspectorPanels/BockInspector';

export default function Edit({ attributes, setAttributes }) {

    const blockProps = useBlockProps({
        className: 'govuk-warning-text'
    })

    return (
        <>
            <BlockInspector />
            <div {...blockProps}>
                <span class='govuk-warning-text__icon' aria-hidden='true'>!</span>
                <strong className='govuk-warning-text__text'>
                    <span class='govuk-visually-hidden'>Warning</span>
                    <RichText
                        value={attributes.content}
                        onChange={(value) => setAttributes({ content: value })}
                        placeholder={__('Add text about your warning here.')}
                        allowedFormats={['bold']}
                    />
                </strong>
            </div>
        </>
       
    )
}