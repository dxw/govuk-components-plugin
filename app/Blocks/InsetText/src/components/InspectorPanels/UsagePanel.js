import { PanelBody } from "@wordpress/components";

export default function UsagePanel() {
    return (
        <PanelBody title='When to use this component' initialOpen={ true }>
            <p>
                Use the inset text component to differentiate a block of text 
                from the content that surrounds it, for example:
            </p>
            <ul style={{ paddingLeft: '20px', listStyle: 'disc' }}>
                <li>
                    quotes
                </li>
                <li>
                    examples
                </li>
                <li>
                    additional information about the page
                </li>
            </ul>
            <p>
                <a
                    href="https://design-system.service.gov.uk/components/inset-text/"
                    target="_blank"
                >
                    Learn more about inset text in the GOV.UK Design System ↗
                </a>
            </p>
        </PanelBody>
    )
}