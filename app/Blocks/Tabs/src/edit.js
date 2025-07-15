import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';
import BlockInspector from './components/InspectorControls/BlockInspector';

export default function Edit() {
    const blockProps = useBlockProps();

    return (
        <>
            <BlockInspector />
            <div {...blockProps}>
                
            </div>
        </>
        
    );
}