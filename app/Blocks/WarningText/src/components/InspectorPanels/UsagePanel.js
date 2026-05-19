import { __ } from '@wordpress/i18n';
import { PanelBody } from "@wordpress/components";

export default function UsagePanel() {
    return (
        <PanelBody title={ __('When to use this component', 'govuk-components') } initialOpen={ true }>
            <p>
                {__(
                    'Use the warning text component when you need to warn users about something important, such as legal consequences of an action, or lack of action, that they might take.',
                    'govuk-components'
                )}
                
            </p>
            <p>
                <a
                    href="https://design-system.service.gov.uk/components/warning-text/"
                    target="_blank"
                >
                    { __('Learn more about warning text in the GOV.UK Design System', 'govuk-components') }
                </a>
            </p>
        </PanelBody>
    )
}