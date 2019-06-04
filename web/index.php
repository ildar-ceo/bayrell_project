<?php

include "../autoload.php";

$base_path = dirname(__DIR__);


/* Create global context */
$context = Runtime\RuntimeUtils::registerGlobalContext
(
	new Runtime\Vector
	(
		"App.IndexPage",
		"Core.Backend",
		"Core.ModuleInfo",
		"Core.FileSystem.Provider"
	)
);

/* Module Search driver */
$driver = $context->getDriver("Core.ModuleInfo.ModuleSearchDriver");
$driver->addSearchPath($base_path . "/app");
$driver->addSearchPath($base_path . "/lib");

/* Init context */
$context->init();


/* Run App */
$app = $context->getDriver("Backend.App");
$request = Core\Http\Request::createPHPRequest();

$container = $app->renderRoute("App.IndexPage.Routes", "IndexPage", $request, null);
$container = $app->response($container);

if ($container->response)
{
	echo $container->response->content;
}
else
{
	echo "Not found";
}
