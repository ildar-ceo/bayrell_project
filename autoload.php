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
	function loadModule($arr1, $arr2)
	{
		$module_name = implode(".", $arr1);
		$file_name = array_pop($arr2);
		$path = implode("/", $arr2);
		if ($path) $path .= "/";
		
		$file_path = ROOT_PATH . "/app/" . $module_name . "/php/" . $path . $file_name . ".php";
		//var_dump($file_path);
		if ($this->tryLoadFile($file_path))
		{
			return true;
		}
		
		$file_path = ROOT_PATH . "/lib/" . $module_name . "/php/" . $path . $file_name . ".php";
		//var_dump($file_path);
		if ($this->tryLoadFile($file_path))
		{
			return true;
		}
		
		return false;
	}
	
	
	
	/**
	 * Load class
	 */
	function load($name)
	{
		$arr = explode("\\", $name);
		$sz=count($arr);
		$i=1;
		
		while ($i<$sz)
		{
			$arr1 = array_slice($arr, 0, $i);
			$arr2 = array_slice($arr, $i);
			
			if ($this->loadModule($arr1, $arr2))
			{
				return true;
			}
			
			$i++;
		}
		/*
		
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
		*/
		return false;
	}
	
}

$loader = new Autoload();
spl_autoload_register([$loader, 'load']);
