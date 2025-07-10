wp.blocks.registerBlockVariation('core/button', {
	name: 'govuk-default',
	title: 'GOV.UK Default',
	attributes: {
		className: 'govuk-button',
	},
	isDefault: false
});

wp.blocks.registerBlockVariation('core/button', {
	name: 'govuk-start',
	title: 'GOV.UK Start',
	attributes: {
		className: 'govuk-button--start',
	},
});

wp.blocks.registerBlockVariation('core/button', {
	name: 'govuk-secondary',
	title: 'GOV.UK Secondary',
	attributes: {
		className: 'govuk-button--secondary',
	},
});

wp.blocks.registerBlockVariation('core/button', {
	name: 'govuk-warning',
	title: 'GOV.UK Warning',
	attributes: {
		className: 'govuk-button--warning',
	},
});

wp.blocks.registerBlockVariation('core/button', {
	name: 'govuk-inverse',
	title: 'GOV.UK Inverse',
	attributes: {
		className: 'govuk-button--inverse',
	},
});
