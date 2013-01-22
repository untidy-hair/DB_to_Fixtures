<?php
/**
 * @package    DB_to_Fixtures\test
 * @author     Yukio Mizuta
 * @copyright  Copyright (c) 2012-2013 Yukio Mizuta
 * @license    MIT License http://www.opensource.org/licenses/mit-license
 * @link       y-mzt.info
 *
 * No Assurance, No responsibility
 */

namespace DB_to_Fixtures\test;
use DB_to_Fixtures\DB;

class sqliteTest extends \PHPUnit_Extensions_Database_TestCase
{

  protected static $pdo;
  protected static $sqlite;

  function __construct(){
    self::$pdo = new \PDO('sqlite::memory:');
    self::$pdo->query(require __DIR__ . '/resources/db_schema.php');
    self::$sqlite = new DB\sqlite('students', self::$pdo);
  }

  function getConnection(){
    return $this->createDefaultDBConnection(self::$pdo,':memory:');
  }

  function getDataSet(){
    return new \PHPUnit_Extensions_Database_DataSet_YamlDataSet(__DIR__ . '/resources/students.yml');
  }


  function testGetColumnNames(){
    $columns = self::$sqlite->getColumnNames('');
    $expected = array('id', 'given_name', 'family_name', 'grade_point_average', 'created_at', 'updated_at');
    $this->assertEquals($expected, $columns);
  }

  function testGetColumnTypes(){
    $types = self::$sqlite->getColumnTypes('');
    $expected = array(
      array(
        'id' => 'serial',
        'given_name' => 'character varying(255)',
        'family_name' => 'character varying(255)',
        'grade_point_average' => 'real',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
      ),
    );
    $this->assertEquals($expected, $types);
  }

  function testGetData(){
    $data = self::$sqlite->getData();
    $expected = array(
      array(
            'id' => 1,
            'given_name' => 'Chamu',
            'family_name' => '',
            'grade_point_average' => 1000,
            'created_at' => '2012-12-28 04:50:33',
            'updated_at' => '2012-12-30 02:36:24',
      ),

      array(
            'id' => 2,
            'given_name' => 'John',
            'family_name' => 'Lennon',
            'grade_point_average' => null,
            'created_at' => '2012-12-28 04:51:07',
            'updated_at' => '2012-12-28 04:51:07',
      ),
      array(
            'id' => 3,
            'given_name' => 'Paul',
            'family_name' => null,
            'grade_point_average' => 800,
            'created_at' => '2012-12-29 04:10:36',
            'updated_at' => '2012-12-29 04:10:36',
      ),
    );
    $this->assertEquals($expected, $data);

    $data = self::$sqlite->getData(2, "updated_at", "desc");
    $expected = array(
      array(
        'id' => 1,
        'given_name' => 'Chamu',
        'family_name' => '',
        'grade_point_average' => '1000',
        'created_at' => '2012-12-28 04:50:33',
        'updated_at' => '2012-12-30 02:36:24',
      ),
      array(
        'id' => 3,
        'given_name' => 'Paul',
        'family_name' => null,
        'grade_point_average' => '800',
        'created_at' => '2012-12-29 04:10:36',
        'updated_at' => '2012-12-29 04:10:36',
      ),
    );
    $this->assertEquals($expected, $data);

  }


}
