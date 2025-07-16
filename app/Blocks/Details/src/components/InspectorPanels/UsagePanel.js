import { PanelBody } from "@wordpress/components";

export default function UsagePanel () {
    return (
        <PanelBody title='When to use this component' initialOpen={ true }>
            <p>
                Use the details component to make a page easier to scan when 
                it contains information that only some users will need.
            </p>
            <p>
                <a
                    href="https://design-system.service.gov.uk/components/details/"
                    target="_blank"
                >
                    Learn more about the details component in the GOV.UK Design System ↗
                </a>
            </p>
        </PanelBody>
    )
}