import { PanelBody } from "@wordpress/components";

export default function UsagePanel() {
    return (
        <PanelBody title='When to use this component' initialOpen={ true }>
            <p>
                Only use an accordion if there’s evidence it’s helpful for the user to:
            </p>
            <ul style={{ paddingLeft: '20px', listStyle: 'disc' }}>
                <li>
                    see an overview of multiple, related sections of content
                </li>
                <li>
                    choose to show and hide sections that are relevant to them
                </li>
                <li>
                    look across information that might otherwise be on different pages
                </li>
            </ul>
            <p>
                For example, an accordion can work well if the user needs to reveal and compare information that’s relevant to them.
            </p>
            <p>
                Accordions can also work well for people who use a service regularly. For example, users of caseworking systems who need to do familiar tasks quickly.
            </p>
            <p>
                Test with users to decide if using an accordion outweighs the potential problems with hiding content.
            </p>
            <p>
                <a
                    href="https://design-system.service.gov.uk/components/accordion/"
                    target="_blank"
                >
                    Learn more about accordions in the GOV.UK Design System ↗
                </a>
            </p>
        </PanelBody>
    )
}