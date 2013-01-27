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

class xml implements templateInterface
{

  public function fileOut(array $column_names, array $values, $table){
    if(!$fp = fopen(__DIR__ . '/../outfiles/' .$table. '.' .getRealClassName(__CLASS__)  , 'w')) die ('Cannot open/create file!');

    //Level 1 indent
    $indent1 = '    ';
    //Level 2 indent
    $indent2 = '        ';
    //Level 3 indent
    $indent3 = '            ';

    //Body of output file
    $body = '<?xml version="1.0" ?>' . PHP_EOL;
    $body .= '<dataset>' . PHP_EOL;
    $body .= $indent1 . '<table name ="' . $table . '">' . PHP_EOL;

    foreach($column_names as $column_name){
      $body .= $indent2 . '<column>' . $column_name . '</column>'. PHP_EOL;
    }

    //set loop times
    $loop = count($values);

    for($i = 0; $i < $loop; $i++){
      $body .= $indent2 . '<row>'. PHP_EOL;
      foreach($column_names as $column_name){
        if($values[$i][$column_name] !== null){
          $body .= $indent3 . '<value>' . $values[$i][$column_name] . '</value>' . PHP_EOL;
        }else{
          $body .= $indent3 . '<null />' .PHP_EOL;
        }
      }
      $body .= $indent2 . '</row>' . PHP_EOL;
    }
    $body .= $indent1 . '</table>' . PHP_EOL;
    $body .= '</dataset>';

    fwrite($fp, $body);
    if(!fclose($fp)) die ('Cannot close file');
  }
}
