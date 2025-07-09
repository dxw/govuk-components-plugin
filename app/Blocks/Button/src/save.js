import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function Save({ attributes }) {
    const blockProps = useBlockProps.save({
        className: "govuk-button",
        href: attributes.url
    })

    return (
        <RichText.Content
            tagName='a'
            {...blockProps}
            value={attributes.content}
        />
    )
}