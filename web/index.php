<?php

include "../autoload.php";

$base_path = dirname(__DIR__);


/* Create global context */
$context = Runtime\RuntimeUtils::registerGlobalContext
(
	new Runtime\Vector
	(
		"App",
		"Runtime",
		"Core.ModuleInfo",
		"Core.UI"
	)
);

/* Module Search driver */
$driver = $context->getDriver("BayrellLang.Compiler.ModuleSearchDriver");
$driver->addSearchPath($base_path . "/app");
$driver->addSearchPath($base_path . "/lib");

/* Init context */
$context->init();


/* Run App */
