<?php
/**
 * @package
 * @author     Yukio Mizuta  http://y-mzt.info
 * @copyright  Copyright (c) 2012-2013 Yukio Mizuta
 * @license    MIT License http://www.opensource.org/licenses/mit-license
 * @link       https://github.com/untidy-hair/DB_to_Fixtures
 *
 * No Assurance, No responsibility
 */

namespace DB_to_Fixtures;

class Util
{

  public static function createDSN(array $db_info){
    $dsn = $db_info['type'];
    $dsn .= ':host=' . $db_info['host'] . ';';
    if(!self::isNullOrEmpty($db_info['port'])){
      $dsn .= 'port=' . $db_info['port'] . ';';
    }
    $dsn .= 'dbname=' . $db_info['dbname'] . ';';

    return $dsn;
  }

  public static function isArgsValid(array $args){
    if(self::isNullOrEmpty($args['table'])
            || !preg_match('/^[1-9]\d*$/' , $args['limit'])
            || !is_bool($args['nodata'])
            || !preg_match('/^(xml|yml)$/i', $args['output'])
            || (self::isNullOrEmpty($args['orderby']) && !self::isNullOrEmpty($args['order']))
            || !preg_match('/^(asc|desc|)$/i', $args['order'])
    ){
      return false;
    }else{
      return true;
    }
  }

  public static function stringToBool($var){
    switch($var){
      case 'true':
        return true;
      case 'false':
        return false;
      default:
        return $var;
    }
  }


  /**
   * helper function but still public for future use
   * @param $var
   * @return bool
   */
  public static function isNullOrEmpty($var){
    return (!isset($var) || trim($var) === '');
  }



}