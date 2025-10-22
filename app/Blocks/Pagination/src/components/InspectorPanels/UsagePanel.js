import { PanelBody } from "@wordpress/components";

export default function UsagePanel() {
    return (
        <PanelBody title='When to use this component' initialOpen={ true }>
            <p>
                Consider using pagination when:
            </p>
            <ul style={{ paddingLeft: '20px', listStyle: 'disc' }}>
                <li>
                    showing all the content on a single page makes the page take too long to load
                </li>
                <li>
                    most users will only need the content on the first page or first few pages
                </li>
            </ul>
            <p>
                <a
                    href="https://design-system.service.gov.uk/components/pagination/"
                    target="_blank"
                >
                    Learn more about pagination in the GOV.UK Design System ↗
                </a>
            </p>
        </PanelBody>
    )
}