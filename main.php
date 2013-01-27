<?php
/**
 * @package    DB_to_Fixtures
 * @author     Yukio Mizuta  http://y-mzt.info
 * @copyright  Copyright (c) 2012-2013 Yukio Mizuta
 * @license    MIT License http://www.opensource.org/licenses/mit-license
 * @link       https://github.com/untidy-hair/DB_to_Fixtures
 *
 * No Assurance, No responsibility
 * PHP >= 5.3.0 required
 */

namespace DB_to_Fixtures;
require_once __DIR__ . '/bootstrap.php';

//get command line args into an array
$long_opts = array(
  'table:',  //required
  'limit:',  //default: 3
  'nodata:', //default: false
  'output:', //default: 'yml'
  'orderby:', //default: null
  'order:', //default: null
);
$args = getopt('', $long_opts);


//set default values+
if(Util::isNullOrEmpty($args['limit'])) $args['limit'] = 3;
if(Util::isNullOrEmpty($args['nodata'])){
  $args['nodata'] = false;
}else{
  $args['nodata'] = Util::stringToBool($args['nodata']);
}
if(Util::isNullOrEmpty($args['output'])) $args['output'] = 'yml';
if(!isset($args['orderby'])) $args['orderby'] = '';
if(!isset($args['order'])) $args['order'] = '';


//check input validation
if(!Util::isArgsValid($args)){
  echo "Input is invalid\n" ;
  echo "Usage Sample: php main.php --table=your_table [--output=yml] [--nodata=false] [--limit=3] [--orderby='' [--order=asc]]\n";
  echo " table: table name which you want to create yaml|xml data from\n";
  echo " output: 'yml' or 'xml'\n";
  echo " nodata: boolean (true or false)\n";
  echo " limit: integer more than 0\n";
  echo " orderby: column name which you want to order the data by\n";
  echo " order: 'asc' or 'desc'\n";
  echo "Check 'main.php' and isArgsValid() in 'class/Util.php' for details.\n";
  exit;
}


//get DB Info
$db_info = require __DIR__ . '/db.config.php';


//Create DSN
$dsn = Util::createDSN($db_info);


//Use pgsql class when mysql (class_alias is difficult under namespace)
if($db_info['type'] == 'mysql') $db_info['type'] = 'pgsql';


//Instantiate a dbh
$db_kind = '\\DB_to_Fixtures\\DB\\' . $db_info['type']; // mysql, pgsql, sqlite
$dbh = new $db_kind($args['table'], new \PDO($dsn, $db_info['db_user'], $db_info['password']));


//Get replacement data in template file
$column_names =  $dbh->getColumnNames($db_info['table_schema']);
if($args['nodata'] == true){
  $values= $dbh->getColumnTypes($db_info['table_schema']);
}else{
  $values = $dbh->getData($args['limit'], $args['orderby'], $args['order']);
}


//Instantiate a template
$template_kind = '\\DB_to_Fixtures\\template\\' . $args['output']; //yml, xml
$template = new $template_kind;


$template->fileOut($column_names, $values, $args['table']);










