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

class mysqlTest extends \PHPUnit_Extensions_Database_TestCase
{

  protected static $pdo;
  protected static $table_schema;
  protected static $pgsql;

  function __construct(){
    $db_info = require __DIR__ . '/resources/mysql.config.php';
    self::$table_schema = $db_info['table_schema'];
    $dsn = \DB_to_Fixtures\Util::createDSN($db_info);
    self::$pdo = new \PDO($dsn, $db_info['db_user'], $db_info['password'] );
    self::$pdo->query(require __DIR__ . '/resources/db_schema.php');
    self::$pgsql = new DB\pgsql('students', self::$pdo);
  }

  function getConnection(){
    return $this->createDefaultDBConnection(self::$pdo,'test');
  }

  function getDataSet(){
    return new \PHPUnit_Extensions_Database_DataSet_YamlDataSet(__DIR__ . '/resources/students.yml');
  }

  function testGetColumnNames(){
    $columns = self::$pgsql->getColumnNames(self::$table_schema);
    $expected = array('id', 'given_name', 'family_name', 'grade_point_average', 'created_at', 'updated_at');
    $this->assertSame($expected, $columns);
  }

  function testGetColumnTypes(){
    $types = self::$pgsql->getColumnTypes(self::$table_schema);
    $expected = array(
      array(
        'id' => 'bigint',
        'given_name' => 'varchar',
        'family_name' => 'varchar',
        'grade_point_average' => 'double',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
      ),
    );
    $this->assertSame($expected, $types);
  }

  function testGetData(){
    $data = self::$pgsql->getData();
    $expected = array(
      array(
            'id' => '1',
            'given_name' => 'Chamu',
            'family_name' => '',
            'grade_point_average' => '1000',
            'created_at' => '2012-12-28 04:50:33',
            'updated_at' => '2012-12-30 02:36:24',
      ),

      array(
            'id' => '2',
            'given_name' => 'John',
            'family_name' => 'Lennon',
            'grade_point_average' => null,
            'created_at' => '2012-12-28 04:51:07',
            'updated_at' => '2012-12-28 04:51:07',
      ),
      array(
            'id' => '3',
            'given_name' => 'Paul',
            'family_name' => null,
            'grade_point_average' => '800',
            'created_at' => '2012-12-29 04:10:36',
            'updated_at' => '2012-12-29 04:10:36',
      ),
    );
    $this->assertSame($expected, $data);

    $data = self::$pgsql->getData(2);
    $expected = array(
      array(
        'id' => '1',
        'given_name' => 'Chamu',
        'family_name' => '',
        'grade_point_average' => '1000',
        'created_at' => '2012-12-28 04:50:33',
        'updated_at' => '2012-12-30 02:36:24',
      ),
      array(
        'id' => '2',
        'given_name' => 'John',
        'family_name' => 'Lennon',
        'grade_point_average' => null,
        'created_at' => '2012-12-28 04:51:07',
        'updated_at' => '2012-12-28 04:51:07',
      ),
    );
    $this->assertSame($expected, $data);


    $data = self::$pgsql->getData(2, "updated_at");
    $expected = array(
      array(
        'id' => '2',
        'given_name' => 'John',
        'family_name' => 'Lennon',
        'grade_point_average' => null,
        'created_at' => '2012-12-28 04:51:07',
        'updated_at' => '2012-12-28 04:51:07',
      ),
      array(
        'id' => '3',
        'given_name' => 'Paul',
        'family_name' => null,
        'grade_point_average' => '800',
        'created_at' => '2012-12-29 04:10:36',
        'updated_at' => '2012-12-29 04:10:36',
      ),
    );
    $this->assertSame($expected, $data);

    $data = self::$pgsql->getData(2, "updated_at", "desc");
    $expected = array(
      array(
        'id' => '1',
        'given_name' => 'Chamu',
        'family_name' => '',
        'grade_point_average' => '1000',
        'created_at' => '2012-12-28 04:50:33',
        'updated_at' => '2012-12-30 02:36:24',
      ),
      array(
        'id' => '3',
        'given_name' => 'Paul',
        'family_name' => null,
        'grade_point_average' => '800',
        'created_at' => '2012-12-29 04:10:36',
        'updated_at' => '2012-12-29 04:10:36',
      ),
    );
    $this->assertSame($expected, $data);


  }


}
