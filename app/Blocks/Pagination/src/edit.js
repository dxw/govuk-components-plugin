import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';
import BlockInspector from './components/InspectorPanels/BlockInspector';

function PaginationLink({ label, url, isPrev }) {
    if (!label) return null;

    const className = isPrev ? 'govuk-pagination__prev' : 'govuk-pagination__next';
    const rel = isPrev ? 'prev' : 'next';
    const titleText = isPrev ? 'Previous page' : 'Next page';

    const svg = isPrev ? (
        <svg className="govuk-pagination__icon govuk-pagination__icon--prev" xmlns="http://www.w3.org/2000/svg" height="13" width="15" aria-hidden="true" focusable="false" viewBox="0 0 15 13">
            <path d="m6.5938-0.0078125-6.7266 6.7266 6.7441 6.4062 1.377-1.449-4.1856-3.9768h12.896v-2h-12.984l4.2931-4.293-1.414-1.414z" />
        </svg>
    ) : (
        <svg className="govuk-pagination__icon govuk-pagination__icon--next" xmlns="http://www.w3.org/2000/svg" height="13" width="15" aria-hidden="true" focusable="false" viewBox="0 0 15 13">
            <path d="m8.107-0.0078125-1.4136 1.414 4.2926 4.293h-12.986v2h12.896l-4.1855 3.9766 1.377 1.4492 6.7441-6.4062-6.7246-6.7266z" />
        </svg>
    );

    const content = url ? (
        <a className="govuk-link govuk-pagination__link" href={url} rel={rel}>
            {svg}
            <span className="govuk-pagination__link-title">{titleText}</span>
            <span className="govuk-pagination__link-label">{label}</span>
        </a>
    ) : (
        <span className="govuk-pagination__link">
            {svg}
            <span className="govuk-pagination__link-title">{titleText}</span>
            <span className="govuk-pagination__link-label">{label}</span>
        </span>
    );

    return <div className={className}>{content}</div>;
}

export default function Edit({ attributes }) {
    const { prevLabel, prevUrl, nextLabel, nextUrl } = attributes;
    const blockProps = useBlockProps();

    return (
        <>
            <BlockInspector />
            <div {...blockProps}>
                <nav className="govuk-pagination govuk-pagination--block" aria-label="Pagination">
                    <PaginationLink label={prevLabel} url={prevUrl} isPrev />
                    <PaginationLink label={nextLabel} url={nextUrl} isPrev={false} />
                </nav>
            </div>
        </>
    );
}