import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function save({ attributes }) {

    const blockProps = useBlockProps.save({
        className: 'govuk-warning-text'
    });

    return (
        <div { ...blockProps }>
            <span className="govuk-warning-text__icon" aria-hidden="true">!</span>
            <strong className="govuk-warning-text__text">
                <span class="govuk-visually-hidden">Warning</span>
                <RichText.Content
                    value={attributes.content}
                />
            </strong>
        </div>
    );
}