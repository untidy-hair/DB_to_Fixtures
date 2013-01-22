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

class pgsql extends BaseDB{

  public function getColumnNames($table_schema = null){
    $sql = 'select column_name from information_schema.columns where table_name=\''. $this->table
            .'\' and table_schema = \''. $table_schema .'\' order by ordinal_position asc;';
    return $this->_SQLToArray($sql, 'column_name');
  }

  public function getColumnTypes($table_schema = null){
    $sql = 'select column_name, data_type from information_schema.columns where table_name=\''. $this->table .
            '\' and table_schema = \''. $table_schema .'\' order by ordinal_position asc;';
    $res = $this->pdo->query($sql)->fetchAll();
    $ret = array();
    foreach($res as $v){
      $ret[0][$v['column_name']] = $v['data_type'];
    }
    return $ret;
  }

}


