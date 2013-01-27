<?php
/**
 * @package    DB_to_Fixtures\test
 * @author     Yukio Mizuta  http://y-mzt.info
 * @copyright  Copyright (c) 2012-2013 Yukio Mizuta
 * @license    MIT License http://www.opensource.org/licenses/mit-license
 * @link       https://github.com/untidy-hair/DB_to_Fixtures
 *
 * No Assurance, No responsibility
 */

namespace DB_to_Fixtures\test;
use DB_to_Fixtures\template;

class ymlTest extends \PHPUnit_Framework_TestCase
{

  protected $yml;
  function setUp(){
    $this->yml = new template\yml;
  }

  function testFileOutWithData(){

    $column_names = array('id', 'given_name', 'family_name', 'grade_point_average', 'created_at', 'updated_at');

    $values = array(
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

    $this->yml->fileOut($column_names, $values, 'students');

    $this->assertFileExists(__DIR__ . '/../outfiles/students.yml');
    $this->assertFileEquals(__DIR__ . '/resources/students.yml', __DIR__ . '/../outfiles/students.yml');

  }

  function testFileOutWithTypes(){
    $column_names = array('id', 'given_name', 'family_name', 'grade_point_average', 'created_at', 'updated_at');
    $values = array(
      array(
        'id' => 'integer',
        'given_name' => 'character varying',
        'family_name' => 'character varying',
        'grade_point_average' => 'real',
        'created_at' => 'timestamp without time zone',
        'updated_at' => 'timestamp without time zone',
      ),
    );

    $this->yml->fileOut($column_names, $values, 'students_type');

    $this->assertFileExists(__DIR__ . '/../outfiles/students_type.yml');
    $this->assertFileEquals(__DIR__ . '/resources/students_type.yml', __DIR__ . '/../outfiles/students_type.yml');
  }



}
