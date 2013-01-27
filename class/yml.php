<?php
/**
 * @package    DB_to_Fixtures\template
 * @author     Yukio Mizuta  http://y-mzt.info
 * @copyright  Copyright (c) 2012-2013 Yukio Mizuta
 * @license    MIT License http://www.opensource.org/licenses/mit-license
 * @link       https://github.com/untidy-hair/DB_to_Fixtures
 *
 * No Assurance, No responsibility
 */

namespace DB_to_Fixtures\template;

class yml implements templateInterface
{
  public function fileOut(array $column_names, array $values, $table){
    if(!$fp = fopen(__DIR__ . '/../outfiles/' .$table. '.' .getRealClassName(__CLASS__)  , 'w')) die ('Cannot open/create file!');

    //Body of output file
    $body = "$table:" . PHP_EOL;

    //set loop times
    $loop = count($values);

    for($i = 0; $i < $loop; $i++){
      $body .= '  -' .PHP_EOL;
      foreach($column_names as $column_name){
        //set the value first for many times use
        $value = $values[$i][$column_name];
        //create yml contents
        $body .= '    ' . $column_name . ': ';
        if($value !== null){
          $body .= '"' . $value . '"' . PHP_EOL;
        }else{
          $body .= $value . PHP_EOL;
        }
      }
    }

    fwrite($fp, $body);
    if(!fclose($fp)) die ('Cannot close file');
  }

}
