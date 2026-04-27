import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';

const deprecated = {
    save() {
        const blockProps = useBlockProps.save( { className: 'govuk-inset-text' } );

        return (
            <div { ...blockProps }>
                <InnerBlocks.Content />
            </div>
        );
    }
} 

export default [deprecated];