<?php
/**
 * @package
 * @author     Yukio Mizuta
 * @copyright  Copyright (c) 2012-2013 Yukio Mizuta
 * @license    MIT License http://www.opensource.org/licenses/mit-license
 * @link       y-mzt.info
 *
 * No Assurance, No responsibility
 */

namespace DB_to_Fixtures\test;

class UtilTest extends \PHPUnit_Framework_TestCase
{

  function testCreateDSN(){

    $inputs = array(
      'type' => 'pgsql',
      'host' => 'localhost',
      'port' => 5432,
      'dbname' => 'test',
      'table_schema' => 'public',
      'db_user' => 'postgres',
      'password' => 'postgres',
    );
    $this->assertSame('pgsql:host=localhost;port=5432;dbname=test;', \DB_to_Fixtures\Util::createDSN($inputs));

    $inputs = array(
      'type' => 'mysql',
      'host' => 'somehost',
      'port' => '',
      'dbname' => 'test2',
      'table_schema' => 'test2',
      'db_user' => 'root',
      'password' => '',
    );
    $this->assertSame('mysql:host=somehost;dbname=test2;', \DB_to_Fixtures\Util::createDSN($inputs));

  }



  /**
   * @dataProvider isArgValidSuccessProvider
   */

  function testIsArgsValidSuccess(array $inputs){
    $this->assertSame(true, \DB_to_Fixtures\Util::isArgsValid($inputs));
  }

  /**
   * @dataProvider isArgValidFailureProvider
   */

  function testIsArgsValidFailure(array $inputs){
    $this->assertSame(false, \DB_to_Fixtures\Util::isArgsValid($inputs));
  }

  function testStringToBool(){
    $this->assertSame(true, \DB_to_Fixtures\Util::stringToBool('true'));
    $this->assertSame(true, \DB_to_Fixtures\Util::stringToBool(true));
    $this->assertSame(false, \DB_to_Fixtures\Util::stringToBool('false'));
    $this->assertSame(false, \DB_to_Fixtures\Util::stringToBool(false));
    $this->assertSame('hogehoge', \DB_to_Fixtures\Util::stringToBool('hogehoge'));
  }


#
# DataProviders
#
  function isArgValidSuccessProvider(){
    return array(
      array(
        array(
          'table' => 'table1',
          'limit' => 2,
          'nodata' => true,
          'output' => 'yml',
          'orderby' => '',
          'order' => '',
        ),
      ),
      array(
        array(
          'table' => 'table2',
          'limit' => 10,
          'nodata' => false,
          'output' => 'XML',
          'orderby' => '',
          'order' => '',
        ),
      ),
      array(
        array(
          'table' => 'table3',
          'limit' => 1,
          'nodata' => false,
          'output' => 'YML',
          'orderby' => '',
          'order' => '',
        ),
      ),
      array(
        array(
          'table' => 'table4',
          'limit' => 2,
          'nodata' => false,
          'output' => 'YML',
          'orderby' => 'hoge',
          'order' => 'desc',
        ),
      ),
      array(
        array(
          'table' => 'table5',
          'limit' => 22,
          'nodata' => true,
          'output' => 'xml',
          'orderby' => 'hoge',
          'order' => '',
        ),
      ),
    );
  }


  function isArgValidFailureProvider(){
    return array(
      array(
        array(
          'table' => '',
          'limit' => 7,
          'nodata' => false,
          'output' => 'YML',
          'orderby' => '',
          'order' => '',
        ),
      ),
      array(
        array(
          'table' => 'table1',
          'limit' => -2,
          'nodata' => true,
          'output' => 'yml',
          'orderby' => '',
          'order' => '',
        ),
      ),
      array(
        array(
          'table' => 'table2',
          'limit' => 8.1,
          'nodata' => false,
          'output' => 'YML',
          'orderby' => '',
          'order' => '',
        ),
      ),
      array(
        array(
          'table' => 'table3',
          'limit' => 10,
          'nodata' => false,
          'output' => 'aXML',
          'orderby' => '',
          'order' => '',
        ),
      ),
      array(
        array(
          'table' => 'table4',
          'limit' => 0,
          'nodata' => false,
          'output' => 'YML',
          'orderby' => '',
          'order' => '',
        ),
      ),
      array(
        array(
          'table' => 'table5',
          'limit' => 3,
          'nodata' => 'go_home',
          'output' => 'YML',
          'orderby' => '',
          'order' => '',
        ),
      ),
      array(
        array(
          'table' => 'table6',
          'limit' => 2,
          'nodata' => false,
          'output' => 'YML',
          'orderby' => '',
          'order' => 'desc',
        ),
      ),
      array(
        array(
          'table' => 'table6',
          'limit' => 2,
          'nodata' => false,
          'output' => 'YML',
          'orderby' => '',
          'order' => 'year',
        ),
      ),
      array(
        array(
          'table' => 'table6',
          'limit' => 2,
          'nodata' => false,
          'output' => 'YML',
          'orderby' => 'year',
          'order' => 'mmm',
        ),
      ),
    );
  }


}
