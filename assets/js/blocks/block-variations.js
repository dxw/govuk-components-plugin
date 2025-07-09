const { registerBlockVariation } = wp.blocks;
const { __ } = wp.i18n;

wp.domReady(() => {
    registerBlockVariation('core/buttons', {
        name: 'govuk-buttons-variation',
        title: __('GOV.UK Buttons'),
        description: 'Use the GOV.UK button inside a buttons group',
        isDefault: true,
        attributes: {
            className: 'govuk-button-wrapper',
        },
        allowedBlocks: ['govuk-components/button'],
        innerBlocks: [
            [
                'govuk-components/button'
            ],
        ],
        scope: ['inserter'],
    });
})
