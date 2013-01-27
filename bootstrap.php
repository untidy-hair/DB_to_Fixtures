<?php
/**
 * @package    DB_to_Fixtures
 * @author     Yukio Mizuta  http://y-mzt.info
 * @copyright  Copyright (c) 2012-2013 Yukio Mizuta
 * @license    MIT License http://www.opensource.org/licenses/mit-license
 * @link       https://github.com/untidy-hair/DB_to_Fixtures
 *
 * No Assurance, No responsibility
 */

//setup autoloader
spl_autoload_register(function($class){
  require_once __DIR__. "/class/". getRealClassName($class) .".php";
}, true);

//the only global function
function getRealClassName($class){
  $class_parts = explode('\\', $class);
  return end($class_parts);
}

//Not good practice, but ignore "undefined index" notice
error_reporting(E_ALL ^ E_NOTICE);
