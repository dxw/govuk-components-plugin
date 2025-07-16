import { PanelBody } from "@wordpress/components";

export default function UsagePanel() {
    return (
        <PanelBody title='When to use this component' initialOpen={ true }>
            <p>
                Use the warning text component when you need to warn users about 
                something important, such as legal consequences of an action, or 
                lack of action, that they might take.
            </p>
            <p>
                <a
                    href="https://design-system.service.gov.uk/components/warning-text/"
                    target="_blank"
                >
                    Learn more about warning text in the GOV.UK Design System ↗
                </a>
            </p>
        </PanelBody>
    )
}