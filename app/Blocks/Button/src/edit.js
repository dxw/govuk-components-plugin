import { __ } from '@wordpress/i18n';
import {  InspectorControls, RichText, URLInput, useBlockProps, LinkControl} from '@wordpress/block-editor';
import { PanelBody } from '@wordpress/components';

export default function Edit({ attributes, setAttributes }){
    const blockProps = useBlockProps({
        className: "govuk-button"
    })

    return (
        <div>
            <InspectorControls>
                <PanelBody title={__('Insert Url')}>
                        <LinkControl
                            value={{ url: attributes.url }}
                            onChange={({ url }) =>
                                setAttributes({ url })
                            }
                        />
                </PanelBody>
            </InspectorControls>

            <RichText   
                tagName='a'
                {...blockProps}
                value={attributes.content}
                onChange={(value) => setAttributes({content: value})}
                placeholder='Click here'
                allowedFormats={[]}
             />
        </div>
    )
}