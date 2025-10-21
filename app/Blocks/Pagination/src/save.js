import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';

export default function save() {

    const blockProps = useBlockProps.save({
        className: 'govuk-pagination',
        'data-module': 'govuk-pagination',
    });

    return <div {...blockProps}></div>;
}