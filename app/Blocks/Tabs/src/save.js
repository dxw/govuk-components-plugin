import { useBlockProps } from '@wordpress/block-editor';

export default function Save() {
    const blockProps = useBlockProps();
    
    return (
        <div {...blockProps}>
        </div>
    );
}