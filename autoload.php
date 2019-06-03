<?php

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
error_reporting(E_ALL);
define("ROOT_PATH", __DIR__);

//require "vendor/autoload.php";

// Autoloader

class Autoload
{
	
	
	/**
	 * Try to load file
	 */
	function tryLoadFile($file_path)
	{
		if (file_exists($file_path))
		{
			include($file_path);
			return true;
		}
		return false;
	}
	
	
	
	/**
	 * Load module
	 */
	function load($name)
	{
		$arr = explode("\\", $name);
		$file_name = array_pop($arr) . ".php";
		$module_name = array_shift($arr);
		
		$file_name = ROOT_PATH . "/app/" . $module_name . "/php/" . implode("/", $arr) . "/" . $file_name;
		if ($this->tryLoadFile($file_name))
		{
			return true;
		}
		
		$file_name = ROOT_PATH . "/lib/" . $module_name . "/php/" . implode("/", $arr) . "/" . $file_name;
		if ($this->tryLoadFile($file_name))
		{
			return true;
		}
		
		return false;
	}
	
}

$loader = new Autoload();
spl_autoload_register([$loader, 'load']);
