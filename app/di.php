<?php

$registrar->addInstance(new \GovukComponents\Blocks\Accordion\Block());
$registrar->addInstance(new \GovukComponents\Blocks\AccordionRow\Block());
$registrar->addInstance(new \GovukComponents\Blocks\Button\Block());
$registrar->addInstance(new \GovukComponents\Blocks\Details\Block());
$registrar->addInstance(new \GovukComponents\Blocks\InsetText\Block());
$registrar->addInstance(new \GovukComponents\Blocks\WarningText\Block());

$registrar->addInstance(new \GovukComponents\BlockCategory());

$registrar->addInstance(new \GovukComponents\BlockController(
	[
		$registrar->getInstance(\GovukComponents\Blocks\Accordion\Block::class),
		$registrar->getInstance(\GovukComponents\Blocks\AccordionRow\Block::class),
		$registrar->getInstance(\GovukComponents\Blocks\Button\Block::class),
		$registrar->getInstance(\GovukComponents\Blocks\Details\Block::class),
		$registrar->getInstance(\GovukComponents\Blocks\InsetText\Block::class),
		$registrar->getInstance(\GovukComponents\Blocks\WarningText\Block::class)
	]
));

$registrar->addInstance(new \GovukComponents\Options(
	$registrar->getInstance(\GovukComponents\BlockController::class)
));

$registrar->addInstance(new \GovukComponents\Components\NotificationBanner());
$registrar->addInstance(new \GovukComponents\Components\PhaseBanner());

$registrar->addInstance(new \GovukComponents\Translation());
