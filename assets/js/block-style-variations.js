wp.domReady(()=> {
	wp.blocks.registerBlockStyle('core/button', {
		name: 'govuk-default',
		label: 'GOV.UK Default',
		isDefault: false
	});

	wp.blocks.registerBlockStyle('core/button', {
		name: 'govuk-start',
		label: 'GOV.UK Start',
	});

	wp.blocks.registerBlockStyle('core/button', {
		name: 'govuk-secondary',
		label: 'GOV.UK Secondary',
	});

	wp.blocks.registerBlockStyle('core/button', {
		name: 'govuk-warning',
		label: 'GOV.UK Warning',
	});

	wp.blocks.registerBlockStyle('core/button', {
		name: 'govuk-inverse',
		label: 'GOV.UK Inverse',
	});
});
