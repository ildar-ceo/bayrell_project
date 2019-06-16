<?php

set_time_limit(60);

use Runtime\LambdaFilter;
use Runtime\Collection;
use Runtime\Map;
use Runtime\Vector;


include "../autoload.php";

$base_path = dirname(__DIR__);


/* Create global context */
$context = Runtime\RuntimeUtils::registerGlobalContext
(
	new Vector
	(
		"BayrellConsole.AppEditor",
		"BayrellLang.WebTest"
	)
);

$json = [
	"Runtime" => [
		"base_path" => $base_path,
	],
	"BayrellConsole.AppEditor" => [
		"modules" => [
			"App.IndexPage",
		],
	],
	"BayrellLang" => [
		"cache" => "/var/cache/modules",
		"search" => [
			"/app",
		],
	],
];

$config = Runtime\RuntimeUtils::json_decode( json_encode($json) );

/* Set context params */
$context->readConfig( $config );

/* Init context */
$context->init();

/*
$provider = $context->getProvider("Core.ModuleInfo.ModuleSearchProvider");
$path = \Core\ModuleInfo\ModuleSearchProvider::findModule($context, $provider, "Core.ModuleInfo");
var_dump($path);
exit(0);
*/

/* Run App */
$app = $context->getProvider("Core.Backend.BackendAppProvider");
$request = Core\Http\Request::createPHPRequest();

$container = Core\Backend\BackendAppProvider::renderRequest($context, $app, $request);
$container = Core\Backend\BackendAppProvider::response($context, $app, $container);

if ($container->response)
{
	if ($container->response->headers != null)
	{
		$keys = $container->response->headers->keys();
		for ($i=0; $i<$keys->count(); $i++)
		{
			$key = $keys->item($i);
			$value = $container->response->headers->item($key);
			header($key, $value);
		}
	}
	echo $container->response->getContent();
}
else
{
	echo "404 Not found";
}
