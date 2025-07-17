import { PanelBody } from "@wordpress/components";

export default function UsagePanel () {
    return (
        <PanelBody title='When to use this component' initialOpen={ true }>
            <p>
                Tabs can be a helpful way of letting users quickly switch between related information if:
            </p>
            <ul style={{ paddingLeft: '20px', listStyle: 'disc' }}>
                <li>
                    your content can be usefully separated into clearly labelled sections
                </li>
                <li>
                    the first section is more relevant than the others for most users
                </li>
                <li>
                    users will not need to view all the sections at once
                </li>
                
            </ul>
            <p>
                Tabs can work well for people who use a service regularly, for example, users of a caseworking system. 
                Their need to perform tasks quickly may be greater than their need for simplicity of first-time use.
            </p>
            <p>
                <a
                    href="https://design-system.service.gov.uk/components/tabs/"
                    target="_blank"
                >
                    Learn more about tabs in the GOV.UK Design System ↗
                </a>
            </p>
        </PanelBody>
    )
}