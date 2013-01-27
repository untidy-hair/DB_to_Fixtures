<?php
/**
 * @package    DB_to_Fixtures\DB
 * @author     Yukio Mizuta  http://y-mzt.info
 * @copyright  Copyright (c) 2012-2013 Yukio Mizuta
 * @license    MIT License http://www.opensource.org/licenses/mit-license
 * @link       https://github.com/untidy-hair/DB_to_Fixtures
 *
 * No Assurance, No responsibility
 */

namespace DB_to_Fixtures\DB;

class sqlite extends BaseDB{

  public function getColumnNames($table_schema = null){
    $sql = 'PRAGMA table_info("'. $this->table .'");';
    return $this->_SQLToArray($sql, 'name');
  }

  public function getColumnTypes($table_schema = null){
    $sql = 'PRAGMA table_info("'. $this->table .'");';
    $res = $this->pdo->query($sql)->fetchAll();
    $ret = array();
    foreach($res as $v){
      $ret[0][$v['name']] = $v['type'];
    }
    return $ret;
  }

}
