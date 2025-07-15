<?php

$registrar->addInstance(new \GovukComponents\Blocks\Accordion\Block());
$registrar->addInstance(new \GovukComponents\Blocks\AccordionRow\Block());
$registrar->addInstance(new \GovukComponents\Blocks\Button());
$registrar->addInstance(new \GovukComponents\Blocks\Details\Block());
$registrar->addInstance(new \GovukComponents\Blocks\InsetText\Block());
$registrar->addInstance(new \GovukComponents\Blocks\NotificationBanner());
$registrar->addInstance(new \GovukComponents\Blocks\WarningText\Block());
$registrar->addInstance(new \GovukComponents\Blocks\Tabs\Block());
$registrar->addInstance(new \GovukComponents\Blocks\TabPanel\Block());

$registrar->addInstance(new \GovukComponents\BlockCategory());

$registrar->addInstance(new \GovukComponents\BlockController(
	[
		$registrar->getInstance(\GovukComponents\Blocks\Accordion\Block::class),
		$registrar->getInstance(\GovukComponents\Blocks\AccordionRow\Block::class),
		$registrar->getInstance(\GovukComponents\Blocks\Button::class),
		$registrar->getInstance(\GovukComponents\Blocks\Details\Block::class),
		$registrar->getInstance(\GovukComponents\Blocks\InsetText\Block::class),
		$registrar->getInstance(\GovukComponents\Blocks\NotificationBanner::class),
		$registrar->getInstance(\GovukComponents\Blocks\WarningText\Block::class),
		$registrar->getInstance(\GovukComponents\Blocks\Tabs\Block::class),
		$registrar->getInstance(\GovukComponents\Blocks\TabPanel\Block::class)
	]
));

$registrar->addInstance(new \GovukComponents\Options(
	$registrar->getInstance(\GovukComponents\BlockController::class)
));
