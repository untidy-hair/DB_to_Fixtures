<?php
/**
 * @package    DB_to_Fixtures\DB
 * @author     Yukio Mizuta
 * @copyright  Copyright (c) 2012-2013 Yukio Mizuta
 * @license    MIT License http://www.opensource.org/licenses/mit-license
 * @link       y-mzt.info
 *
 * No Assurance, No responsibility
 */

namespace DB_to_Fixtures\DB;

abstract class BaseDB{

  protected  $table;
  protected  $pdo;

  public function __construct($table, \PDO $pdo){
    $this->table = $table;
    $this->pdo = $pdo;
    $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
  }

  public abstract function getColumnNames($table_schema = null);

  public abstract function getColumnTypes($table_schema = null);

  public function getData($limit = 3, $orderby = '', $order = "asc"){
    $sql = 'SELECT * FROM ' . $this->table ;
    if(trim($orderby) !== ''){
      $sql .= ' ORDER BY ' . $orderby . ' ' . $order;
    }
    $sql .=  ' LIMIT ' . $limit;
    return $this->pdo->query($sql.';')->fetchAll();
  }

  /**
   * @param $sql
   * @param $kind
   * @return array
   */
  protected function _SQLToArray($sql, $kind){
    $res = $this->pdo->query($sql)->fetchAll();
    $ret = array();
    foreach($res as $v){
      array_push($ret, $v[$kind]);
    }
    return $ret;
  }


}